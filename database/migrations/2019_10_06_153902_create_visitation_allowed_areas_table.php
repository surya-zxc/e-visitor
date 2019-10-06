<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitationAllowedAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitation_allowed_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visitation_id');
            $table->unsignedBigInteger('area_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('visitation_id')->references('id')->on('visitations')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitation_allowed_areas');
    }
}
