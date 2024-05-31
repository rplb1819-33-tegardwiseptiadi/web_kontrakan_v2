<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'tabel_referensi' => 'users',
                'id_referensi' => null,
                'deskripsi' => 'Login Aplikasi',
            ]);
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            alert()->success("Login Berhasil", "Anda Berhasil Login !!!");
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);


        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            return $this->sendLoginResponse($request);
        } else {
            alert()->error("Login Gagal", "Anda Gagal Login !!!");
            return $this->sendFailedLoginResponse($request);
        }
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended('/homepage');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['required'=>'Email Anda Salah'],
            'password' => ['required'=>'Password Anda Salah'],
        ]);
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => '-',
            'id_referensi' => null,
            'deskripsi' => 'Logout Aplikasi',
        ]);

        Auth::logout();
        
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
           
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('main-home');
    }

    protected function loggedOut(Request $request)
    {
        alert()->success("Logout Berhasil", "Anda Berhasil Logout !!!");
    }
}
