<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class WalletRepository extends BaseRepository implements Interfaces\WalletRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return Wallet::all()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            return Wallet::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function updateById(int $id, array $params): array
    {
        try {
            return [
                'status' => Wallet::findOrFail($id)->update($params)
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }catch (QueryException $exception){
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteById(int $id): array
    {
        try {
            return [
                'status' => Wallet::findOrFail($id)->delete()
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $currency
     * @return array
     */
    public function getWalletsByCurrency(string $currency): array
    {
        try {
            return Wallet::whereCurrency($currency)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @param string $currency
     * @return array
     */
    public function getWalletByPlayerIdAndCurrency(int $player_id, string $currency): array
    {
        try {
            return Wallet::wherePlayerId($player_id)->whereCurrency($currency)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $type
     * @return array
     */
    public function getWalletsByType(int $type): array
    {
        try {
            return Wallet::whereWalletType($type)->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @return array
     */
    public function getWalletsByPlayerId(int $player_id): array
    {
        try {
            return Wallet::wherePlayerId($player_id)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $playerId
     * @return array
     */
   public function getPlayerBalance(int $playerId): array
   {
       try {
           return  [
               'status' => true,
               'player_id' => $playerId,
               'balance' =>  Wallet::wherePlayerId($playerId)->firstOrFail()->balance
           ];
       }catch (ModelNotFoundException $exception){
           return ['status' => false, 'message' => self::NOT_FOUND_MSG];
       }
   }
}
