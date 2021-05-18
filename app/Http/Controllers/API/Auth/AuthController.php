<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->only(['email','password']);

        if (Auth::attempt($credentials))
        {
             $user = Auth::user();
             $success['token'] = $user->createToken('test_ecommerce')->accessToken;
             $success['type']  = 'Bearer ';
             return response()->json(['data_token'=>$success]);
        }else{
            return response()->json(['error'=>'Wrong username/password combination.'],Response::HTTP_UNAUTHORIZED);
        }

    }

    public function register(UserStoreRequest $request, UserService $userService): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        return $userService->store($validatedData);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens->each(function($token,$key){
            $token->delete();
        });

        return response()->json('logged out successfully');
    }

}
