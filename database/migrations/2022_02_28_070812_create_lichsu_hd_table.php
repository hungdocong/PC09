<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichsuHdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichsu_hd', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('ThoiGian');
            $table->string('NoiDung');

        });

        Schema::table('lichsu_hd', function (Blueprint $table) {
            $table->integer('DangNhap_ID');
            $table->foreign('DangNhap_ID')->references('ID')->on('dang_nhap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichsu_hd');
    }
}
