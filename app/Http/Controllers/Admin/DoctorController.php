<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Services\AnketResultService;
use App\Services\DoctorService;
use App\Services\HospitalService;

class DoctorController extends Controller
{
    /** @var DoctorService */
    private $doctorService;

    /** @var HospitalService */
    private $hospitalService;

    public function __construct(DoctorService $doctorService, HospitalService $hospitalService, AnketResultService $anketResultService)
    {
        $this->doctorService      = $doctorService;
        $this->hospitalService    = $hospitalService;
        $this->anketResultService = $anketResultService;
    }

    /**
     * Doctor home page
     *
     * @return view
     */
    public function index()
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser)) {
            return redirect(route('login'));
        }

        $doctors     = $this->doctorService->getDoctors($loginUser);
        $hospitals   = $loginUser->hasRole('super')? $this->hospitalService->all() : $loginUser->hospitals()->get();
        $hospitalIds = $this->doctorService->getHospitalIds($loginUser);

        return view('vendor.voyager.users.browse', compact('doctors', 'hospitals', 'loginUser', 'hospitalIds'));
    }

    /**
     * Create doctor
     *
     * @param CreateDoctorRequest $request
     *
     * @return view
     */
    public function create(CreateDoctorRequest $request)
    {
        $this->doctorService->create($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.doctor') . __('anket.successfully_added_new'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Update Doctor
     *
     * @param UpdateDoctorRequest $request
     *
     * @return view
     */
    public function update(UpdateDoctorRequest $request)
    {
        $this->doctorService->update($request->parameters());

        return redirect()->back()->with([
            'message'    => __('anket.doctor') . __('anket.successfully_updated'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Delete doctor user
     *
     * @param int $id
     *
     * @return view
     */
    public function delete($id)
    {
        $anketResult = $this->anketResultService->getAnketResultByDoctorId($id);
        // If have anket belongs to this doctor then not allow to delete
        if ($anketResult->count() > 0) {
            return redirect()->back()->with([
                'message'    => _('anket.doctor') ._('anket.fail_del_by_anket'),
                'alert-type' => 'error',
            ]);
        }
        $this->doctorService->delete($id);

        return redirect()->back()->with([
            'message'    => __('anket.doctor') . __('anket.successfully_deleted'),
            'alert-type' => 'success',
        ]);
    }
}
