<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRailPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin')->nullable();
            $table->string('origin_province')->nullable();
            $table->string('destination')->nullable();
            $table->string('destination_province')->nullable();
            $table->string('type')->nullable();
            $table->string('account_type')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->integer('est_days')->nullable();
            $table->decimal('rate', 10, 5)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('rates');
    }
}
