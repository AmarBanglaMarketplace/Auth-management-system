<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guard = 'user';

        // 🧩 Define roles
        $roles = ['super-admin', 'admin', 'editor', 'viewer'];

        // 🧩 Define permissions
        $permissions = [
            'view-dashboard',
            'view-users','create-users','update-users','delete-users','update-user-role',
            'view-posts','create-posts','edit-posts','delete-posts','publish-posts',
            'view-pages','create-pages','edit-pages','delete-pages','publish-pages',
            'view-categories','create-categories','edit-categories','delete-categories',
            'view-settings','update-settings',
        ];

        // ✅ Create permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => $guard]);
        }

        // ✅ Create roles and assign permissions
        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => $guard]);

            switch ($roleName) {
                case 'super-admin':
                    $role->syncPermissions(Permission::where('guard_name', $guard)->pluck('name'));
                    break;

                case 'admin':
                    $role->syncPermissions([
                        'view-dashboard',
                        'view-users','create-users','update-users','delete-users','update-user-role',
                        'view-posts','create-posts','edit-posts','delete-posts','publish-posts',
                        'view-pages','create-pages','edit-pages','delete-pages','publish-pages',
                        'view-categories','create-categories','edit-categories','delete-categories',
                        'view-settings','update-settings',
                    ]);
                    break;

                case 'editor':
                    $role->syncPermissions([
                        'view-dashboard',
                        'view-posts','create-posts','edit-posts','publish-posts',
                        'view-pages','create-pages','edit-pages','publish-pages',
                        'view-categories','create-categories','edit-categories',
                    ]);
                    break;

                case 'viewer':
                    $role->syncPermissions([
                        'view-dashboard',
                        'view-users',
                        'view-posts',
                        'view-pages',
                        'view-categories',
                        'view-settings',
                    ]);
                    break;
            }
        }

        // ✅ Seed users with roles
        $superAdmin = User::firstOrCreate(
            ['email' => 'super@gmail.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('12345678')]
        );
        $superAdmin->assignRole('super-admin');

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('12345678')]
        );
        $admin->assignRole('admin');

        $editor = User::firstOrCreate(
            ['email' => 'editor@gmail.com'],
            ['name' => 'Editor', 'password' => Hash::make('12345678')]
        );
        $editor->assignRole('editor');

        $viewer = User::firstOrCreate(
            ['email' => 'viewer@gmail.com'],
            ['name' => 'Viewer', 'password' => Hash::make('12345678')]
        );
        $viewer->assignRole('viewer');
    }
}
