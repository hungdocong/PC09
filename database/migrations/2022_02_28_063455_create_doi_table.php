<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doi', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Ten');
            $table->integer('SoCB');
            $table->string('NhiemVu');
        });

        Schema::table('can_bo', function (Blueprint $table) {
            $table->integer('Doi_ID');
            $table->foreign('Doi_ID')->references('ID')->on('doi');
        });

        Schema::table('doi', function (Blueprint $table) {

            $table->integer('Doi_Truong');
            $table->foreign('Doi_Truong')->references('ID')->on('can_bo');

            $table->integer('Doi_Pho');
            $table->foreign('Doi_Pho')->references('ID')->on('can_bo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doi');
    }
}
