<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtLichtrucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_lichtruc', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('NgayTruc');
        });

        Schema::table('ct_lichtruc', function (Blueprint $table) {
            $table->integer('LichTruc_ID');
            $table->foreign('LichTruc_ID')->references('ID')->on('lich_truc');
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
        Schema::dropIfExists('ct_lichtruc');
    }
}
