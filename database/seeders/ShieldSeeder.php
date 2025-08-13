<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_formasi::formasi::jenjang","view_any_formasi::formasi::jenjang","create_formasi::formasi::jenjang","update_formasi::formasi::jenjang","restore_formasi::formasi::jenjang","restore_any_formasi::formasi::jenjang","replicate_formasi::formasi::jenjang","reorder_formasi::formasi::jenjang","delete_formasi::formasi::jenjang","delete_any_formasi::formasi::jenjang","force_delete_formasi::formasi::jenjang","force_delete_any_formasi::formasi::jenjang","view_formasi::formasi::jurusan","view_any_formasi::formasi::jurusan","create_formasi::formasi::jurusan","update_formasi::formasi::jurusan","restore_formasi::formasi::jurusan","restore_any_formasi::formasi::jurusan","replicate_formasi::formasi::jurusan","reorder_formasi::formasi::jurusan","delete_formasi::formasi::jurusan","delete_any_formasi::formasi::jurusan","force_delete_formasi::formasi::jurusan","force_delete_any_formasi::formasi::jurusan","view_formasi::formasi::lokasi","view_any_formasi::formasi::lokasi","create_formasi::formasi::lokasi","update_formasi::formasi::lokasi","restore_formasi::formasi::lokasi","restore_any_formasi::formasi::lokasi","replicate_formasi::formasi::lokasi","reorder_formasi::formasi::lokasi","delete_formasi::formasi::lokasi","delete_any_formasi::formasi::lokasi","force_delete_formasi::formasi::lokasi","force_delete_any_formasi::formasi::lokasi","view_formasi::formasi::pkl","view_any_formasi::formasi::pkl","create_formasi::formasi::pkl","update_formasi::formasi::pkl","restore_formasi::formasi::pkl","restore_any_formasi::formasi::pkl","replicate_formasi::formasi::pkl","reorder_formasi::formasi::pkl","delete_formasi::formasi::pkl","delete_any_formasi::formasi::pkl","force_delete_formasi::formasi::pkl","force_delete_any_formasi::formasi::pkl","view_formasi::formasi::posisi","view_any_formasi::formasi::posisi","create_formasi::formasi::posisi","update_formasi::formasi::posisi","restore_formasi::formasi::posisi","restore_any_formasi::formasi::posisi","replicate_formasi::formasi::posisi","reorder_formasi::formasi::posisi","delete_formasi::formasi::posisi","delete_any_formasi::formasi::posisi","force_delete_formasi::formasi::posisi","force_delete_any_formasi::formasi::posisi","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_LamaranMasuk","page_LowonganTersedia","page_StatusLamaran","page_EditProfilePage"]},{"name":"user","guard_name":"web","permissions":["page_LowonganTersedia","page_StatusLamaran"]},{"name":"admin","guard_name":"web","permissions":["view_formasi::formasi::jenjang","view_any_formasi::formasi::jenjang","create_formasi::formasi::jenjang","update_formasi::formasi::jenjang","restore_formasi::formasi::jenjang","restore_any_formasi::formasi::jenjang","replicate_formasi::formasi::jenjang","reorder_formasi::formasi::jenjang","delete_formasi::formasi::jenjang","delete_any_formasi::formasi::jenjang","force_delete_formasi::formasi::jenjang","force_delete_any_formasi::formasi::jenjang","view_formasi::formasi::jurusan","view_any_formasi::formasi::jurusan","create_formasi::formasi::jurusan","update_formasi::formasi::jurusan","restore_formasi::formasi::jurusan","restore_any_formasi::formasi::jurusan","replicate_formasi::formasi::jurusan","reorder_formasi::formasi::jurusan","delete_formasi::formasi::jurusan","delete_any_formasi::formasi::jurusan","force_delete_formasi::formasi::jurusan","force_delete_any_formasi::formasi::jurusan","view_formasi::formasi::lokasi","view_any_formasi::formasi::lokasi","create_formasi::formasi::lokasi","update_formasi::formasi::lokasi","restore_formasi::formasi::lokasi","restore_any_formasi::formasi::lokasi","replicate_formasi::formasi::lokasi","reorder_formasi::formasi::lokasi","delete_formasi::formasi::lokasi","delete_any_formasi::formasi::lokasi","force_delete_formasi::formasi::lokasi","force_delete_any_formasi::formasi::lokasi","view_formasi::formasi::pkl","view_any_formasi::formasi::pkl","create_formasi::formasi::pkl","update_formasi::formasi::pkl","restore_formasi::formasi::pkl","restore_any_formasi::formasi::pkl","replicate_formasi::formasi::pkl","reorder_formasi::formasi::pkl","delete_formasi::formasi::pkl","delete_any_formasi::formasi::pkl","force_delete_formasi::formasi::pkl","force_delete_any_formasi::formasi::pkl","view_formasi::formasi::posisi","view_any_formasi::formasi::posisi","create_formasi::formasi::posisi","update_formasi::formasi::posisi","restore_formasi::formasi::posisi","restore_any_formasi::formasi::posisi","replicate_formasi::formasi::posisi","reorder_formasi::formasi::posisi","delete_formasi::formasi::posisi","delete_any_formasi::formasi::posisi","force_delete_formasi::formasi::posisi","force_delete_any_formasi::formasi::posisi","page_LamaranMasuk","page_EditProfilePage"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
