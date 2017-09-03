<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('term_city')->nullable();
            $table->string('term_province')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('operator')->nullable();
            $table->string('phone')->nullable();
            $table->string('tracking_phone')->nullable();
            $table->string('hours')->nullable();
            $table->timestamps();
        });

        \DB::table('terminals')->insert([
            'name' => 'DELTA TERMINAL',
            'term_city' => 'Vancouver',
            'term_province' => 'BC',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:00',
            'address' => '420 E. Audley Boulevard (Annacis Island)',
            'city' => 'Delta',
            'province' => 'British Columbia',
            'postal_code' => 'V3M 5S4',
            'operator' => '',
            'phone' => '(604) 521-1016',
            'tracking_phone' => '1-866-282-9831',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'EDMONTON TERMINAL',
            'term_city' => 'Edmonton',
            'term_province' => 'AB',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30',
            'address' => '12210 17th Street N.E.',
            'city' => 'Edmonton',
            'province' => 'Alberta',
            'postal_code' => 'T6S 1A6',
            'operator' => '',
            'phone' => '(780) 456-2132',
            'tracking_phone' => '1-888-456-5558',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'CALGARY TERMINAL',
            'term_city' => 'Calgary',
            'term_province' => 'AB',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30',
            'address' => 'Bay #1, 3015 – 58 Ave SE (Foothills Industrial Area)',
            'city' => 'Calgary',
            'province' => 'Alberta',
            'postal_code' => 'T2C 0B4',
            'operator' => '3rd Party Terminal',
            'phone' => '(780) 456-2132',
            'tracking_phone' => '1-888-456-5558',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'SASKATOON TERMINAL',
            'term_city' => 'Saskatoon',
            'term_province' => 'SK',
            'hours' => '**MUST BOOK APPOINTMENT** Gary (306) 270-4231',
            'address' => 'CN Auto Compound, Chappell Drive',
            'city' => 'Saskatoon',
            'province' => 'Saskatchewan',
            'postal_code' => '',
            'operator' => '',
            'phone' => '(780) 456-2132',
            'tracking_phone' => '1-888-456-5558',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'REGINA TERMINAL',
            'term_city' => 'Regina',
            'term_province' => 'SK',
            'hours' => '**MUST BOOK APPOINTMENT**',
            'address' => '529 12th Avenue East',
            'city' => 'Regina',
            'province' => 'Saskatchewan',
            'postal_code' => '',
            'operator' => '3rd Party Terminal | Club Towing',
            'phone' => '(306) 543-2332',
            'tracking_phone' => '1-888-456-5558',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'WINNIPEG TERMINAL',
            'term_city' => 'Winnipeg',
            'term_province' => 'MB',
            'hours' => '',
            'address' => '736 Marion Street',
            'city' => 'Winnipeg,',
            'province' => 'Manitoba,',
            'postal_code' => 'R2J 0K4',
            'operator' => '',
            'phone' => '(204) 975-0648',
            'tracking_phone' => '1-888-456-5558',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'VAUGHAN TERMINAL',
            'term_city' => 'Toronto',
            'term_province' => 'ON',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30',
            'address' => '8950 Keele Street',
            'city' => '(Vaughan) Concord',
            'province' => 'Ontario,',
            'postal_code' => 'L4K 2N2',
            'operator' => '',
            'phone' => '(905) 660-0412',
            'tracking_phone' => '1-888-227-4656',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'EMBRUN TERMINAL',
            'term_city' => 'Ottawa',
            'term_province' => 'ON',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30',
            'address' => '1496 Route 200',
            'city' => 'Embrun,',
            'province' => 'Ontario,',
            'postal_code' => 'K0A 1W0',
            'operator' => '3rd Party Terminal | Dan’s Towing',
            'phone' => '(613) 835-2852',
            'tracking_phone' => '1-800-570-2720',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'MONTREAL TERMINAL',
            'term_city' => 'Montreal',
            'term_province' => 'QC',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30',
            'address' => 'CN Auto Compound, 8050 Cavendish Boulevard',
            'city' => 'Ville Saint Laurent',
            'province' => 'Quebec',
            'postal_code' => 'H4T 1T1',
            'operator' => '',
            'phone' => '(514) 733-2720',
            'tracking_phone' => '1-800-570-2720',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'HALIFAX TERMINAL',
            'term_city' => 'Halifax',
            'term_province' => 'NS',
            'hours' => 'Drop off Hours Mon – Fri 8:00 – 4:00',
            'address' => 'CN Auto Compound, 10 Talahassee Avenue',
            'city' => 'Eastern Passage',
            'province' => 'Nova Scotia',
            'postal_code' => 'B3G 1M4',
            'operator' => '',
            'phone' => '(902) 455-5033',
            'tracking_phone' => '1-866-902-7245',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'MONCTON TERMINAL',
            'term_city' => 'Moncton,',
            'term_province' => 'NB',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30 **MUST BOOK APPOINTMENT**',
            'address' => '14 Halifax Street',
            'city' => 'Moncton,',
            'province' => 'New Brunswick',
            'postal_code' => '',
            'operator' => '3rd Party Terminal | Dynamic Towing',
            'phone' => '(902) 455-5033',
            'tracking_phone' => '1-866-902-7245',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'SAINT JOHN TERMINAL',
            'term_city' => 'Saint John',
            'term_province' => 'NB',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30 **MUST BOOK APPOINTMENT**',
            'address' => '68 Marr Rd',
            'city' => 'Rothesay',
            'province' => 'New Brunswick',
            'postal_code' => '',
            'operator' => '3rd Party Terminal | CMV Towing',
            'phone' => '(902) 455-5033',
            'tracking_phone' => '1-866-902-7245',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'FREDERICTON TERMINAL',
            'term_city' => 'Fredericton',
            'term_province' => 'NB',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30 **MUST BOOK APPOINTMENT**',
            'address' => '189 Restagouche Rd',
            'city' => 'North Oromocto',
            'province' => 'New Brunswick',
            'postal_code' => '',
            'operator' => '3rd Party Terminal | Sunbury Towing',
            'phone' => '(902) 455-5033',
            'tracking_phone' => '1-866-902-7245',
        ]);
        \DB::table('terminals')->insert([
            'name' => 'ST. JOHN’S TERMINAL',
            'term_city' => 'St. John’s',
            'term_province' => 'NF',
            'hours' => 'Drop off Hours Mon – Fri 8:30 – 4:30 **MUST BOOK APPOINTMENT**',
            'address' => '422 Logy Bay Road',
            'city' => 'St. John’s',
            'province' => 'Newfoundland,',
            'postal_code' => 'A1C 5C6',
            'operator' => '3rd Party Terminal | East Can Transport Services LTD.',
            'phone' => '(902) 455-5033',
            'tracking_phone' => '1-866-902-7245',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminals');
    }
}
