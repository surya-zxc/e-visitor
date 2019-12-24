<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('visitor_id');
            $table->unsignedInteger('user_id')->nullable()->comment('Petugas yang bertanggung jawab / menghandle pengunjung');
            $table->unsignedBigInteger('card_id');
            $table->date('tanggal');
            $table->text('keperluan')->nullable();
            $table->enum('jaminan',['KTP','SIM','Passport','Lainnya'])->nullable();
            $table->string('jaminan_lainnya',50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('visitor_cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitations');
    }
}
