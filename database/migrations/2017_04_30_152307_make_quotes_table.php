<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamp('departure_at')->nullable();
            $table->string('origin_pickup')->nullable();
            $table->decimal('origin_pickup_rate', 10, 4)->nullable();
            $table->string('origin')->nullable();
            $table->decimal('rate', 10, 4)->nullable();
            $table->string('destination')->nullable();
            $table->string('destination_delivery')->nullable();
            $table->decimal('destination_delivery_rate', 10, 4)->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('form_origin_city')->nullable();
            $table->string('form_origin_province')->nullable();
            $table->string('form_origin_postal')->nullable();
            $table->string('form_destination_city')->nullable();
            $table->string('form_destination_province')->nullable();
            $table->string('form_destination_postal')->nullable();
            $table->string('form_email')->nullable();
            $table->string('form_first_name')->nullable();
            $table->string('form_last_name')->nullable();
            $table->string('form_phone')->nullable();
            $table->string('form_company')->nullable();
            $table->string('form_address')->nullable();
            $table->string('form_city')->nullable();
            $table->decimal('fuel_surcharge', 10, 4)->nullable();
            $table->decimal('subtotal', 10, 4)->nullable();
            $table->decimal('tax_percent', 10, 4)->nullable();
            $table->decimal('total', 10, 4)->nullable();
            $table->decimal('alt_total', 10, 4)->nullable();
            $table->string('est_days')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
