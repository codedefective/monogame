<?php

namespace App\Http\Controllers\Api\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'username' => ['required_without:email', 'string'],
                'email' => ['required_without:username', 'email'],
                'password' => ['required'],
            ]);

            $auth = Auth::guard('api');

            if ($auth->attempt($credentials)){
                /** @var User $user */
                $user = $auth->user();
                $token = $user->createToken('admin_api_token',['admin_api'])->plainTextToken;

                return response()->json([
                    'status' => true,
                    'admin_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ]);
            }else{
                throw new AuthenticationException(
                    'Unauthenticated!'
                );
            }
        }catch (Exception $exception){
            $response = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
            if($exception instanceof ValidationException){
                $response['errors'] = $exception->errors();
            }
            return response()->json($response);
        }
    }
}
