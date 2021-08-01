<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Gestion']);
        $role3=Role::create(['name'=>'Operario']);

        Permission::create(['name'=>'dash'])->syncRoles($role1,$role2);

        Permission::create(['name'=>'entidad.index'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'entidad.create'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'entidad.edit'])->syncRoles($role1,$role2);

        Permission::create(['name'=>'pedido.index'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'pedido.create'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'pedido.edit'])->syncRoles($role1,$role2);

        Permission::create(['name'=>'stock.index'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'stock.create'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'stock.edit'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'stock.movimientos'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'stock.producto'])->syncRoles($role1,$role2);
        Permission::create(['name'=>'stock.material'])->syncRoles($role1,$role2);

        Permission::create(['name'=>'administracion.index'])->syncRoles($role1,$role2);
    }
}
