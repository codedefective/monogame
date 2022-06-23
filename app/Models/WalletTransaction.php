<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WalletTransaction
 *
 * @property int $id
 * @property int $player_id
 * @property string|null $currency
 * @property string|null $amount
 * @property string $type
 * @property string|null $transaction_id
 * @property string|null $game_cycle
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|WalletTransaction newModelQuery()
 * @method static Builder|WalletTransaction newQuery()
 * @method static Builder|WalletTransaction query()
 * @method static Builder|WalletTransaction whereAmount($value)
 * @method static Builder|WalletTransaction whereCreatedAt($value)
 * @method static Builder|WalletTransaction whereCurrency($value)
 * @method static Builder|WalletTransaction whereGameCycle($value)
 * @method static Builder|WalletTransaction whereId($value)
 * @method static Builder|WalletTransaction wherePlayerId($value)
 * @method static Builder|WalletTransaction whereTransactionId($value)
 * @method static Builder|WalletTransaction whereType($value)
 * @method static Builder|WalletTransaction whereUpdatedAt($value)
 * @mixin Eloquent
 * @property array|null $detail
 * @method static Builder|WalletTransaction whereDetail($value)
 */
class WalletTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
       'player_id',
       'currency',
       'amount',
       'type',
       'transaction_id',
       'game_cycle',
       'detail',
    ];

    protected $casts = [
        'detail' => 'array'
    ];
}
