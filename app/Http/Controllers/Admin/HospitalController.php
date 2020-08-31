<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalUpdateRequest;
use App\Http\Requests\HospitalCreateRequest;
use App\Services\HospitalService;
use App\Models\Hospital;
use App\Services\AnketResultService;

class HospitalController extends Controller
{
    /**
     * @var HospitalService
     */
    private $hospitalService;

    /**
     * HospitalController constructor
     * @param HospitalService $hospitalService
     * @param AnketResultService $anketResultService
     */
    public function __construct(HospitalService $hospitalService, AnketResultService $anketResultService)
    {
        $this->middleware('super.admin');
        $this->hospitalService    = $hospitalService;
        $this->anketResultService = $anketResultService;
    }

    /**
     * Hospital home page
     *
     * @return view
     */
    public function index()
    {
        $hospitals  = $this->hospitalService->all();
        $anketTypes = config('consts.anketo.items');

        return view('vendor.voyager.hospitals.browse', compact('hospitals', 'anketTypes'));
    }

    /**
     * Create new Hospital
     *
     * @param HospitalCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(HospitalCreateRequest $request)
    {
        $this->hospitalService->create($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.hospital') . __('anket.successfully_added_new'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Edit Hospital
     *
     * @param HospitalUpdateRequest $request
     * @param Hospital $hospital
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(HospitalUpdateRequest $request, Hospital $hospital)
    {
        $this->hospitalService->update($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.hospital') . __('anket.successfully_updated'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Delete Hospital
     *
     * @param int $id
     *
     * @return view
     */
    public function delete($id)
    {
        $doctor      = $this->hospitalService->getDoctor($id);
        $anketResult = $this->anketResultService->getAnketResultByHospitalId($id);

        // If have doctor belongs to this hospital then not allow to delete
        if ($doctor->count() > 0) {
            return redirect()->back()->with([
                'message'    => __('anket.hospital') .__('anket.fail_del_by_doctor'),
                'alert-type' => 'error',
            ]);
        }
        // If have anket belongs to this hospital then not allow to delete
        if ($anketResult->count() > 0) {
            return redirect()->back()->with([
                'message'    => __('anket.hospital') .__('anket.fail_del_by_anket'),
                'alert-type' => 'error',
            ]);
        }

        $this->hospitalService->delete($id);

        return redirect()->back()->with([
            'message'    => __('anket.hospital') . __('anket.successfully_deleted'),
            'alert-type' => 'success',
        ]);
    }
}
