<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamCongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cham_cong', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TuNgay');
            $table->string('DenNgay');
            $table->string('TieuDe');
            $table->string('NoiDung');
            $table->dateTime('NgayCham');
        });

        Schema::table('cham_cong', function (Blueprint $table) {
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
        Schema::dropIfExists('cham_cong');
    }
}
