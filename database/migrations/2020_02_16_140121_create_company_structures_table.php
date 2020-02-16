<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_structures', function (Blueprint $table) {
            $table->bigIncrements('company_structure_id');
            $table->string('company_name');
            $table->float('working_hours')->default(8);
            $table->string('starting_hour')->default('08:00');
            $table->string('end_hour')->default('17:00');
            $table->float('relax_hour')->default(1);
            $table->string('relax_from')->default('12:00');
            $table->string('relax_to')->default('13:00');
            $table->boolean('using')->default(true);
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
        Schema::dropIfExists('company_structures');
    }
}
