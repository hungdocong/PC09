<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanBoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_bo', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('HoTen');
            $table->string('NgaySinh');
            $table->string('DanToc'); 
            $table->string('SoHieu_CAND'); 
            $table->string('GioiTinh');
            $table->string('QueQuan');
            $table->string('TrinhDo_VH');
            $table->string('CapBac');
            $table->string('ChucVu');
            $table->string('ChucDanh');
            $table->string('QuyHoach');
            $table->string('NgayVao_Dang');
            $table->string('ChinhThuc_Dang');
            $table->string('NgayVao_CA');
            $table->string('Anh');
            $table->string('DiaChi');
            $table->string('Sdt');
            $table->string('NgayNhan_CT');
            $table->string('GhiChu');
            $table->string('LanhDao')->default('Không');
            $table->boolean('Vang');
            $table->integer('TrangThai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('can_bo');
    }
}
