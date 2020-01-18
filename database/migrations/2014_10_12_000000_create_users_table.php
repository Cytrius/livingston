<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('account_number')->nullable();
            $table->boolean('is_rep')->default(0)->nullable();
            $table->boolean('is_admin')->default(0)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create(['name' => 'kevin', 'email' => 'kev.langlois@gmail.com', 'password' => 'password']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
