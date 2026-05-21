<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaiCvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_cv', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TenLoai');
            $table->string('GhiChu');
        });

        Schema::table('cong_van', function (Blueprint $table) {
            $table->integer('LoaiCV_ID')->nullable();
            $table->foreign('LoaiCV_ID')->references('ID')->on('loai_cv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai_cv');
    }
}
