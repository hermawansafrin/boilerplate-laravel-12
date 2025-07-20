<?php

namespace App\Repositories\Role;

use App\Repositories\Permission\Getter as GetterPermission;

class Helper
{
    /**
     * Process the arrangement of existing permission ids. The rules are as follows:
     *  - When there is a permission data that is a child, its parent must also be included
     *  - Must be unique
     */
    public static function adjustPermissionIds(array $permissionIds): array
    {
        $results = [];

        /** get permission with flatten data */
        $getterPermissionRepo = app(GetterPermission::class);
        $permissionAvailable = $getterPermissionRepo->getAll(false, false);
        $permissionAvailableCollection = collect($permissionAvailable);
        $permissionAvailableIds = $permissionAvailableCollection->pluck('id')->unique()->values()->toArray();

        foreach ($permissionIds as $permissionId) {
            $permissionId = (int) $permissionId;

            // only insert permission id that is integer type
            if (in_array($permissionId, $permissionAvailableIds)) {
                // only roleId that has permission
                $permission = $permissionAvailableCollection->where('id', $permissionId)->first();
                if ($permission) {
                    // only if exists in collection
                    if ($permission['parent_id'] !== null) {// is child
                        // if parent_id is not null, add parent_id to results first
                        array_push($results, $permission['parent_id']);
                    }

                    // if null/after input parent, directly input current one
                    array_push($results, $permissionId);
                }
            }
        }

        $results = collect($results)
            ->unique()// must be unique
            ->values()// numeric array
            ->toArray(); // convert to array

        return $results;
    }
}
