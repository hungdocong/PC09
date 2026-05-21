<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVuViecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vu_viec', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TenVuViec');
            $table->string('SoCV');
            $table->dateTime('NgayTC');
            $table->string('DonVi_TC');
            $table->integer('SoYC');
            $table->string('SoHoSo');
            $table->dateTime('NgayTiepNhan');
            $table->dateTime('NgayGD');
            $table->dateTime('NgayKT');
            $table->string('GiamDinh');
            $table->string('NoiDung');
            $table->string('ThoiGian');
            $table->string('DiaDiem');
            $table->string('ThoiHan_GD');
            $table->integer('DonVi_ID');
            $table->boolean('ThanhToan')->default(0);
            $table->integer('TrangThai')->default(0);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vu_viec');
    }
}
