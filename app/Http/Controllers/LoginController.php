<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	
    public function index()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('/admin');
        }
        // Si no hay sesión activa mostramos el formulario
		return view('login');
    }
	
	public function postLogin()
    {
        // Obtenemos los datos del formulario
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
				'type' => 'error',
				'msg'  => 'Sin Autorizacion'
			]);
        }
		
		setcookie("jwt_token", $token);

        return response()->json([
			'type' => 'success',
			'token' => $this->respondWithToken($token),
			'user' => auth()->user()
		], 200);

	}
	
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
		
		setcookie("jwt_token", '');

		return response()->json(['success' => true]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
	
	public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
