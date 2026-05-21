<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoaiVuviecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_vuviec', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('Ten');
            $table->string('GhiChu');
        });

        Schema::table('vu_viec', function (Blueprint $table) {
            $table->integer('CanBo_ID');
            $table->foreign('CanBo_ID')->references('ID')->on('can_bo');
            $table->integer('LanhDao_ID');
            $table->foreign('LanhDao_ID')->references('ID')->on('can_bo');
            $table->dateTime('NgayHT')->nullable();
            $table->integer('LoaiVuViec_ID');
            $table->foreign('LoaiVuViec_ID')->references('ID')->on('loai_vuviec');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai_vuviec');
    }
}
