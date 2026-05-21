<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonViTCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donvi_tc', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Ten');
            $table->string('GhiChu');
            $table->boolean('TrangThai')->default(1);
        });

        Schema::table('vu_viec', function (Blueprint $table) {
            $table->integer('DonVi_ID');
            $table->foreign('DonVi_ID')->references('ID')->on('donvi_tc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donvi_tc');
    }
}
