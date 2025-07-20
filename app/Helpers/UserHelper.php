<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper
{
    /**
     * get auth user
     */
    public static function getAuthUser(): ?User
    {
        $authUser = auth()->user() ?? null;

        return $authUser;
    }

    /**
     * get user data logged in user
     */
    public static function getUserData(): array
    {
        $datas = [];
        $authUser = self::getAuthUser();

        if ($authUser === null) {
            return $datas;
        }

        $user = $authUser->toArray();
        $user['first_role'] = $user['roles'][0]['name'] ?? null;

        return $user;
    }

    /**
     * check if user admin has permission to
     */
    public static function isUserAdminHasPermissionTo(string $permissionName): bool
    {
        $authUser = self::getAuthUser();
        if (! $authUser) {
            return false;
        }

        return $authUser->hasPermissionTo($permissionName);
    }
}
