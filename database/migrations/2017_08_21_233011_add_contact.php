<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->text('origin_contact_name')->nullable();
            $table->text('origin_contact_phone')->nullable();
            $table->text('origin_contact_address')->nullable();

            $table->text('dest_contact_name')->nullable();
            $table->text('dest_contact_phone')->nullable();
            $table->text('dest_contact_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            //
        });
    }
}
