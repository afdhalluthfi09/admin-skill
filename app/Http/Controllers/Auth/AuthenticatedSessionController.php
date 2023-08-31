<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        dd($request->all());
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function masuk (Request $request)
    {
        // dd($request->all());

        $validate = Validator::make($request->all(),[
            "email" =>"required|email",
            "password" =>"required"
        ]);

        if($validate->fails())
        {
            return response()->json([
                "success" => false,
                "message" => "Ada Yang Salah",
                "data" =>$validate->errors()
            ]);
        }else {
            try {
                //code...
                $response = Http::post('http://sekolahskillapi.test/api/admin/login', [
                    'email' => $request->email,
                    'password' =>$request->password
                ]);
                $data =$response->json();
                // dd($data);
                $dataResponse =$data["data"];
                Session::put('user',$dataResponse);
                Session::put('tokenId',$dataResponse["token"]);
                // dd($response->ok());
                if($response->successful())
                {
                    return redirect()->route('dashboard');
                }else{
                    return response()->json([
                        "data" =>"belum cocok"
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }
        }


    }
}
