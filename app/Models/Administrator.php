<?php

namespace App\Models;

use Database\Factories\AdministratorFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\Administrator
 *
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static AdministratorFactory factory(...$parameters)
 * @method static Builder|Administrator newModelQuery()
 * @method static Builder|Administrator newQuery()
 * @method static Builder|Administrator query()
 * @method static Builder|Administrator whereCreatedAt($value)
 * @method static Builder|Administrator whereEmail($value)
 * @method static Builder|Administrator whereEmailVerifiedAt($value)
 * @method static Builder|Administrator whereFirstname($value)
 * @method static Builder|Administrator whereId($value)
 * @method static Builder|Administrator whereLastname($value)
 * @method static Builder|Administrator wherePassword($value)
 * @method static Builder|Administrator whereRememberToken($value)
 * @method static Builder|Administrator whereUpdatedAt($value)
 * @method static Builder|Administrator whereUsername($value)
 * @mixin Eloquent
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 */
class Administrator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
