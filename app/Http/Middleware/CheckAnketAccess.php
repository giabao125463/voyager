<?php

namespace App\Http\Middleware;

use App\Services\AnketAccessService;
use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckAnketAccess extends Middleware
{
    private $anketAccessService;
    /**
     * Create a new middleware instance.
     *
     * @param AnketAccessService $anketAccessService
     * @return void
     */
    public function __construct(AnketAccessService $anketAccessService)
    {
        $this->anketAccessService = $anketAccessService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()) {
            return $next($request);
        }
        if (!session()->has('ANKET_ID') && !session()->has('DOCTOR_ID')) {
            $result = $this->anketAccessService->validateSession();
            if (!$result) {
                abort(404);
            }
        }
        $routeName = $request->route()->getName();

        return ($routeName == 'anket.create' || $routeName == 'anket.view' || $routeName == 'anket.submit')?  $next($request) : abort(404);
    }
}
