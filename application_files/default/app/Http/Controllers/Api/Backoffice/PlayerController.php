<?php

namespace App\Http\Controllers\Api\Backoffice;

use App\Http\Controllers\Controller;
use App\Repositories\WalletTransactionsRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class PlayerController extends Controller
{
    private WalletTransactionsRepository $repository;

    /**
     * @param WalletTransactionsRepository $repository
     */
    public function __construct(WalletTransactionsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deposit(Request $request): JsonResponse
    {
        try {
            $validData = $request->validate([
                'player_id' => ['required', 'exists:users,id'],
                'amount' => ['required', 'numeric'],
                'currency' => ['required', 'string'],
            ]);

            $response =  $this->repository->deposit($validData['player_id'],$validData['amount'],$validData['currency']);
        }catch (Exception $exception){
            $response = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
            if($exception instanceof ValidationException){
                $response['errors'] = $exception->errors();
            }
        } catch (Throwable $exception) {
            $response = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }
        return response()->json($response);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function withdraw(Request $request): JsonResponse
    {
        try {
            $validData = $request->validate([
                'player_id' => ['required', 'exists:users,id'],
                'amount' => ['required', 'numeric'],
                'currency' => ['required', 'string'],
            ]);

            $response =  $this->repository->withdraw($validData['player_id'],$validData['amount'],$validData['currency']);
        }catch (Exception $exception){
            $response = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
            if($exception instanceof ValidationException){
                $response['errors'] = $exception->errors();
            }
        } catch (Throwable $exception) {
            $response = [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }

        return response()->json($response);
    }

}
