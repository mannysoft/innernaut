<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

class CreateFakeUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = '';
        for($i = 1; $i < 7; $i ++){
            $email = 'arwuser' . $i . '@gmail.com';
            User::create(['name' => 'arwuser' . $i, 'email' => $email, 'password' => bcrypt('12345678'), 'group_id' => 1]);
        }

        User::create(['name' => 'adminuser', 'email' => 'adminuser@gmail.com', 'password' => bcrypt('12345678'), 'is_admin' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
