<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\ApiController;
use App\Services\AuthService;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthController extends ApiController
{
    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->AuthService->register($request->validated());
            return $this->created(new UserResource($user), 'User registered successfully');
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errors(),
            ], 422);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $token = $this->AuthService->login($request->validated());
            return $this->ok([
                'token' => $token
            ], 'User logged in successfully');
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errors(),
            ], 401);
        }
    }

    public function logout(Request $request)
{
    try {
        $user = $request->user();
        if (!$user) {
            return $this->error('User not authenticated', 401);
        }

        $response = $this->AuthService->logout($user);
        return $this->ok($response, $response['message']);
    } catch (\Exception $e) {
        return $this->error('An error occurred during logout.', 500);
    }
}

}
