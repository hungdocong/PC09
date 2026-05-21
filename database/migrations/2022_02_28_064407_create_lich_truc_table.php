<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichTrucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_truc', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TuNgay');
            $table->string('DenNgay');
            $table->string('LoaiTruc');
            $table->dateTime('NgayCapNhat');
        });

        Schema::table('lich_truc', function (Blueprint $table) {
            $table->integer('Truc_LD');
            $table->foreign('Truc_LD')->references('ID')->on('can_bo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lich_truc');
    }
}
