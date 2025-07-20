<?php

namespace App\Repositories\Permission;

use App\Models\Permission;

class Getter
{
    /**
     * Fungsi untuk mengambil daftar permission dengan opsi
     * apakah dengan translasi nya (default iya)
     * apakah dengan format tree atau flat (default flat)
     */
    public function getAll(?bool $isWithTranslation = true, ?bool $isTree = false): array
    {
        $permissions = Permission::select([
            'id', 'name',
            'parent_id',
        ])
            ->when($isTree === true, function ($query) {
                $query->whereIsParent(1);
                // ambil kedalaman query permissions nya
                $query->with(['child' => function ($query2) {
                    $query2->select([
                        'id', 'name',
                        'parent_id',
                    ]);
                    $query2->with(['child' => function ($query3) {
                        $query3->select([
                            'id', 'name',
                            'parent_id',
                        ]);
                        $query3->with('child:id,name,parent_id');
                    }]);
                }]);
            })
            ->orderBy('position', 'asc')
            ->get()
            ->toArray();

        // kalo ngk pake translasi, langsung return kan datanya
        if (! $isWithTranslation) {
            return $permissions;
        }

        $permissionWithTranslation = $this->addKeyTranslationNameOnPermission($permissions);

        return $permissionWithTranslation;
    }

    /**
     * Melakukan penambahan key title pada data permission
     */
    public function addKeyTranslationNameOnPermission(?array $permissions = []): array
    {
        $result = [];
        $index = 0;

        foreach ($permissions as &$permission) {
            $result[$index] = $this->doAttachPermissionTranslation($permission);
            if (isset($permission['child'])) {
                $result[$index]['child'] = $this->addKeyTranslationNameOnPermission($permission['child']);
            }
            $index++;
        }

        return $result;
    }

    /**
     * Melakukan proses attach key title sebuah permission
     *
     * @param  array  $permission
     * @return array
     */
    public function doAttachPermissionTranslation($permission)
    {
        if (gettype($permission) == 'array') {
            if (preg_match('/_edit$/is', $permission['name'])) {
                $permission['title'] = __('permission.edit');
            } elseif (preg_match('/_add$/is', $permission['name'])) {
                $permission['title'] = __('permission.add');
            } elseif (preg_match('/_delete$/is', $permission['name'])) {
                $permission['title'] = __('permission.delete');
            } else {
                $permission['title'] = __('permission.' . $permission['name']);
            }
        }

        return $permission;
    }
}
