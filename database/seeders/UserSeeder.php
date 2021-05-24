<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();

        $user->name = 'Seller Manager';
        $user->email = 'seller@test.com';
        $user->password = 'seller2021';
        $user->role_id  = 1;
        $user->save();

        $user = new User();

        $user->name = 'Buyer';
        $user->email = 'buyer@test.com';
        $user->password = 'buyer2021';
        $user->role_id  = 2;
        $user->save();
    }
}
