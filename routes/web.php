<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@Index');
Route::get('/chart-{Year}', 'HomeController@Charting');
Route::get('/chartcategory-{Year}', 'HomeController@ChartingCategory');
Route::get('/chartlinhvuc-{Year}', 'HomeController@Charting_LinhVucGD');

//Cán bộ
Route::group(['prefix' => '/can-bo'], function () {
    //
    Route::get('/danh-sach.html', 'CanBoController@Index');
    Route::get('/them-moi.html', 'CanBoController@Add');
    Route::post('/add.html', 'CanBoController@frmAdd');

    Route::get('/cap-nhat/{ID}', 'CanBoController@Edit');
    Route::post('/edit.html', 'CanBoController@frmEdit');

    Route::get('/list-doi.html', 'CanBoController@GetListDoi');
    Route::get('/thong-tin/{ID}', 'CanBoController@Detail');
    Route::get('/xoa/{ID}', 'CanBoController@Delete');
    Route::post('/upload/anh', 'CanBoController@Upload_Anh');
});

//Dội
Route::group(['prefix' => '/doi'], function () {
    //
    Route::get('/danh-sach.html', 'DoiController@Index');
    Route::get('/getByID/{ID}', 'DoiController@GetByID');
    Route::get('/delete/{ID}', 'DoiController@Delete');
    Route::post('/add', 'DoiController@formAdd');

    Route::post('/edit', 'DoiController@formEdit');

});

//Lịch trực
Route::group(['prefix' => '/lich-truc'], function () {
    //Trực ban
    Route::get('/danh-sach.html', 'LichTrucController@Index');

    Route::get('/getdata.html', 'LichTrucController@GetLichTruc');

    Route::get('/delete/{ID}', 'LichTrucController@Delete');

    Route::post('/add', 'LichTrucController@frmAdd');
    Route::post('/update', 'LichTrucController@frmEdit');
    Route::post('/update_lichtruc', 'LichTrucController@frmEditLichTruc');

    //Lịch trực khác
    Route::get('/lich-truc-khac.html', 'LichTrucController@Other');
    Route::get('/get-lich-truc-khac.html', 'LichTrucController@GetLichTrucKhac');
    Route::post('/add_other', 'LichTrucController@frmAdd_Other');
    Route::post('/update_other', 'LichTrucController@frmEdit_Other');
    Route::post('/update_lichtruc_other', 'LichTrucController@frmEditLichTruc_Other');
});

//Chấm công
Route::group(['prefix' => '/cham-cong'], function () {
    Route::get('/danh-sach.html', 'ChamCongController@Index');

    Route::get('/getdata.html', 'ChamCongController@GetChamCong');

    Route::get('/delete/{ID}', 'ChamCongController@Delete');

    Route::post('/add', 'ChamCongController@frmAdd');
    Route::post('/update', 'ChamCongController@frmEdit');

});

//Công văn
Route::group(['prefix' => '/cong-van'], function () {
    Route::get('/danh-sach/{nam}', 'CongVanController@Index');

    Route::get('/getByID/{ID}', 'CongVanController@GetByID');

    Route::get('/delete/{ID}', 'CongVanController@Delete');

    Route::get('/them-moi.html', 'CongVanController@Add');
    Route::post('/add', 'CongVanController@frmAdd');
    Route::post('/update', 'CongVanController@frmEdit');
    Route::post('/frmImport', 'CongVanController@frmImport');

    Route::post('/import', 'CongVanController@Import');

    Route::get('/test', 'CongVanController@Test');

    Route::get('/loai-cong-van.html', 'CongVanController@List');
    Route::get('/Delete_LoaiCV/{ID}', 'CongVanController@Delete_LoaiCV');
    Route::post('/Add_LoaiCV', 'CongVanController@AddLoai_cv');
    Route::post('/Edit_LoaiCV', 'CongVanController@EditLoai_cv');
    Route::get('/GetLoai_CVByID/{ID}', 'CongVanController@GetLoai_CVByID');

});

//Khám nghiệm hiện trường
Route::group(['prefix' => '/knht'], function () {
    Route::get('/danh-sach.html', 'KnhtController@Index');
    
    Route::get('/getdata.html', 'KnhtController@GetVuViec');

    Route::get('/delete/{ID}/{Type}', 'KnhtController@Delete');

    // Route::post('/add_gd', 'KnhtController@frmAdd_GD');
    Route::post('/add_knht', 'KnhtController@frmAdd_KNHT');

    // Route::post('/edit_gd', 'KnhtController@frmEdit_GD');
    Route::post('/edit_knht', 'KnhtController@frmEdit_KNHT');

    // Route::get('/getPhuTrachByID/{ID}', 'KnhtController@getPhuTrachByID');
    Route::get('/getPhuTrach_Knht/{ID}', 'KnhtController@getPhuTrachKnhtID');

    Route::get('/thong-ke.html', 'KnhtController@ThongKe');
    Route::post('/tim-kiem.html', 'KnhtController@Search');
    Route::get('/{query}', 'KnhtController@ListName');

    Route::get('/getPhuTrach_knhtid/{ID}', 'KnhtController@getPhuTrachKNHT_ID');

    Route::post('/xuat-file', 'KnhtController@Export');

    Route::get('/nhap-vu-viec.html', 'KnhtController@Import');
    Route::post('/FrmImport', 'KnhtController@FrmImport');
    Route::post('/addImport', 'KnhtController@addImport');
});
//Giám định
Route::group(['prefix' => '/giam-dinh'], function () {
    Route::get('/danh-sach.html', 'GiamDinhController@Index');
    Route::get('/nhap-vu-viec.html', 'GiamDinhController@Import');
    Route::post('/FrmImport', 'GiamDinhController@FrmImport');
    Route::get('/getdata.html', 'GiamDinhController@Index@GetVuViec');

    Route::post('/addImport', 'GiamDinhController@addImport');
    Route::get('/delete/{ID}', 'GiamDinhController@Delete');
    Route::get('/update_tt/{ID}', 'GiamDinhController@Update_TT');
    Route::get('/update_refus/{ID}', 'GiamDinhController@Update_Refus');

    Route::post('/add', 'GiamDinhController@frmAdd');
    Route::post('/update', 'GiamDinhController@frmEdit');
    Route::post('/update_chamcong', 'GiamDinhController@frmEditChamCong');
    Route::get('/getByID/{ID}', 'GiamDinhController@GetVuViecByID');
    Route::get('/getChamCongByID/{ID}', 'GiamDinhController@getChamCongByID');
    Route::get('/bao-cao/{json_date?}', 'GiamDinhController@VuViecByDateRange');

    //Chấm công
    Route::get('/cham-cong.html', 'GiamDinhController@ChamCong');
    Route::get('/getdata.html', 'GiamDinhController@GetChamCong');
    Route::get('/van-toc.html', 'GiamDinhController@VanToc');
    Route::get('/change-month/{month}', 'GiamDinhController@ChangeMonth');
    Route::post('/update_chon_NgayGD', 'GiamDinhController@frmChon_NgayGD');


    //Lĩnh vực giám định
    Route::get('/linh-vuc.html', 'GiamDinhController@List');
    Route::get('/Delete_LoaiVV/{ID}', 'GiamDinhController@Delete_LoaiVV');
    Route::post('/Add_LoaiVV', 'GiamDinhController@AddLoai_vv');
    Route::post('/Edit_LoaiVV', 'GiamDinhController@EditLoai_vv');
    Route::get('/GetLoai_VVByID/{ID}', 'GiamDinhController@GetLoai_VVByID');
});

//Thống kê
Route::group(['prefix' => '/thong-ke'], function () {
    Route::get('/index.html', 'ThongKeController@Index');

    Route::post('/tim-kiem.html', 'ThongKeController@Search');
    Route::get('/{query}', 'ThongKeController@ListName');
    Route::get('/getPhuTrach_vvid/{ID}', 'ThongKeController@getPhuTrachVVID');
    Route::post('/xuat-file', 'ThongKeController@Export');
});

//sự kiện
Route::group(['prefix' => '/su-kien'], function () {
    // Route::get('/index.html', 'SuKienController@Index');

    Route::post('/frmAdd', 'SuKienController@frmAdd');
    Route::post('/frmEdit', 'SuKienController@frmEdit');
    // Route::get('/{query}', 'SuKienController@ListName');
});

//Đơn vị trưng cầu
Route::group(['prefix' => '/don-vi'], function () {
    Route::get('/danh-sach.html', 'DonViController@Index');
    Route::get('/delete/{ID}', 'DonViController@Delete');
    Route::get('/getByID/{ID}', 'DonViController@GetByID');
    Route::post('/add', 'DonViController@frmAdd');
    Route::post('/update', 'DonViController@frmEdit');
    Route::get('/change-status/{ID}/{Status}', 'DonViController@ChangeStatus');
});

//Báo cáo
Route::group(['prefix' => '/bao-cao'], function () {
    Route::post('/ngay', 'BaoCaoController@Ngay');
    Route::post('/ngay-xuatbc', 'BaoCaoController@frmBaoCao_Ngay');

    Route::post('/tuan', 'BaoCaoController@Tuan');
    Route::post('/tuan-xuatbc', 'BaoCaoController@frmBaoCao_Tuan');

    // Route::post('/downloadPDF', 'BaoCaoController@downloadPDF');
});
