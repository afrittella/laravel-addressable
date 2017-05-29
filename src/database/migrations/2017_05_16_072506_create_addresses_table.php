<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->morphs('addressable');
            $table->string('type')->index();
            $table->string('organization')->nullable();
            $table->string('name_prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street');
            $table->string('street_number')->nullable();
            $table->string('building_number')->nullable();
            $table->string('building_flat')->nullable();
            $table->string('city')->index();
            $table->string('state')->index();
            $table->string('state_code')->index();
            $table->string('country')->index();
            $table->string('country_code')->index();
            $table->string('postcode')->index();
            $table->string('phone')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->timestamps();

            $table->unique(['addressable_id', 'addressable_type', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
