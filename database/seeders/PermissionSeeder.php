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

        // \DB::table('permissions')->delete();

        //Users
        Permission::create(['name'=>'user.index','description'=>'Lista todos los usuarios del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'user.create','description'=>'Permite Crear un usuario'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'user.edit','description'=>'Permite Editar un usuario'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'user.update','description'=>'Permite Actualizar un usuario'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'user.delete','description'=>'Permite Borrar un usuario'])->syncRoles($admin,$gestion);

        // Entidades
        Permission::create(['name'=>'entidad.index','description'=>'Lista todos las entidades del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.create','description'=>'Permite Crear una entidad'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.edit','description'=>'Permite Editar una entidad'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.update','description'=>'Permite Actualizar una entidad'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'entidad.delete','description'=>'Permite Borrar una entidad'])->syncRoles($admin,$gestion);

        // Pedidos
        Permission::create(['name'=>'pedido.index','description'=>'Lista todos los pedidos del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.create','description'=>'Permite Crear un pedido'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.edit','description'=>'Permite Editar un pedido'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.update','description'=>'Permite Actualizar un pedido'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'pedido.delete','description'=>'Permite Borrar un pedido'])->syncRoles($admin,$gestion);

        //PeticionStock
        Permission::create(['name'=>'stockpeticion.index','description'=>'Lista todas las peticiones de stock del sistema'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stockpeticion.create','description'=>'Permite Crear una Peticion de stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stockpeticion.edit','description'=>'Permite Editar una Peticion de stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stockpeticion.update','description'=>'Permite Actualizar una Peticion de stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stockpeticion.delete','description'=>'Permite Borrar una Peticion de stock'])->syncRoles($admin,$gestion,$operario);

        //Stock
        Permission::create(['name'=>'stock.index','description'=>'Lista el stock del sistema'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.create','description'=>'Permite Crear un movimiento en el stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.edit','description'=>'Permite Editar un movimiento del stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.update','description'=>'Permite Actualizar un movimiento del stock'])->syncRoles($admin,$gestion,$operario);
        Permission::create(['name'=>'stock.delete','description'=>'Permite Borrar un movimiento del stock'])->syncRoles($admin,$gestion,$operario);

        //Productos
        Permission::create(['name'=>'producto.index','description'=>'Lista todos los productos del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'producto.create','description'=>'Permite Crear un producto'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'producto.edit','description'=>'Permite Editar una producto'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'producto.update','description'=>'Permite Actualizar una producto'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'producto.delete','description'=>'Permite Borrar un producto'])->syncRoles($admin,$gestion);

        //Roles
        Permission::create(['name'=>'role.index','description'=>'Lista todos los roles del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'role.create','description'=>'Permite Crear un rol'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'role.edit','description'=>'Permite Editar un rol'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'role.update','description'=>'Permite Actualizar un rol'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'role.delete','description'=>'Permite Borrar un rol'])->syncRoles($admin,$gestion);

        //Permisos
        Permission::create(['name'=>'permiso.index','description'=>'Lista todos los permisos del sistema'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'permiso.create','description'=>'Permite Crear un permiso'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'permiso.edit','description'=>'Permite Editar una permiso'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'permiso.update','description'=>'Permite Actualizar una permiso'])->syncRoles($admin,$gestion);
        Permission::create(['name'=>'permiso.delete','description'=>'Permite Borrar un permiso'])->syncRoles($admin,$gestion);

        //otros
        Permission::create(['name'=>'dash','description'=>'Acceder al Dashboard'])->syncRoles($admin,$gestion);

        Permission::create(['name'=>'administracion','description'=>'Acceder a tablas de administracion'])->syncRoles($admin,$gestion);


    }
}
