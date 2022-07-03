<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Traits\ValidationErrorsResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as Status;

class AuthController extends Controller
{
    use ValidationErrorsResponseTrait;


    public function __construct(private AuthService $service)
    {
        $this->service = $service;
    }


    public function register(RegisterRequest $request)
    {
        if ($request->validator->fails()) return $this->errors($request);

        $user = User::create(["name" => $request->name, "password" => Hash::make($request->password)]);
        return response()->json(['user' => $user], Status::HTTP_CREATED);
    }


    public function login(LoginRequest $request)
    {
        if ($request->validator->fails()) return $this->errors($request);

        if (!Auth::attempt($request->only('name', 'password'), $request->filled('remember'))) {
            return response()->json(['error' => 'Dados invalidos.'], Status::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = Auth::user();

        $jwt = $user->createToken('authToken')->plainTextToken;

        $cookie = cookie('jwt', $jwt, 60 * 24);

        return response()->json(['jwt' => $jwt], Status::HTTP_OK)->withCookie($cookie);
    }


    public function user()
    {
        return response()->json(['user' => Auth::user()], Status::HTTP_OK);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response()->json(['message' => 'Logout realizado com sucesso.'], Status::HTTP_OK)->withCookie($cookie);
    }
}
