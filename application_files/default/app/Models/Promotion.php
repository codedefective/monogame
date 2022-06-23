<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Promotion
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string|null $amount
 * @property string|null $currency
 * @property int|null $quota
 * @property string|null $last_used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Promotion newModelQuery()
 * @method static Builder|Promotion newQuery()
 * @method static Builder|Promotion query()
 * @method static Builder|Promotion whereAmount($value)
 * @method static Builder|Promotion whereCreatedAt($value)
 * @method static Builder|Promotion whereCurrency($value)
 * @method static Builder|Promotion whereEndDate($value)
 * @method static Builder|Promotion whereId($value)
 * @method static Builder|Promotion whereLastUsedAt($value)
 * @method static Builder|Promotion whereQuota($value)
 * @method static Builder|Promotion whereStartDate($value)
 * @method static Builder|Promotion whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $code
 * @method static Builder|Promotion whereCode($value)
 * @property-read Collection|UserPromotion[] $users
 * @property-read int|null $users_count
 */
class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'code',
        'amount',
        'quota',
        'currency',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'last_used_at',
    ];

    protected $casts = [
        'amount' => 'int',
        'quota' => 'int'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UserPromotion::class,'promotion_id')->with('user');
    }
}
