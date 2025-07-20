<?php

namespace Database\Seeders;

use App\Models\ModelHasPermission;
use App\Models\ModelHasRole;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class UserWithPermissionSeeder extends Seeder
{
    /** var for save created administratorId */
    private int $administratorId = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateTables(); // truncate all table for role and permissions

        /** reset cache role and permissions */
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        DB::beginTransaction();
        try {
            $this->createUser(); // prepare for data user
            $this->createAllPermissions(); // prepare for data permissions
            $this->assignPermissionToUser(); // prepare for data permission to user

            DB::commit(); // commit the changes

            /** reset cache role permissions again */
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        } catch (\Exception $e) {
            DB::rollback();
            $this->command->error('Failed to seed user with permission: ' . $e->getMessage());

            return;
        }
    }

    /**
     * Assign permission to user
     */
    private function assignPermissionToUser(): void
    {
        $administrator = Role::create([
            'name' => Role::ADMINISTRATOR_NAME,
            'guard_name' => 'web',
        ]);

        $allPermissions = $this->getAllPermissions(); // get all permissions

        // give all permission and administartor role to user
        User::find($this->administratorId)->assignRole($administrator->name);
        foreach ($allPermissions as $permission) {
            $administrator->givePermissionTo($permission);
        }
    }

    /**
     * Create all permissions
     */
    private function createAllPermissions(): void
    {
        $allPermissions = config('permission_menu');
        $spanPosition = config('values.position_span');

        foreach ($allPermissions as $key => $parentPermission) {
            Permission::create([
                'name' => $parentPermission['permissions'],
                'guard_name' => 'web',
                'parent_id' => null,
                'is_parent' => 1,
                'position' => $this->getLastHighestPosition() + $spanPosition,
            ]);

            if ($parentPermission['childs'] !== null) {
                /** if have childs, create permissions for childs too */
                $this->createChildPermissions($parentPermission['permissions'], $parentPermission['childs']);
            }
        }
    }

    /**
     * Create child permissions for parent permission
     */
    private function createChildPermissions(string $parentPermission, array $childs): void
    {
        $parent = Permission::whereName($parentPermission)->first();
        foreach ($childs as $key => $child) {
            Permission::create([
                'name' => $child['permissions'],
                'guard_name' => 'web',
                'parent_id' => $parent->id,
                'is_parent' => null,
                'position' => $this->getLastHighestPosition() + config('values.position_span'),
            ]);

            /** jika ada lagi childs nya, rekursif kan */
            if ($child['childs'] !== null) {
                $this->createChildPermissions($child['permissions'], $child['childs']);
            }
        }
    }

    /**
     * Create user for admin and staff
     */
    private function createUser(): void
    {
        // id 1 for administrator
        $admin = User::create([
            'name' => 'Administrator Name',
            'email' => 'admin@mail.test',
            'password' => bcrypt('123456'),
            'is_active' => 1,
        ]);
        $this->administratorId = $admin->id;
    }

    /**
     * Get last highest position for permissions
     */
    private function getLastHighestPosition(): int
    {
        return DB::table('permissions')->max('position') ?? 0;
    }

    /**
     * Get all permissions with model
     */
    private function getAllPermissions(): \Illuminate\Database\Eloquent\Collection
    {
        return Permission::get();
    }

    /**
     * Truncate all table for role and permissions
     */
    private function truncateTables(): void
    {
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=0;'); // must first executed
        RoleHasPermission::truncate();
        ModelHasPermission::truncate();
        ModelHasRole::truncate();
        Permission::truncate();
        Role::truncate();
        User::truncate();
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=1;'); // returned again : must last executed
    }
}
