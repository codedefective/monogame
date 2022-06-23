<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Throwable;

class WalletTransactionsRepository extends BaseRepository implements Interfaces\WalletTransactionRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array
    {
        return WalletTransaction::all()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            return WalletTransaction::findOrFail($id)->toArray();
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
                'status' => WalletTransaction::findOrFail($id)->update($params)
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
                'status' => WalletTransaction::findOrFail($id)->delete()
            ];
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $transactionId
     * @return array
     */
    public function getTransactionByTransactionId(string $transactionId): array
    {
        try {
            return WalletTransaction::whereTransactionId($transactionId)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $currency
     * @return array
     */
    public function getTransactionsByCurrency(string $currency): array
    {
        try {
            return WalletTransaction::whereCurrency($currency)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $gameCycle
     * @return array
     */
    public function getTransactionsByGameCycle(string $gameCycle): array
    {
        try {
            return WalletTransaction::whereGameCycle($gameCycle)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param string $type
     * @return array
     */
    public function getTransactionsByType(string $type): array
    {
        try {
            return WalletTransaction::whereType($type)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @return array
     */
    public function getPlayerTransactionsByPlayerId(int $player_id): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @param string $currency
     * @return array
     */
    public function getPlayerTransactionsByPlayerIdAndCurrency(int $player_id, string $currency): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->whereCurrency($currency)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @return array
     */
    public function getPlayerDebitsByPlayerId(int $player_id): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->whereType('debit')->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @return array
     */
    public function getPlayerCreditsByPlayerId(int $player_id): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->whereType('credit')->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $player_id
     * @return array
     */
    public function getPlayerRollbacksByPlayerId(int $player_id): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->whereType('rollback')->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    public function getPlayerTransactionsByTypes(int $player_id, array $types): array
    {
        try {
            return WalletTransaction::wherePlayerId($player_id)->whereType($types)->firstOrFail()->toArray();
        }catch (ModelNotFoundException $exception){
            return ['status' => false, 'message' => self::NOT_FOUND_MSG];
        }
    }

    /**
     * @param int $playerId
     * @param string $transactionId
     * @param float $amount
     * @param string $gameCycle
     * @param string $currency
     * @param string $type
     * @return array
     * @throws Throwable
     */
    public function createDebit(int $playerId, string $transactionId, float $amount, string $gameCycle, string $currency, string $type = 'debit'): array
    {
        return $this->incrementOrDecrement($playerId, $transactionId, $amount, $gameCycle, $currency, $type);
    }

    /**
     * @param int $playerId
     * @param string $transactionId
     * @param float $amount
     * @param string $gameCycle
     * @param string $currency
     * @param string $type
     * @return array
     * @throws Throwable
     */
    public function createCredit(int $playerId, string $transactionId, float $amount, string $gameCycle, string $currency, string $type = 'credit'): array
    {
        return $this->incrementOrDecrement($playerId, $transactionId, $amount, $gameCycle, $currency, $type);
    }

    /**
     * @throws Throwable
     */
    public function deposit(int $playerId, float $amount, string $currency, string $type = 'deposit'): array
    {
        return $this->incrementOrDecrement($playerId, '', $amount, '', $currency, $type);
    }

    /**
     * @throws Throwable
     */
    public function withdraw(int $playerId, float $amount, string $currency, string $type = 'withdraw'): array
    {
        return $this->incrementOrDecrement($playerId, '', $amount, '', $currency, $type);
    }

    /**
     * @param int $playerId
     * @param string $transactionId
     * @param float $amount
     * @param string $gameCycle
     * @param string $currency
     * @param string $type
     * @return array
     * @throws Throwable
     */
    private function incrementOrDecrement(int $playerId, string $transactionId, float $amount, string $gameCycle, string $currency, string $type): array
    {
        $amount = abs($amount);
        $amount = in_array($type,['debit','withdraw']) ? ($amount * -1) : $amount;
        try {
            DB::beginTransaction();
            $credit = (new WalletTransaction())->create([
                'player_id' => $playerId,
                'transaction_id' => $transactionId,
                'amount' => $amount,
                'game_cycle' => $gameCycle,
                'currency' => $currency,
                'type' => $type,
            ])->toArray();
            Wallet::wherePlayerId($playerId)->whereCurrency($currency)->firstOrFail()->increment('balance',$amount);
            DB::commit();
            return [
                'status' => true,
                'data' => $credit
            ];
        }catch (QueryException $exception){
            DB::rollback();
            return ['status' => false, 'message' => $exception->getMessage()];
        } catch (Throwable $exception) {
            DB::rollback();
            return ['status' => false, 'message' => $exception->getMessage()];
        }
    }
}
