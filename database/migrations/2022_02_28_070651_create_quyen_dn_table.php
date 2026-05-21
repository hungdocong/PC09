<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuyenDnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quyen_dn', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Ten_Quyen');
            $table->string('MoTa');

        });

        Schema::table('dang_nhap', function (Blueprint $table) {
            $table->integer('Quyen_ID');
            $table->foreign('Quyen_ID')->references('ID')->on('quyen_dn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quyen_dn');
    }
}
