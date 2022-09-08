<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $roles = ['super_admin','admin','driver','patient','staff'];
//
//        foreach ($roles as $role) {
//            $r = \Spatie\Permission\Models\Role::create(['name' => $role]);
//        }

        $roles = ['super_admin','admin','driver','patient','staff'];
        $modules = ["user","vehicle","transfer"];
        $actions = ["*","view","update","create","delete"];

        foreach ($modules as $mobule) {
            foreach ($actions as $key => $value) {
                Permission::create(['name' => $mobule.'.'.$value]);
            }

        }

        foreach ($roles as $key => $role) {
            $temRole = Role::create(['name' => $role]);

            if($role == "admin"){
                foreach ($modules as $key => $value) {
                    foreach ($actions as $key => $actionValue) {
                        $temRole->givePermissionTo($value.'.'.$actionValue);
                    }
                }
            }else if($role == "agent"){
                foreach ($modules as $key => $value) {
                    $temRole->givePermissionTo($value.'.*');
                }

            }else if($role == "user"){
                foreach ($modules as $key => $value) {
                    $temRole->givePermissionTo($value.'.view');
                    $temRole->givePermissionTo($value.'.update');
                }
            }
        }

    }
}
