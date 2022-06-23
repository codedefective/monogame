<?php

namespace App\Http\Controllers\Api\Backoffice;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserManageController extends Controller
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return response()->json($this->repository->getAll());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        return response()->json($this->repository->getById($id));
    }

    /**
     * @param string $username
     * @return JsonResponse
     */
    public function getByUserName(string $username): JsonResponse
    {
        return response()->json($this->repository->getUserByUsername($username));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $valid = $request->validate([
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'firstname' => 'required',
                'lastname' => 'required',
                'password' => 'required'
            ]);

            $valid['password'] = Hash::make($valid['password']);
            return response()->json($this->repository->createUser($valid));
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

    /**
     * @param Request $request
     * @param int $user
     * @return JsonResponse
     */
    public function update(Request $request, int $user): JsonResponse
    {
        try {
            $valid = $request->validate([
                'username' => 'unique:users,username,'.$user,
                'email' => 'email|unique:users,email,'.$user,
                'firstname' => 'string',
                'lastname' => 'string',
                'password' => 'nullable',
            ]);

            if (isset($valid['password'])){
                $valid['password'] = Hash::make($valid['password']);
            }

            return response()->json($this->repository->updateById($user,$valid));
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

    /**
     * @param int $user
     * @return JsonResponse
     */
    public function delete(int $user): JsonResponse
    {
        return response()->json($this->repository->deleteById($user));
    }

}
