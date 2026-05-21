<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnhtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('knht', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('NgayTiepNhan');
            $table->string('DonVi_TC');
            $table->string('DiaDiem');
            $table->string('NoiDung');
            $table->integer('TrangThai');

        });

        Schema::table('knht', function (Blueprint $table) {
            $table->integer('DonVi_ID');
            $table->foreign('DonVi_ID ')->references('ID')->on('donvi_tc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knht');
    }
}
