<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserPromotion
 *
 * @property int $id
 * @property int $user_id
 * @property int $promotion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserPromotion newModelQuery()
 * @method static Builder|UserPromotion newQuery()
 * @method static Builder|UserPromotion query()
 * @method static Builder|UserPromotion whereCreatedAt($value)
 * @method static Builder|UserPromotion whereId($value)
 * @method static Builder|UserPromotion wherePromotionId($value)
 * @method static Builder|UserPromotion whereUpdatedAt($value)
 * @method static Builder|UserPromotion whereUserId($value)
 * @mixin Eloquent
 * @property-read User|null $user
 */
class UserPromotion extends Model
{
    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id')->with('wallet');
    }

    protected $fillable = [
        'user_id',
        'promotion_id'
    ];
}
