<?php

namespace App\Http\Controllers\Api\Backoffice;

use App\Http\Controllers\Controller;
use App\Repositories\PromotionRepository;
use ErrorException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class PromotionController extends Controller
{

    private PromotionRepository $repository;
    static string $dateFormat = 'date_format:Y-m-d H:i';
    static string $minVal = 'min:1';
    public function __construct(PromotionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->repository->getAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function  find(int $id): array
    {
        return $this->repository->getById($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function  create(Request $request): JsonResponse
    {
        try {

            $valid = $request->validate([
                'start_date' => ['required', self::$dateFormat],
                'end_date' => ['required', self::$dateFormat],
                'amount' => ['required', 'numeric', self::$minVal],
                'quota' => ['required', 'numeric', self::$minVal],
            ]);

            $create = $this->repository->createPromotion($valid);
            if ($create['status']){
                $create =  [
                    'code' => $create['data']['code']
                ];
            }
            return response()->json($create);
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
     * @param int $promotion_id
     * @return JsonResponse
     */
    public function update(Request $request, int $promotion_id): JsonResponse
    {
        try {

            $validData = $request->validate([
                'start_date' => [self::$dateFormat],
                'end_date' => [self::$dateFormat],
                'amount' => ['numeric', self::$minVal],
                'quota' => ['numeric', self::$minVal],
            ]);

            $promo = $this->repository->getById($promotion_id);

            if (!empty($promo['data']['users'])){
                throw new ErrorException('Used Promotions Cannot Be Updated!');
            }

            $update = $this->repository->updateById($promotion_id,$validData);

            return response()->json($update);
        }catch (Exception $exception){
            $response = [
                'success' => false,
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
     * @return JsonResponse
     * @throws Throwable
     */
    public function assignToUser(Request $request): JsonResponse
    {
        try {
            $validData = $request->validate([
                'code' => ['required', 'size:12', 'exists:promotions,code'],
            ]);

            $user_id = $request->user()->id;
            $assign = $this->repository->assignPromotionToUserByPromoCode($validData['code'], $user_id);
            if ($assign['status']){
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false,'message' => $assign['message']]);
        }catch (Exception $exception){
            $response = [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
            if($exception instanceof ValidationException){
                $response['errors'] = $exception->errors();
            }
            return response()->json($response);
        }
    }
}
