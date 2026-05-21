<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luong', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Nam');
            $table->string('MoTa');
            $table->dateTime('NgayCapNhat');
        });

        Schema::table('luong', function (Blueprint $table) {
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
        Schema::dropIfExists('luong');
    }
}
