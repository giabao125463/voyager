<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\AnketAccessService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $anketAccessService;
    /**
     * Create a new controller instance.
     *
     * @param AnketAccessService $anketAccessService
     * @return void
     */
    public function __construct(AnketAccessService $anketAccessService)
    {
        $this->middleware('guest')->except('logout');
        $this->anketAccessService = $anketAccessService;
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function signin(LoginRequest $request)
    {
        $input  = $request->only(['username', 'password']);
        $result = $this->anketAccessService->authenticate($input);
        if ($result) {
            return $this->anketAccessService->redirect();
        }

        return $this->login($request);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('super')) {
            return redirect()->route('voyager.users.index');
        }

        return redirect()->route('voyager.anket-accesses.index');
    }
}
