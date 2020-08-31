<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnketAccessRequest;
use App\Http\Requests\SearchAnketQRRequest;
use App\Repositories\AnketAccessRepository;
use App\Services\AnketAccessService;
use App\Services\HospitalService;
use Symfony\Component\HttpFoundation\Request;
use Session;

class AnketController extends Controller
{
    /**
     * @var AnketAccessService
     */
    private $anketAccessService;

    /**
     * AnketController constructor.
     * @param AnketAccessService $anketAccessService
     * @param HospitalService $hospitalService
     */
    public function __construct(AnketAccessService $anketAccessService, HospitalService $hospitalService)
    {
        $this->anketAccessService = $anketAccessService;
        $this->hospitalService    = $hospitalService;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchAnketQRRequest $request)
    {
        $loginUser = \Auth::user();
        if (!isset($loginUser)) {
            return redirect(route('login'));
        }

        if ($loginUser->hasRole('super')) {
            $hospitalsList = $this->hospitalService->all();
        } else {
            $hospitalsList = $loginUser->hospitals()->get();
        }
        $param = $request->parameters();
        if (!empty($param['hospitals']) && $param['hospitals'] != 'all') {
            $hospitalSearch = $this->hospitalService->search($param['hospitals']);
        } else {
            $hospitalSearch = $hospitalsList;
        }
        $anketTypes = config('consts.anketo.qrcode');

        return view('admin.ankets.index', compact('hospitalsList', 'hospitalSearch', 'anketTypes'));
    }

    /**
     * QRcode page
     *
     * @param Request $request
     * @param string $qr_code
     * @param int $hospital_id
     * @param string $anket_id
     * @return string|null
     */
    public function qrCodeGen(Request $request, $qr_code, $hospital_id, $anket_id)
    {
        if ($qr_code == 'login') {
            session(['SEL_ANKET_ID' => $anket_id]);
            // Redirect to login page
            return redirect(route('login'));
        }

        // Redirect to verify docter name
        session([
            'ANKET_ID'    => $qr_code,
            'HOSPITAL_ID' => $hospital_id
        ]);

        return redirect(route('anket.verify'));
    }
}
