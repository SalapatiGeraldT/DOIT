<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\V1\UserStoreRequest;
use App\Http\Requests\V1\UserLoginRequest;

use App\Http\Resources\V1\UserLoginResource;

use App\Repositories\V1\UserRepository;
use App\Interfaces\V1\Auth\AuthServiceInterface;

use Auth;

class AuthController extends Controller
{

    private $userRepository;
    private $authService;

    public function __construct(UserRepository $userRepository, AuthServiceInterface $authService)
    {
        $this->userRepository = $userRepository;
        $this->authService = $authService;
    }


    public function register(UserStoreRequest $request)
    {
        $data = $request->validated();
        $this->userRepository->storeUser($data);
        return response()->json('User Registered!');
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $apiTokenData = $this->authService->generateApiToken($user);

            return new UserLoginResource($apiTokenData);
        } 
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ]);
    }
}
