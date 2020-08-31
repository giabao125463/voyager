<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnketRequest;
use App\Services\AnketResultService;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    /** @var AnketResultService */
    private $anketResultService;

    /**
     * SurveyController constructor.
     *
     * @param AnketResultService $anketResultService
     */
    public function __construct(AnketResultService $anketResultService)
    {
        $this->anketResultService = $anketResultService;
    }

    public function submit(AnketRequest $request)
    {
        try {
            $execSuccess = $this->anketResultService->create($request);
            switch ($execSuccess) {
                case 'update':
                    $historyId = session('ANKET_HISTORY_ID');
                    session()->forget('ANKET_HISTORY_ID');

                    return isset($historyId)? redirect()->route('anket_result.history', ['id' => $historyId]) : redirect('/admin/anket-results');
                case 'create':
                    return view('frontend.done');
                default:
                    break;
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage() . ' ' . $ex->getLine() . ' ' . $ex->getFile());
        }

        return redirect()->back()->withErrors(['errInsert', 'アンカーデータの送信に失敗しました。']);
    }
}
