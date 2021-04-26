<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uszips', function (Blueprint $table) {
            $table->id();
            $table->string('zip')->unique();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city')->nullable();
            $table->string('state_id')->nullable();
            $table->string('state_name')->nullable();
            $table->string('zcta')->nullable();
            $table->string('parent_zcta')->nullable();
            $table->string('population')->nullable();
            $table->string('density')->nullable();
            $table->string('county_fips')->nullable();
            $table->string('county_name')->nullable();
            $table->text('county_weights')->nullable();
            $table->text('county_names_all')->nullable();
            $table->text('county_fips_all')->nullable();
            $table->string('imprecise')->nullable();
            $table->string('military')->nullable();
            $table->string('timezone')->nullable();
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
        Schema::dropIfExists('uszips');
    }
}
