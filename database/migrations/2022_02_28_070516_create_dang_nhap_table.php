<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangNhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dang_nhap', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TaiKhoan');
            $table->string('MatKhau');
            $table->dateTime('ThoiGian_DN');

        });

        Schema::table('dang_nhap', function (Blueprint $table) {
            $table->integer('CanBo_ID');
            $table->foreign('CanBo_ID')->references('ID')->on('can_bo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dang_nhap');
    }
}
