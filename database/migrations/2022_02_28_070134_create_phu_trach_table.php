<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhuTrachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phu_trach', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('NgayHT');
            $table->string('ChucDanh');
        });

        Schema::table('phu_trach', function (Blueprint $table) {
            $table->integer('VuViec_ID');
            $table->foreign('VuViec_ID')->references('ID')->on('vu_viec');

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
        Schema::dropIfExists('phu_trach');
    }
}
