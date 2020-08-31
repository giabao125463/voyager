<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnketAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anket_accesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_code');
            $table->string('anket_id', 10);
            $table->integer('doctor_id');
            $table->string('password');
            $table->string('qrcode_hash')->nullable();
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
        Schema::dropIfExists('anket_accesses');
    }
}
