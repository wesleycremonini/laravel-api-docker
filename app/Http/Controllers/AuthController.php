<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response as Status;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            $error = $request->validator->errors()->messages();
            return response()->json($error, Status::HTTP_BAD_REQUEST);
        }

        $user = User::create($request->all());
        return response()->json($user, Status::HTTP_CREATED);
    }
}
