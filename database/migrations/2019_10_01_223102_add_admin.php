<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        $user_exists = User::where('email', 'admin@admin.com')->first();

        if (is_null($user_exists))
        {
        $user = User::create([
         'name' => 'Admin',
         'email' => 'admin@admin.com',
         'admin' => 1,
         'password' => Hash::make('12345678'),
         ]);           
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
