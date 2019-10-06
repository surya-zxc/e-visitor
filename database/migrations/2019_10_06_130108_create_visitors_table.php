<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_identitas',50);
            $table->enum('jenis_identitas',['KTP','SIM','Passport','Lainnya']);
            $table->string('jenis_identitas_lainnya',20)->nullable();
            $table->string('nama',50);
            $table->string('tempat_lahir',50)->nullable()->comment('Nama kota atau kabupatennya saja');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->enum('golongan_darah',['A','B','AB','O'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp',15)->nullable();
            $table->enum('agama',['Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu','Lainnya'])->nullable();
            $table->enum('marital_status',['Menikah','Belum Menikah'])->nullable();
            $table->string('pekerjaan',50)->nullable();
            $table->enum('kewarganegaraan',['WNI','Non WNI'])->nullable();
            $table->timestamps();
            $table->softDeletes();

//            $table->integer('user_id')->nullable();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
