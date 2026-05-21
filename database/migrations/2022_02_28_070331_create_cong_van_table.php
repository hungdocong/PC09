<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongVanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cong_van', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('SoCV');
            $table->string('NoiGui');
            $table->string('NgayGui');
            $table->string('NoiDung');
            $table->dateTime('NgayTiepNhan');
            $table->string('GhiChu');
            $table->string('LoaiCV');

        });

        Schema::table('cong_van', function (Blueprint $table) {
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
        Schema::dropIfExists('cong_van');
    }
}
