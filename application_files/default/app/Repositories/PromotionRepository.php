<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\UserPromotion;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use DateTime;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Str;
use Throwable;
use Whoops\Exception\ErrorException;

class PromotionRepository extends BaseRepository implements Interfaces\PromotionInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        try {
            $all = Promotion::with('users')->get()->toArray();
            $data =  array_map(function ($promotion){
                $users = array_map(function ($user){
                    return $user['user'];
                },$promotion['users']);
                $promotion['users'] = $users;
                return $promotion;
            },$all);
            return [
                'success' => true,
                'data' => $data
            ];
        }catch (Exception $exception){
            return [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
    }

    public function getById(int $id): array
    {
        try {
            $promotion = Promotion::with('users')->whereId($id)->firstOrFail()->toArray();
            $users = array_map(function ($user){
                return $user['user'];
            },$promotion['users']);
            $promotion['users'] = $users;

            return ['success' => true, 'data' => $promotion];
        }catch (ModelNotFoundException $exception){
            return ['success' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (Exception $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }

    }
    public function deleteById(int $id): array
    {
        return [];
    }

    public function updateById(int $id, array $params): array
    {
        try {
            return [
                'status' => Promotion::findOrFail($id)->update($params)
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function setQuotaById(int $id, int $quota): array
    {
        return $this->updateById($id,[
            'quota' => $quota
        ]);
    }

    public function assignPromotionToUserByPromoId(int $promo_id, int $user_id): array
    {
        try {
            /** @var Promotion $promotion */
            $promotion = Promotion::with('users')->find($promo_id)->firstOrFail();
            $response = $this->assignPromotionToUserByPromoCode($promotion->code,$user_id);
        }catch (ModelNotFoundException $exception){
            $response = ['success' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (Exception $exception){
            $response = ['success' => false, 'message' => $exception->getMessage()];
        } catch (Throwable $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
       return $response;
    }


    /**
     * @param string $code
     * @param int $user_id
     * @param bool $increment
     * @return array
     * @throws Throwable
     */
    public function assignPromotionToUserByPromoCode(string $code, int $user_id, bool $increment = true): array
    {
        try {
            $promo = Promotion::whereCode($code)->firstOrFail();

            $now =  new DateTime(now());
            $start_date = new DateTime($promo->start_date);
            $end_date = new DateTime($promo->end_date);
            $notYet = $now->diff($start_date)->invert === 0;
            $notExpired = $now->diff($end_date)->invert === 0;

            if ($notYet){
                throw new ErrorException('You cannot use this promotion yet');
            }
            if (!$notExpired){
                throw new ErrorException('This promotion has expired');
            }

            if ($increment && $promo->quota < 1){
                throw new ErrorException('The quota of the coupon is not enough');
            }
            $userPromotion = UserPromotion::whereUserId($user_id)->wherePromotionId($promo->id)->exists();
            if ($userPromotion){
                return ['status' => false, 'message' => 'Already Appended This User!'];
            }
            DB::beginTransaction();
            $promoAmount = $increment ? $promo->amount : ($promo->amount * -1);
            $credit = (new WalletTransaction())->create([
                'player_id' => $user_id,
                'amount' => $promoAmount,
                'currency' => $promo->currency,
                'type' => 'promotion',
                'detail' => [
                    'promotion_id' => $promo->id,
                    'promotion_code' => $code,
                ],

            ])->toArray();

            Wallet::wherePlayerId($user_id)->whereCurrency($promo->currency)->firstOrFail()->increment('balance',$promoAmount);
            (new UserPromotion())->create([
                'user_id' => $user_id,
                'promotion_id' => $promo->id
            ]);

            $promo->increment('quota', $increment ? -1 : 1);
            DB::commit();
            $response = [
                'status' => true,
                'data' => $credit
            ];
        }catch (QueryException $exception){
            DB::rollback();
            $response = ['status' => false, 'message' => $exception->getMessage()];
        } catch (Throwable $exception) {
            DB::rollback();
            $response =['status' => false, 'message' => $exception->getMessage()];
        }
        return $response;
    }

    /**
     * @throws Throwable
     */
    public function revokePromotionToUserByPromoCode(string $code, int $user_id): array
    {
        return $this->assignPromotionToUserByPromoCode($code,$user_id, false);
    }

    public function createPromotion(array $params): array
    {
        try {
            $params['code'] = $this->generateCode();
            return [
                'status' => true,
                'data' => (new Promotion())->create($params)->toArray()
            ];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function generateCode(): string
    {
        do {
            $promoCode = strtoupper(Str::random(12));
        }while (Promotion::whereCode($promoCode)->exists());

        return $promoCode;
    }
}
