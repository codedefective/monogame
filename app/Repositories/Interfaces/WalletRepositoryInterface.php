<?php

namespace App\Repositories\Interfaces;

interface WalletRepositoryInterface extends BaseRepositoryInterface
{
    public function getWalletsByCurrency(string $currency): array;
    public function getWalletByPlayerIdAndCurrency(int $player_id, string $currency): array;
    public function getWalletsByType(int $type): array;
    public function getWalletsByPlayerId(int $player_id): array;
    public function getPlayerBalance(int $playerId): array;
}
