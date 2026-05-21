<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrinhDoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trinh_do', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('NghiepVu_CA');
            $table->string('TN_NganhNgoai');
            $table->string('LyLuan_CT');
            $table->string('NgoaiNgu');
            $table->string('TinHoc');
            $table->dateTime('NgayCapNhat');
        });

        Schema::table('trinh_do', function (Blueprint $table) {
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
        Schema::dropIfExists('trinh_do');
    }
}
