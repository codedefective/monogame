<?php

namespace App\Repositories\Interfaces;

interface PromotionInterface extends BaseRepositoryInterface
{
    public function setQuotaById(int $id, int $quota): array;
    public function assignPromotionToUserByPromoId(int $promo_id, int $user_id): array;
    public function assignPromotionToUserByPromoCode(string $code, int $user_id): array;
    public function revokePromotionToUserByPromoCode(string $code, int $user_id): array;
    public function generateCode(): string;
    public function createPromotion(array $params): array;


}
