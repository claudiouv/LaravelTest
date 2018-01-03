<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: claudioumanavalverde
 * Date: 3/1/18
 * Time: 7:35 PM
 */

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $users = factory(App\Entities\User::class, 10)->create();
    }
}