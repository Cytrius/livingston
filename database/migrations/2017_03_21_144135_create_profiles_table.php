<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('company_size')->nullable();
            $table->string('industry')->nullable();
            $table->text('influence_role')->nullable();
            $table->text('daily_life')->nullable();
            $table->text('demographic')->nullable();
            $table->text('goals')->nullable();
            $table->text('story')->nullable();
            $table->text('objections')->nullable();
            $table->text('skills')->nullable();
            $table->text('red_flags')->nullable();
            $table->string('colleagues')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
