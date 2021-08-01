<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Role::find(1);
        $gestion=Role::find(2);
        $operario=Role::find(3);

        Permission::create(['name'=>'dash'])->syncRoles($admin,$gestion);

        Permission::create(['name'=>'entidad.index'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.index'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.create'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.edit'])->syncRoles($admin,$gestion);

        Permission::create(['name'=>'pedido.index'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.create'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.edit'])->syncRoles($admin,$gestion);

        Permission::create(['name'=>'stock.index'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.create'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.edit'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.movimientos'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.producto'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.material'])->syncRoles($admin,$gestion,$operario);

        Permission::create(['name'=>'administracion.index'])->syncRoles($admin,$gestion);
    }
}
