<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnketAccessRequest;
use App\Http\Requests\UpdateAnketAccessRequest;
use App\Http\Requests\CreateAnketInSurveyRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Requests\AnketAccessRequest;
use App\Services\AnketAccessService;
use App\Services\HospitalService;
use App\Services\DoctorService;
use Illuminate\Support\Facades\Log;

class AnketAccessController extends Controller
{
    /**
     * @var AnketAccessService
     */
    private $anketAccessService;

    /**
     * @var HospitalService
     */
    private $hospitalService;

    /**
     * @var DoctorService
     */
    private $doctorService;

    /**
     * AnketAccessController constructor
     *
     * @param AnketAccessService $anketAccessService
     * @param HospitalService $hospitalService
     * @param DoctorService $doctorService
     */
    public function __construct(AnketAccessService $anketAccessService, HospitalService $hospitalService, DoctorService $doctorService)
    {
        $this->anketAccessService = $anketAccessService;
        $this->hospitalService    = $hospitalService;
        $this->doctorService      = $doctorService;
    }

    /**
     * Patient home page
     *
     * @return view
     */
    public function index()
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser)) {
            return redirect(route('login'));
        }
        $hospitals     = $loginUser->hasRole('super')? $this->hospitalService->all() : $loginUser->hospitals()->get();
        $doctors       = $this->doctorService->getDoctors($loginUser);
        $anketAccesses = $this->anketAccessService->getAnketAccesses($loginUser);
        $anketTypes    = config('consts.anketo.items');

        return view('vendor.voyager.anket-accesses.browse', compact('hospitals', 'doctors', 'anketAccesses', 'anketTypes', 'loginUser'));
    }

    /**
     * Create new anket
     *
     * @param CreateAnketAccessRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateAnketAccessRequest $request)
    {
        $this->anketAccessService->create($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.patient') . __('anket.successfully_added_new'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Create new anket access with qr image
     *
     * @param CreateAnketInSurveyRequest $request
     * @throws \Throwable
     * @return \Illuminate\Http\JsonResponse
     */
    public function createWithSurvey(CreateAnketInSurveyRequest $request)
    {
        $params  = $request->parameters();
        $anketId = $params['anket_id'];
        $results = explode(config('consts.anketo.suffix_temporary'), $anketId);
        if (count($results) == 2) {
            return response()->json(['html' => view('admin.qrcode.qrCode', ['qr_code' => $anketId, 'hospital_id' => $params['hospital_id'], 'anket_id' => $params['sel_anket_id']])->render()]);
        }

        return response()->json(['html' => view('admin.qrcode.qrCode', ['qr_code' => 'login', 'hospital_id' => $params['hospital_id'], 'anket_id' => $params['sel_anket_id']])->render()]);
    }

    /**
     * Edit anket access
     *
     * @param UpdateAnketAccessRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(UpdateAnketAccessRequest $request)
    {
        $this->anketAccessService->updateAnket($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.patient') . __('anket.successfully_updated'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Update patient info
     *
     * @param $request
     *
     * @return json
     */
    public function updatePatient(UpdatePatientRequest $request)
    {
        try {
            $result = $this->anketAccessService->updatePatient($request->parameters());

            return response()->json(['status' => isset($result)? 'success' : 'existed']);
        } catch (\Exception $ex) {
            Log::info(get_class($this) . ':' . $ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }

        return response()->json(['status' => 'failed']);
    }

    /**
     * Delete anket access
     *
     * @param int $id
     * @return view
     */
    public function delete($id)
    {
        $this->anketAccessService->delete($id);

        return redirect()->back()->with([
            'message'    => __('anket.patient') . __('anket.successfully_deleted'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Load doctors by hospitalId
     *
     * @param AnketAccessRequest $request
     * @return json
     */
    public function loadDoctors(AnketAccessRequest $request)
    {
        $hospitalId = $request->parameters()['hospital_id'];
        if (isset($hospitalId)) {
            return response()->json($this->hospitalService->getDoctor($hospitalId)->toArray());
        }

        return response()->json([]);
    }
}
