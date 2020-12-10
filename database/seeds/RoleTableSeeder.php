<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'recepcion';
        $role->description = 'Recepcion';
        $role->save();

        $role = new Role();
        $role->name = 'facturacion';
        $role->description = 'Facturacion';
        $role->save();

        $role = new Role();
        $role->name = 'medico';
        $role->description = 'Medico';
        $role->save();
    }
}
