<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
        $role->description = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'user';
        $role->save();
    }
}
