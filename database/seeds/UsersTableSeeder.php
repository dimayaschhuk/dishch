<?php

use App\Models\Base\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
       factory(User::class)->create();
    }
}
