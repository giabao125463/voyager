<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnketResultService;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchAnketResultRequest;
use App\Services\HospitalService;

class AnketResultController extends Controller
{
    /**
     * @var anketResultService
     */
    private $anketResultService;

    public function __construct(AnketResultService $anketResultService, HospitalService $hospitalService)
    {
        $this->anketResultService = $anketResultService;
        $this->hospitalService    = $hospitalService;
    }

    /**
     * Anket result home page
     *
     * @param SearchAnketResultRequest $request
     *
     * @return view
     */
    public function index(SearchAnketResultRequest $request)
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser)) {
            return redirect(route('login'));
        }

        $anketResults = $this->anketResultService->search($request->parameters());
        $anketTypes   = config('consts.anketo.qrcode');

        if ($loginUser->hasRole('super')) {
            $hospitals = $this->hospitalService->all();
        } else {
            $hospitals = $loginUser->hospitals()->get();
        }

        return view('vendor.voyager.anket-results.browse', compact('anketResults', 'anketTypes', 'hospitals'));
    }

    /**
     * History page
     *
     * @param int $id
     *
     * @return view
     */
    public function history($id)
    {
        $anketResults = $this->anketResultService->getAnketResultsByAnketAccessId($id);
        if ($anketResults->count() > 0) {
            $this->isValid($anketResults->first()->hospital_id);
        }
        $anketTypes = config('consts.anketo.qrcode');
        $historyId  = $id;

        return view('vendor.voyager.anket-results.history', compact('anketResults', 'anketTypes', 'historyId'));
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

    /**
     * Download CSV anket result
     *
     * @param SearchAnketResultRequest $request
     * @param string $anket_id
     *
     * @return CSV download
     */
    public function export(SearchAnketResultRequest $request, $anket_id)
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser)) {
            return redirect(route('login'));
        }

        return $this->anketResultService->exportCSV($request->parameters(), $anket_id);
    }
}
