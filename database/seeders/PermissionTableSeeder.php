<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Danh sách quyền
        $permissions = [
            'create assignments',
            'grade students',
            'submit assignments',
            'view grades',
        ];

        // Tạo quyền nếu chưa có
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Gán quyền cho vai trò tương ứng
        $teacher = Role::where('name', 'teacher')->first();
        $teacher?->givePermissionTo(['create assignments', 'grade students']);

        $student = Role::where('name', 'student')->first();
        $student?->givePermissionTo(['submit assignments', 'view grades']);
    }
}
