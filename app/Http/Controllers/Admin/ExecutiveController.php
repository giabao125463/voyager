<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExecutiveUpdateRequest;
use App\Http\Requests\ExecutiveCreateRequest;
use App\Services\ExcecutiveService;
use Illuminate\Http\Request;
use App\Services\UserService;

class ExecutiveController extends Controller
{
    /** @var ExcecutiveService $excecutiveService */
    private $excecutiveService;

    /**
     * ExecutiveController Controller constructor.
     *
     * @param ExcecutiveService $excecutiveService
     * @param UserService $userService
     */
    public function __construct(ExcecutiveService $excecutiveService, UserService $userService)
    {
        $this->middleware('super.admin');
        $this->excecutiveService = $excecutiveService;
        $this->userService       = $userService;
    }

    /**
     * Executive home page
     *
     * @param Request $request
     *
     * @return view
     */
    public function index(Request $request)
    {
        $users = $this->userService->all();

        return view('vendor.voyager.executives.browse', compact("users"));
    }
    /**
     * Create Executives
     *
     * @param CreateDoctorRequest $request
     *
     * @return view
     */
    public function create(ExecutiveCreateRequest $request)
    {
        $input = $request->only(['username', 'doctor_password']);
        $this->excecutiveService->create($input);

        return redirect()->back()->with([
            'message'    => __('anket.executives') . __('anket.successfully_added_new'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Update Executives information
     *
     * @param UpdateDoctorRequest $request
     *
     * @return view
     */
    public function update(ExecutiveUpdateRequest $request)
    {
        $input = $request->only(['doctor_password','id']);
        $this->excecutiveService->update($input);

        return redirect()->back()->with([
            'message'    => __('anket.executives') . __('anket.successfully_updated'),
            'alert-type' => 'success',
        ]);
    }
}
