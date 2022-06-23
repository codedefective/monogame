<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $player_id
 * @property string|null $currency
 * @property int|null $wallet_type
 * @property string|null $host
 * @property string|null $balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Wallet newModelQuery()
 * @method static Builder|Wallet newQuery()
 * @method static Builder|Wallet query()
 * @method static Builder|Wallet whereBalance($value)
 * @method static Builder|Wallet whereCreatedAt($value)
 * @method static Builder|Wallet whereCurrency($value)
 * @method static Builder|Wallet whereHost($value)
 * @method static Builder|Wallet whereId($value)
 * @method static Builder|Wallet wherePlayerId($value)
 * @method static Builder|Wallet whereUpdatedAt($value)
 * @method static Builder|Wallet whereWalletType($value)
 * @mixin Eloquent
 */
class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'currency',
        'wallet_type',
        'host',
        'balance',
    ];
}
