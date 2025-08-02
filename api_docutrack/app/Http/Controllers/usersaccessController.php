<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users_access;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class usersaccessController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users_access,email',
            'cedula' => 'required|string|unique:users_access,cedula',
            'pass' => 'required|string|min:6',
            'nacimiento' => 'required|date',
            'tipo_usuario' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Users_access::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'cedula' => $request->cedula,
            'pass' => Hash::make($request->pass),
            'nacimiento' => $request->nacimiento,
            'tipo_usuario' => $request->tipo_usuario
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'pass');
        
        // Verificación  alternativa
        $user = \App\Models\Users_access::where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['pass'], $user->pass)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        
        // Generación token
        if (!$token = auth('api')->login($user)) {
            return response()->json(['error' => 'No se pudo generar el token'], 500);
        }
        
        return $this->respondWithToken($token, [
            'tipo_usuario' => $user->tipo_usuario
        ]);
    }

    public function me(){
        $keys = ['pass', 'created_at', 'updated_at'];

        $data = response()->json(auth()->user());
        $arry = json_decode($data->getContent(), true);

        foreach ($keys as $key) {
            if (isset($arry[$key])) {
                unset($arry[$key]);
            }
        }

        $check = count($arry);
        if ($check == 0) {
            return null;
        }

        return json_encode($arry);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    public function refreshToken(Request $request)
    {
        try {
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json(['error' => 'Token no proporcionado'], 400);
            }

            $newToken = JWTAuth::setToken($token)->refresh();
            
            return $this->respondWithToken($newToken);
            
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'No se pudo refrescar el token',
                'details' => $e->getMessage()
            ], 401);
        }
    }

    protected function respondWithToken($token, $data = []){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,

            'user' => array_merge(['id' => auth()->user()->id], $data)
        ]);
    }

}
