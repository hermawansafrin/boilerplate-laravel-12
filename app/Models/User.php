<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     schema="CreateUser",
 *
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          example="User Name"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          example="mail@mail.test"
 *     ),
 *     @OA\Property(
 *          property="role_id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="is_active",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="password",
 *          type="string",
 *          example="password"
 *     ),
 *     @OA\Property(
 *          property="password_confirmation",
 *          type="string",
 *          example="password"
 *     ),
 * )
 *
 * @OA\Schema(
 *     schema="UpdateUser",
 *
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          example="User Name"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          example="mail@mail.test"
 *     ),
 *     @OA\Property(
 *          property="role_id",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="is_active",
 *          type="integer",
 *          example="1"
 *     ),
 *     @OA\Property(
 *          property="password",
 *          type="string",
 *          example="password"
 *     ),
 *     @OA\Property(
 *          property="password_confirmation",
 *          type="string",
 *          example="password"
 *     ),
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
