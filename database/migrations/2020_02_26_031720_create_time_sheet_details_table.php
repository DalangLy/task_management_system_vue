<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheet_details', function (Blueprint $table) {
            $table->bigIncrements('time_sheet_detail_id');
            $table->unsignedBigInteger('time_sheet_id');
            $table->date('work_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->float('current_salary');
            $table->unsignedBigInteger('company_structure_id');
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
        Schema::dropIfExists('time_sheet_details');
    }
}
