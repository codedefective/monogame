<?php

namespace App\Repositories\Interfaces;

interface WalletTransactionRepositoryInterface extends BaseRepositoryInterface
{
    public function getTransactionByTransactionId(string $transactionId): array;
    public function getTransactionsByCurrency(string $currency): array;
    public function getTransactionsByGameCycle(string $gameCycle): array;
    public function getTransactionsByType(string $type): array;
    public function getPlayerTransactionsByPlayerId(int $player_id): array;
    public function getPlayerTransactionsByPlayerIdAndCurrency(int $player_id, string $currency): array;
    public function getPlayerDebitsByPlayerId(int $player_id): array;
    public function getPlayerCreditsByPlayerId(int $player_id): array;
    public function getPlayerRollbacksByPlayerId(int $player_id): array;
    public function getPlayerTransactionsByTypes(int $player_id, array $types): array;
    public function createDebit(int $playerId, string $transactionId, float $amount, string $gameCycle, string $currency, string $type = 'debit'): array;
    public function createCredit(int $playerId, string $transactionId, float $amount, string $gameCycle, string $currency, string $type = 'credit'): array;
    public function deposit(int $playerId, float $amount, string $currency, string $type = 'deposit'): array;
    public function withdraw(int $playerId, float $amount, string $currency, string $type = 'withdraw'): array;
}
