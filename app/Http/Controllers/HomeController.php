<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnketResultService;
use App\Services\AnketAccessService;
use App\Http\Requests\VerifyRequest;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /** @var AnketResultService */
    private $anketResultService;

    /** @var AnketAccessService */
    private $anketAccessService;

    /**
     * Create a new controller instance.
     *
     * @param AnketResultService $anketResultService
     * @param AnketAccessService $anketAccessService
     * @return void
     */
    public function __construct(AnketResultService $anketResultService, AnketAccessService $anketAccessService)
    {
        $this->anketResultService = $anketResultService;
        $this->anketAccessService = $anketAccessService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show Anket view
     *
     * @param mixed $anketId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function anket($anketId)
    {
        $editMode         = null;
        $historyId        = null;
        $anketDescription = config('consts.anketdescription');

        if (session()->has('ANKET_ID') && session()->has('DOCTOR_ID')) {
            $anketId = Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $anketId);

            return view('frontend.anket.' . $anketId, compact('editMode', 'historyId', 'anketDescription', 'anketId'));
        } elseif (session()->has('PATIENT_ID')) {
            // Check authorize for Anket for login
            $result = $this->anketAccessService->searchFirstAnket(['id' => session('PATIENT_ID')]);
            if (isset($result) && $result->anket_id === $anketId) {
                $anketId = Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $anketId);

                return view('frontend.anket.' . $anketId, compact('editMode', 'historyId', 'anketDescription', 'anketId'));
            }
        }
        abort(404);
    }

    /**
     * Show Anket Result
     *
     * @param $request Illuminate\Http\Request
     * @param $resultId string
     *
     * @return view
     */
    public function edit(Request $request, $resultId)
    {
        if (\Auth::user()) {
            $editMode  = true;
            $historyId = null;
            $result    = $this->anketResultService->getAnketResult($resultId);
            if (!isset($result)) {
                abort(404);
            }
            $this->isValid($result['hospital_id']);
            session(['ANKET_RESULT_ID' => $result->id]);
            $anketDescription = config('consts.anketdescription');

            $anketId = Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $result->anket_id);

            return view('frontend.anket.' . $anketId, compact('result', 'editMode', 'historyId', 'anketDescription', 'anketId'));
        }
        abort(404);
    }

    /**
     * Show Anket Result
     *
     * @param $request Illuminate\Http\Request
     * @param $resultId string
     * @param mixed $historyId
     *
     * @return view
     */
    public function view(Request $request, $historyId, $resultId)
    {
        if (\Auth::user()) {
            $editMode = false;
            $result   = $this->anketResultService->getAnketResult($resultId);
            if (!isset($result)) {
                abort(404);
            }
            $this->isValid($result->hospital_id);
            session(['ANKET_RESULT_ID' => $result->id]);
            session(['ANKET_HISTORY_ID' => $historyId]);
            $anketDescription = config('consts.anketdescription');
            $anketId          = Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $result->anket_id);

            return view('frontend.anket.' . $anketId, compact('result', 'editMode', 'historyId', 'anketDescription', 'anketId'));
        }
        abort(404);
    }

    /**
     * header
     *
     * @param mixed $anketId
     * @return void
     */
    public function pageHeader($anketId)
    {
        $anketDescription = config('consts.anketdescription');

        return view('frontend.anket.pheader', compact('anketDescription', 'anketId'));
    }

    /**
     * Show verify doctor name page
     *
     * @return view
     */
    public function show()
    {
        return view('frontend.verify');
    }

    /**
     * Verify Anket access
     *
     * @param VerifyRequest $request
     * @return view
     */
    public function verify(VerifyRequest $request)
    {
        if (!session()->has('ANKET_ID') || !session()->has('HOSPITAL_ID')) {
            abort(404);
        }

        $doctorName = $request->parameters()['doctorName'];
        $result     = $this->anketAccessService->verifyDoctor($doctorName, session('HOSPITAL_ID'));
        if (isset($result)) {
            session()->forget('ANKET_RESULT_ID');
            session(['DOCTOR_ID' => $result->id]);
            session(['DOCTOR_NAME' => $result->name]);

            return redirect()->route('anket.create', ['anketId' => session('ANKET_ID')]);
        }

        return redirect()->back()->withInput()->withErrors(['doctorName' => ['担当医名が存在していません。']]);
    }

    /**
     * Create print page for Patient
     *
     * @param int $id
     *
     * @return view
     */
    public function print($id)
    {
        if (\Auth::user()) {
            $anketAccess = $this->anketAccessService->getAnketById($id);
            $anketName   = config('consts.anketo.items.' . $anketAccess->anket_id);

            return view('voyager::anket-accesses.print', compact('anketAccess', 'anketName'));
        }
        abort(404);
    }

    /**
     * Check if hospital id belong to user
     *
     * @param int $hospital_id
     *
     * @return void
     */
    public function isValid($hospital_id)
    {
        $loginUser = \Auth::user();
        if (!$loginUser->hasRole('super')) {
            $hospitals = $loginUser->hospitals()->where('hospital_id', $hospital_id)->get();
            if ($hospitals->count() == 0) {
                abort(404);
            }
        }
    }
}
