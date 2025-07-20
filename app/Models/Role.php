<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @OA\Schema(
 *     schema="CreateRole",
 *
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          example="New Role Name"
 *     ),
 *     @OA\Property(
 *          property="permission_ids",
 *          type="integer",
 *          example={1,2}
 *     ),
 * )
 *
 * @OA\Schema(
 *     schema="UpdateRole",
 *
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          example="New Role Update"
 *     ),
 *     @OA\Property(
 *          property="permission_ids",
 *          type="integer",
 *          example={1,2}
 *     ),
 * )
 */
class Role extends SpatieRole
{
    public const ADMINSTRATOR = 1;

    public const ADMINISTRATOR_NAME = 'Administrator';

    /**
     * @var array
     *            list of id cannot deletable
     */
    public const IDS_CANNOT_EDIT_OR_DELETE = [
        self::ADMINSTRATOR,
    ];

    /**
     * @var array
     *            list of name cannot allowed
     */
    public const NAMES_CANNOT_ALLOWED = [
        self::ADMINISTRATOR_NAME,
    ];

    /**
     * Get list of name cannot allowed
     */
    public static function getNamesCannotAllowed(): array
    {
        return self::NAMES_CANNOT_ALLOWED;
    }
}
