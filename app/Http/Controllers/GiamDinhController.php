<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use app\Helper;
use File;
use ZipArchive;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\Validator;

class GiamDinhController extends Controller
{
    //
    public function Index(){
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $ds_canbo = DB::table('can_bo')
        ->where('Vang', 0)
        // ->where('Doi_ID', 3)
        ->orderBy('HoTen')
        ->get();

        // $lstVuViec = DB::table('vu_viec')->where('LoaiVuViec_ID', 1)->whereYear('NgayTiepNhan', $year)->get();
        $lstLoai_vuviec = DB::table('loai_vuviec')->where('GhiChu', "GĐ")->get();
        $lstVuViec = DB::table('vu_viec')->whereYear('NgayTiepNhan', $year)->get();
        $lstTenVV = DB::table('vu_viec')->select('NoiDung')->distinct()->get();
        
        $lstDonVi = DB::table('donvi_tc')->orderBy('Ten', 'desc')->where('TrangThai', 1)->get();
        return view('giamdinh.index')->with([
            'ds_canbo'=> $ds_canbo,
            'lstVuViec'=> $lstVuViec,
            'lstLoai_vuviec'=> $lstLoai_vuviec,
            'lstTenVV'=> $lstTenVV,
            'lstDonVi'=> $lstDonVi
        ]);
    }

    public function frmAdd(Request $request){
        $SoCV = $request->get("SoCV");
        $NgayTC = Carbon::createFromFormat('d/m/Y', $request->get("NgayTC"))->format('Y-m-d');
        // $DonVi_ID =  $request->get("DonVi_ID");
        $SoHoSo = $request->get("SoHoSo");
        $DonVi_ID = GetDonvi_id($SoCV);
        $NgayTiepNhan = Carbon::createFromFormat('d/m/Y', $request->get("NgayTiepNhan"))->format('Y-m-d');

        $LoaiVuViec_ID = $request->get("TenVuViec");
        $loai_vv = DB::table('loai_vuviec')->where('ID', $LoaiVuViec_ID)->first();
        $TenVuViec = $loai_vv->Ten;
        
        $DonVi_TC = $request->get("DonVi");
        $NoiDung = $request->get("NoiDung");
        $ThoiGian = is_string($request->get("ThoiGian")) ? $request->get("ThoiGian") : Carbon::createFromFormat('d/m/Y', $request->get("ThoiGian"))->format('Y-m-d');
        $DiaDiem = $request->get("DiaDiem");
        $ThoiHan_GD = $request->get("ThoiHan_GD");

        DB::insert('insert into vu_viec 
            (TenVuViec, SoCV, NgayTC, DonVi_TC, NgayTiepNhan, SoHoSo, NoiDung, ThoiGian, DiaDiem, ThoiHan_GD, LoaiVuViec_ID, TrangThai) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [$TenVuViec, $SoCV, $NgayTC, $DonVi_TC, $NgayTiepNhan, $SoHoSo, $NoiDung, $ThoiGian, $DiaDiem, $ThoiHan_GD, $LoaiVuViec_ID, 0]);

        $VuViec_ID = DB::table('vu_viec')->max('ID');
        $arr_gdv = $request->GDV;
        $arr_tlgd = $request->TLGD;

        foreach ($arr_gdv as $item) {
            DB::insert('insert into phu_trach 
                (VuViec_ID, CanBo_ID, ChucDanh) 
                values (?, ?, ?)', 
                [$VuViec_ID, $item, "Giám định viên"]);
        }

        if (count($arr_tlgd) > 0) {
            foreach ($arr_tlgd as $item) {
                DB::insert('insert into phu_trach 
                    (VuViec_ID, CanBo_ID, ChucDanh) 
                    values (?, ?, ?)', 
                    [$VuViec_ID, $item, "Trợ lý"]);
            }
        }


        Session::flash('message', 'Thêm vụ việc thành công.');
        return redirect('/giam-dinh/danh-sach.html');
    }

    public function GetVuViecByID($ID){

        $vu_viec = DB::table('vu_viec')
        ->where('ID', $ID)
        ->select('ID','TenVuViec', 'SoCV', 'NgayTC', 'DonVi_TC', 'NgayTiepNhan', 'SoHoSo', 'NoiDung', 'ThoiGian', 'DiaDiem', 'ThoiHan_GD', 'LoaiVuViec_ID')
        ->first();
        $phutrach = DB::table('phu_trach')->where('VuViec_ID', $ID)->get();
        return response()->json([
            'vu_viec' => $vu_viec,
            'phutrach' => $phutrach
        ]);
    }

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $SoCV = $request->get("SoCV");
        $SoHoSo = $request->get("SoHoSo");
        $DonVi_ID = GetDonvi_id($SoCV);
        $NgayTC =  Carbon::createFromFormat('d/m/Y', $request->get("NgayTC"))->format('Y-m-d');
        $NgayTiepNhan = Carbon::createFromFormat('d/m/Y', $request->get("NgayTiepNhan"))->format('Y-m-d');

        $NoiDung = $request->get("NoiDung");
        $ThoiGian = is_string($request->get("ThoiGian")) ? $request->get("ThoiGian") : Carbon::createFromFormat('d/m/Y', $request->get("ThoiGian"))->format('Y-m-d');
        $DiaDiem = $request->get("DiaDiem");
        $ThoiHan_GD = $request->get("ThoiHan_GD");
        $donvi = $request->get("DonVi");

        $LoaiVuViec_ID = $request->get("TenVuViec");
        $loai_vv = DB::table('loai_vuviec')->where('ID', $LoaiVuViec_ID)->first();
        $TenVuViec = $loai_vv->Ten;

        DB::table('vu_viec')
        ->where("ID", $ID)
        ->update([
            'TenVuViec' => $TenVuViec,
            'LoaiVuViec_ID' => $LoaiVuViec_ID,
            'SoCV' => $SoCV,
            'DonVi_TC' => $donvi,
            'SoHoSo' => $SoHoSo,
            'NgayTC' => $NgayTC,
            'DonVi_ID' => $DonVi_ID,
            'NgayTiepNhan' => $NgayTiepNhan,
            'NoiDung' => $NoiDung,
            'ThoiGian' => $ThoiGian,
            'DiaDiem' => $DiaDiem,
            'ThoiHan_GD' => $ThoiHan_GD
        ]);

        $arr_gdv = $request->GDV;
        $arr_tlgd = $request->TLGD;

        DB::table('phu_trach')->where("VuViec_ID", $ID)->where("ChucDanh", "Giám định viên")->delete();
        foreach ($arr_gdv as $item) {
            DB::insert('insert into phu_trach 
                (VuViec_ID, CanBo_ID, ChucDanh) 
                values (?, ?, ?)', 
                [$ID, $item, "Giám định viên"]);
        }
        
        $check_tl = DB::table('phu_trach')->where("VuViec_ID", $ID)->where("ChucDanh", "Trợ lý")->count();

        if (!empty($arr_tlgd)) {
            if ($check_tl != 0) {
                DB::table('phu_trach')->where("VuViec_ID", $ID)->where("ChucDanh", "Trợ lý")->delete();
            }
            foreach ($arr_tlgd as $item) {
                    DB::insert('insert into phu_trach 
                        (VuViec_ID, CanBo_ID, ChucDanh) 
                        values (?, ?, ?)', 
                        [$ID, $item, "Trợ lý"]);
            }
        }else{
            if ($check_tl != 0) {
                DB::table('phu_trach')->where("VuViec_ID", $ID)->where("ChucDanh", "Trợ lý")->delete();
            }
        }

        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/giam-dinh/danh-sach.html');
    }

    public function Import(){
        return view('giamdinh.import');
    }

    public function FrmImport(Request $request){

        // require_once 'bootstrap.php';
        if ($request->hasFile('File')){
            $file = $request->file("File");

            // Thư mục upload $file_title = );
            $file_name  = Str_Metatitle($file->getClientOriginalName());
            $path = public_path('/assets/file/giam-dinh/');

            // Bắt đầu chuyển file vào thư mục
            $file->move($path, $file_name);

            $filepath = public_path('/assets/file/giam-dinh/'. $file_name);
            $reader = ReaderEntityFactory::createReaderFromFile($filepath);
            $reader->open($filepath);
            $giamdinh = [];
            $dem = 0;$arr_error = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                   
                    if (collect($row)->filter(fn($v) => $v !== null && $v !== '')->isEmpty()) {
                        break;
                    }
                    $cells = $row->getCells();

                    if (!is_numeric($cells[0]->getValue())){
                        continue;
                    }

                    $STT = $cells[0]->getValue(); 

                    //Số hồ sơ
                    if($cells[1]== null || $cells[1] == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Số hồ sơ</span> không được bỏ trống.']);
                    }else if(!Validate_SoHoSo($cells[1]->getValue())){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Số hồ sơ: <span class="text-red">'. $cells[1]->getValue() .'</span> không đúng định dạng.']);
                    }else if(CheckExist_SoHoSo($cells[1]->getValue())){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Số hồ sơ: <span class="text-red">'. $cells[5]->getValue() .'</span> đã bị trùng với vụ việc khác.']);
                    }

                    //số trưng cầu
                    if($cells[2]->getValue()== null || $cells[2]->getValue() == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Số trưng cầu</span> không được bỏ trống.']);
                    }

                    //Ngày trưng cầu
                    if($cells[3]->getValue()== null || $cells[3]->getValue() == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Ngày trưng cầu</span> không được bỏ trống.']);
                    }else if(is_string($cells[3]->getValue())){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Ngày trưng cầu: <span class="text-red">'. $cells[3]->getValue() .' </span> sai định dạng ngày/tháng/năm hoặc không tồn tại.']);
                    }
                    if($cells[4]== null || $cells[4] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Đơn vị trưng cầu</span> không được bỏ trống.']);

                    
                    if($cells[5]== null || $cells[5] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Tên vụ việc</span> không được bỏ trống.']);
                    if($cells[6]->getValue()== null || $cells[6]->getValue() == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Thời gian xảy ra</span> không được bỏ trống.']);

                    if($cells[7]== null || $cells[7] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Địa điểm xảy ra vụ việc</span> không được bỏ trống.']);
                    
                    //Ngày tiếp nhận/Ngày lập
                    if($cells[8]->getValue()== null || $cells[8]->getValue() == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Ngày tiếp nhận</span> không được bỏ trống.']);
                    }else if(is_string($cells[8]->getValue())){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Ngày tiếp nhận: <span class="text-red">'. $cells[8]->getValue() .' </span> sai định dạng ngày/tháng/năm hoặc không tồn tại.']);
                    }

                   
                    //Ngày đăng ký $cells[9]
                    
                    if($cells[10]== null || $cells[10] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Thời hạn giám định</span> không được bỏ trống.']);
                     //Ngày kết thúc $cells[11]

                    if($cells[12]== null || $cells[12] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Lĩnh vực giám định</span> không được bỏ trống.']);                   
                    
                    if($cells[13]== null || $cells[13] == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Cán bộ quản lý/Giám định viên</span> không được bỏ trống.']);
                    }else{
                        $arr_gdv = explode(",", $cells[13]);
                        for ($i=0; $i < count($arr_gdv) ; $i++) {
                            $canbo = DB::table('can_bo')->where('HoTen', trim($arr_gdv[$i]))->count();
                            if($canbo == 0)
                                array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Cán bộ quản lý/Giám định viên: <span class="text-red">' . $arr_gdv[$i] . '</span> không có trong danh sách']);
                        }
                    }

                    if($cells[14] != null && $cells[14] != ""){
                        $arr_tl = explode(",", $cells[14]);
                        for ($i=0; $i < count($arr_tl) ; $i++) {
                            $canbo = DB::table('can_bo')->where('HoTen', trim($arr_tl[$i]))->count();
                            if($canbo == 0)
                                array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Trợ lý giám định: <span class="text-red">' . $arr_tl[$i] . '</span> không có trong danh sách']);
                        }
                    }

                    $SoHoSo = $cells[1] == null ? "trống": $cells[1];
                    $SoCV = $cells[2]; 
                    $NgayTC = is_string($cells[3]->getValue()) ? $cells[3]->getValue() : Carbon::parse($cells[3]->getValue())->format('d/m/Y');
                    $DonVi_TC = $cells[4]; 
                     $NoiDung = $cells[5]; 
                    $ThoiGian = is_string($cells[6]->getValue()) ? $cells[6]->getValue() : Carbon::parse($cells[6]->getValue())->format('d/m/Y'); 
                    $DiaDiem = $cells[7]; 
                    
                    $NgayTiepNhan = $cells[8]->getValue();
                    
                    //Ngày đăng ký
                    if ($cells[9]->getValue() != "") {
                        $NgayGD = Carbon::parse($cells[9]->getValue())->format('d/m/Y');
                        $TrangThai = 1;
                    }else{
                        $NgayGD = "";
                    }

                    $ThoiHan_GD = $cells[10]; 
                    $NgayKT =  $cells[11]->getValue() == "" ? "": Carbon::parse($cells[11]->getValue())->format('d/m/Y');
                    $TenVuViec = $cells[12]; 
                    
                    $GĐV = $cells[13]; 
                    $TLGĐ = $cells[14]== null ? "trống": $cells[14];  
                    $TrangThai = 0;

                    $giamdinh[$dem] = [
                        "STT" => $STT,
                        "TenVuViec" => $TenVuViec->getValue(),
                        "SoCV" => $SoCV->getValue(),
                        "NgayTC" => $NgayTC,
                        "DonVi_TC" => $DonVi_TC->getValue(),
                        "SoHoSo" => $SoHoSo->getValue(),
                        "NgayTiepNhan" => $NgayTiepNhan,
                        "NgayGD" => $NgayGD,
                        "NgayKT" => $NgayKT,
                        "NoiDung" => $NoiDung->getValue(),
                        "ThoiGian" => $ThoiGian,
                        "DiaDiem" => $DiaDiem->getValue(),
                        "ThoiHan_GD" => $ThoiHan_GD->getValue(),
                        "TrangThai" => $TrangThai,
                        "GĐV" => $GĐV->getValue(),
                        "TLGĐ" => $TLGĐ->getValue()
                    ];

                    $dem++;
                }
            }

            // print_r($giamdinh);
            Session::put('giamdinh', $giamdinh);
            Session::put('arr_error', $arr_error);
            Session::put('File_Name', $file_name);
            $reader->close();
            // Session::flash('message', 'Nhập công văn thành công.');
            return redirect('/giam-dinh/nhap-vu-viec.html');

        }

    }

    public function addImport(Request $request){

        foreach (Session::get('giamdinh') as $key=>$value){

            $loai_vv = DB::table('loai_vuviec')->where('Ten', $value['TenVuViec'])->first();

            $TenVuViec = $value['TenVuViec'];
            $SoCV = $value['SoCV'] ;
            $NgayTC = Carbon::createFromFormat('d/m/Y', $value['NgayTC'])->format('Y-m-d');
            $DonVi_TC = $value['DonVi_TC'] ;
            $SoHoSo = $value['SoHoSo'];
                    // $NgayTiepNhan = Carbon::createFromFormat('d/m/Y', $value['NgayTiepNhan'])->format('Y-m-d');
            $NgayTiepNhan = $value['NgayTiepNhan'];
            $NgayGD = $value['NgayGD'] == "" ? null: Carbon::createFromFormat('d/m/Y', $value['NgayGD'])->format('Y-m-d');
            $NgayKT = $value['NgayKT'] == "" ? null: Carbon::createFromFormat('d/m/Y', $value['NgayKT'])->format('Y-m-d');
            $NoiDung = $value['NoiDung'] ;
            $ThoiGian = $value['ThoiGian'] ;
            $DiaDiem = $value['DiaDiem'];
            $ThoiHan_GD = $value['ThoiHan_GD'] ;
            $TrangThai = $value['TrangThai'];
            $LoaiVuViec_ID  = $loai_vv->ID;
            $arr_gdv = explode(",", $value['GĐV']);


            $phutrach = [];

            $j = 0;
            for ($i=0; $i < count($arr_gdv) ; $i++) {
                $GDV_ID = DB::table('can_bo')->where('HoTen', trim($arr_gdv[$i]))->first()->ID;
                $phutrach[$i]['id'] = $GDV_ID;
                $phutrach[$i]['chucdanh'] = "Giám định viên";
                $j++;
            }

            if ($value['TLGĐ'] != null && $value['TLGĐ'] != "") {
                $arr_tlgd = explode(",", $value['TLGĐ']);
                for ($i=0; $i < count($arr_tlgd) ; $i++) {
                    $TLGD_ID = DB::table('can_bo')->where('HoTen', trim($arr_tlgd[$i]))->first()->ID;
                    $phutrach[$j]['id'] = $TLGD_ID;
                    $phutrach[$j]['chucdanh'] = "Trợ lý";
                    $j++;
                }
            }

//             echo '<pre>';
// print_r($phutrach);
// echo '</pre>';

            DB::insert('insert into vu_viec 
                (TenVuViec, SoCV, NgayTC, DonVi_TC, NgayTiepNhan, SoHoSo, NgayGD, NgayKT, NoiDung, ThoiGian, DiaDiem, ThoiHan_GD, LoaiVuViec_ID, TrangThai) 
                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                [$TenVuViec, $SoCV, $NgayTC, $DonVi_TC, $NgayTiepNhan, $SoHoSo, $NgayGD, $NgayKT, $NoiDung, $ThoiGian, $DiaDiem, $ThoiHan_GD, $LoaiVuViec_ID, $TrangThai]);

            $VuViec_ID = DB::table('vu_viec')->max('ID');
            $i = 0;
            foreach ($phutrach as $item) {
                $CanBo_ID = $phutrach[$i]['id'];
                $ChucDanh = $phutrach[$i]['chucdanh'];
                DB::insert('insert into phu_trach 
                    (VuViec_ID, CanBo_ID, ChucDanh) 
                    values (?, ?, ?)', 
                    [$VuViec_ID, $CanBo_ID, $ChucDanh]);
                $i++;
            }

        }
        Session::flash('message', 'Thêm vụ việc thành công.');
        return redirect('/giam-dinh/danh-sach.html');
    }

    public function frmEditChamCong(Request $request){

        $ID = $request->get("ID");
        $NgayKT = Carbon::createFromFormat('d/m/Y', $request->get("NgayKT"))->format('Y-m-d');
        $NgayGD = Carbon::createFromFormat('d/m/Y', $request->get("NgayGD"))->format('Y-m-d');
        // $NgayKT = $request->get("NgayKT");
        // $NgayGD = $request->get("NgayGD");

        DB::table('vu_viec')
        ->where("ID", $ID)
        ->update([
            'NgayGD' => $NgayGD,
            'NgayKT' => $NgayKT,
            'GiamDinh' => null,
            'TrangThai' => 1
        ]);

        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/giam-dinh/danh-sach.html');
    }
    public function getPhuTrachByID($ID){
        $phutrach = DB::table('phu_trach')->where('VuViec_ID', $ID)->get();

        return response()->json([
            'query' => $phutrach
        ]);
    }

    public function getChamCongByID($ID){
        $vu_viec = DB::table('vu_viec')->where('ID', $ID)->first();
        $phutrach = DB::table('phu_trach')
        ->join('can_bo', 'phu_trach.CanBo_ID', '=', 'can_bo.ID')
        ->where('VuViec_ID', $ID)
        ->select('can_bo.HoTen','can_bo.CapBac','can_bo.ChucVu')
        ->get();
        $ngay_arr =  getDatesFromRange($vu_viec->NgayGD, $vu_viec->NgayKT, 'd-m-Y');
        return response()->json([
            'query' => $vu_viec,
            'phutrach' => $phutrach,
            'ngay_arr' => $ngay_arr,
            'giamdinh' => $vu_viec->GiamDinh
        ]);
    }
    public function Delete($ID){
        DB::table('phu_trach')
        ->where("VuViec_ID", $ID)
        ->delete();

        DB::table('vu_viec')
        ->where("ID", $ID)
        ->delete();

        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }



    public function ChamCong(){
        $ds_canbo = DB::table('can_bo')
        ->where('Vang', 0)
        ->orderBy('HoTen')
        ->get();

        $month = Carbon::now('Asia/Ho_Chi_Minh')->format('m');            
        $gd_kt = DB::table('vu_viec')->whereMonth('NgayKT', $month)->where('TrangThai', 1)->get();
        $thanhtoan = DB::table('vu_viec')->whereMonth('NgayKT', $month)->where('ThanhToan', 1)->get();

        $donvi = DB::table('donvi_tc')
        ->join('vu_viec', 'donvi_tc.ID', '=', 'vu_viec.DonVi_ID')
        ->whereMonth('NgayKT', $month)
        ->select('donvi_tc.ID','donvi_tc.GhiChu')
        ->distinct()->get();
        $arr_donvi = array(); $j = 0;                    
        foreach ($donvi as $jtem) {
            $tong = 0;$tong_tt = 0;
            foreach ($gd_kt as $item){
                if($item->DonVi_ID == $jtem->ID){
                    $gd = strtotime($item->NgayGD);
                    $kt = strtotime($item->NgayKT);
                    $day = floor(($kt-$gd) / (60 * 60 * 24) + 2);
                    $arr_phutrach = GetPhuTrach($item->ID);

                    for($i = 0; $i < count($arr_phutrach); $i++){
                        if($arr_phutrach[$i]['ChucDanh']){
                            $tong += (300000 * $day);
                        }else{
                            $tong += (210000 * $day);
                        }
                    }
                }
            }

            foreach ($thanhtoan as $item) {
                if($item->DonVi_ID == $jtem->ID){
                    $gd = strtotime($item->NgayGD);
                    $kt = strtotime($item->NgayKT);
                    $day = floor(($kt-$gd) / (60 * 60 * 24) + 2);
                    $arr_phutrach = GetPhuTrach($item->ID);

                    for($i = 0; $i < count($arr_phutrach); $i++){
                        if($arr_phutrach[$i]['ChucDanh']){
                            $tong_tt += (300000 * $day);
                        }else{
                            $tong_tt += (210000 * $day);
                        }
                    }
                }
            }

            $arr_donvi[$j]['DonVi'] = $jtem->GhiChu;
            $arr_donvi[$j]['Tong'] = number_format($tong);
            $arr_donvi[$j]['ThanhToan'] = number_format($tong_tt);
            $j++;
        }                   
        // $phong = $tong_tt * 0.2;
        // $khac = $tong_tt * 0.2;
        // $nhan = $tong_tt - $tong_tt * 0.2 * 2;
        return view('giamdinh.chamcong')->with([
            'ds_canbo'=> $ds_canbo,
            'thang'=> $month,
            'arr_donvi'=> $arr_donvi
            // 'tong'=> number_format($tong),
            // 'tong_tt'=> number_format($tong_tt),
            // 'chua_tt'=> number_format($tong - $tong_tt),
            // 'phong'=> number_format($phong),
            // 'khac'=> number_format($khac),
            // 'nhan'=> number_format($nhan)
        ]);
    }

    public function VuViecByDateRange($json_date = null){

        $model = json_decode($json_date);

        $startDate = Carbon::parse($model[0]->startDate)->addDays(1)->format('Y-m-d');
        $endDate = Carbon::parse($model[0]->endDate)->format('Y-m-d');
        $lstVuViec = DB::table('vu_viec')
                        ->whereDate('NgayTiepNhan', '>=', $startDate)
                        ->whereDate('NgayTiepNhan', '<=', $endDate)
                        ->orderBy('NgayTiepNhan', 'desc')
                        ->get();
       
        return response()->json([
            'lstVuViec'=> $lstVuViec,
            'startDate'=> $startDate,
            'endDate'=> $endDate
        ]);
    }

    public function ChangeMonth($month){

        $gd_kt = DB::table('vu_viec')->whereMonth('NgayKT', $month)->where('TrangThai', 1)->get();
        $thanhtoan = DB::table('vu_viec')->whereMonth('NgayKT', $month)->where('ThanhToan', 1)->get();

        $donvi = DB::table('donvi_tc')
        ->join('vu_viec', 'donvi_tc.ID', '=', 'vu_viec.DonVi_ID')
        ->whereMonth('NgayKT', $month)
        ->select('donvi_tc.ID','donvi_tc.GhiChu')
        ->distinct()->get();
        $arr_donvi = array(); $j = 0;                    
        foreach ($donvi as $jtem) {
            $tong = 0;$tong_tt = 0;
            foreach ($gd_kt as $item){
                if($item->DonVi_ID == $jtem->ID){
                    $gd = strtotime($item->NgayGD);
                    $kt = strtotime($item->NgayKT);
                    $day = floor(($kt-$gd) / (60 * 60 * 24) + 2);
                    $arr_phutrach = GetPhuTrach($item->ID);

                    for($i = 0; $i < count($arr_phutrach); $i++){
                        if($arr_phutrach[$i]['ChucDanh']){
                            $tong += (300000 * $day);
                        }else{
                            $tong += (210000 * $day);
                        }
                    }
                }
            }

            foreach ($thanhtoan as $item) {
                if($item->DonVi_ID == $jtem->ID){
                    $gd = strtotime($item->NgayGD);
                    $kt = strtotime($item->NgayKT);
                    $day = floor(($kt-$gd) / (60 * 60 * 24) + 2);
                    $arr_phutrach = GetPhuTrach($item->ID);

                    for($i = 0; $i < count($arr_phutrach); $i++){
                        if($arr_phutrach[$i]['ChucDanh']){
                            $tong_tt += (300000 * $day);
                        }else{
                            $tong_tt += (210000 * $day);
                        }
                    }
                }
            }

            $arr_donvi[$j]['DonVi'] = $jtem->GhiChu;
            $arr_donvi[$j]['Tong'] = number_format($tong);
            $arr_donvi[$j]['ThanhToan'] = number_format($tong_tt);
            $j++;
        }  

        return response()->json([
            // 'thang'=> $month,
            // 'tong'=> number_format($tong),
            // 'phong'=> number_format($phong),
            // 'tong_tt'=> number_format($tong_tt),
            // 'chua_tt'=> number_format($tong - $tong_tt),
            // 'khac'=> number_format($khac),
            // 'nhan'=> number_format($nhan)
            'thang'=> $month,
            'arr_donvi'=> $arr_donvi
        ]);
    }

    public function GetChamCong(){

        $lstChamCong = DB::table('vu_viec')
        ->where('LoaiVuViec_ID', 1)
        ->select('vu_viec.ID','vu_viec.NgayTiepNhan','vu_viec.NgayGD','vu_viec.NgayKT','vu_viec.GiamDinh','vu_viec.DonVi_TC','vu_viec.SoHoSo')
        ->get();
         // $lstPhuTrach = DB::table('phu_trach')
         //                ->join('can_bo', 'cham_cong.CanBo_ID', '=', 'can_bo.ID')
         //                ->select('can_bo.HoTen')
         //                ->get();
        return response()->json([
            'lstChamCong' => $lstChamCong
            // 'lstPhuTrach' => $lstPhuTrach
        ]);
    }

    public function frmChon_NgayGD(Request $request){
        $ID = $request->get("ID");
        $GiamDinh = $request->get("date_select");
        $arr_str = explode(',', $GiamDinh);

        $arr = array();
        foreach ($arr_str as $item) {
            $date_format = \DateTime::createFromFormat("d/m/Y", $item)->format("Y-m-d");
        // echo $date_format;
            $arr[] = $date_format;
        }

        $Convert_GD = implode(',', $arr);
        DB::table('vu_viec')
        ->where("ID", $ID)
        ->update([
            'GiamDinh' => $Convert_GD,
            'NgayGD' => null,
            'NgayKT' => null,
            'TrangThai' => 1
        ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/giam-dinh/danh-sach.html');
    }

    public function VanToc(){
        return view('giamdinh.vantoc');
    }

    public function Update_TT($ID){
        DB::table('vu_viec')
        ->where("ID", $ID)
        ->update([
            'ThanhToan' => 1
        ]);
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function Update_Refus($ID){
        DB::table('vu_viec')
        ->where("ID", $ID)
        ->update([
            'TrangThai' => -1
        ]);
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    //Lĩnh vực giám định
    public function list()
    {
        $query = DB::table('loai_vuviec')
            ->orderBy('ID', 'desc')
            ->paginate(10);
        $count_cv  = [];
        $lstLoaiVV = DB::table('loai_vuviec')->get();

        $i = 0;
        foreach ($lstLoaiVV as $item) {
            $count_cv[$i]['Count']         = DB::table('vu_viec')->where('LoaiVuViec_ID', $item->ID)->count();
            $count_cv[$i]['LoaiVuViec_ID'] = $item->ID;
            $i++;
        }
        return view('giamdinh.loaivv')->with([
            'query'    => $query,
            'count_cv' => $count_cv,
        ]);
    }

    public function Delete_LoaiVV($ID)
    {
        DB::table('vu_viec')->where('LoaiVuViec_ID', $ID)->delete();
        DB::table('loai_vuviec')->where("ID", $ID)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!',
        ]);
    }

    public function AddLoai_vv(Request $request)
    {
        $Ten    = $request->get("Ten");
        // $GhiChu = $request->get("GhiChu");
        DB::insert('insert into loai_vuviec
            (Ten, GhiChu)
            values (?, ?)',
            [$Ten, "Giám định"]);

        Session::flash('message', 'Thêm loại vụ việc thành công.');
        return redirect('/giam-dinh/linh-vuc.html');
    }

    public function EditLoai_vv(Request $request)
    {
        $ID     = $request->get("ID");
        // $GhiChu = $request->get("GhiChu");
        $Ten    = $request->get("Ten");

        DB::update('update loai_vuviec set Ten = ? where ID = ?',
            [$Ten, $ID]);

        Session::flash('message', 'Cập nhật loại vụ việc thành công.');
        return redirect('/giam-dinh/linh-vuc.html');
    }

    public function GetLoai_VVByID($ID)
    {
        $loai_vuviec = DB::table('loai_vuviec')->where('ID', $ID)->first();

        return response()->json([
            'query' => $loai_vuviec,
        ]);
    }

    

}

function GetPhuTrach($VuViec_ID){
    $arr = array();
    $phutrach = DB::table('phu_trach')
    ->join('can_bo', 'phu_trach.CanBo_ID', '=', 'can_bo.ID')
    ->where('VuViec_ID', $VuViec_ID)
    ->select('can_bo.HoTen','can_bo.ChucDanh')
    ->get();
    for($i = 0; $i < count($phutrach); $i++){
            // print_r($phutrach[$i]);
        $arr[$i]['HoTen'] = $phutrach[$i]->HoTen;
        if($phutrach[$i]->ChucDanh != "GĐV"){
            $arr[$i]['ChucDanh'] = false;
        }else{
            $arr[$i]['ChucDanh'] = true;
        }
    }
    return $arr;
}

function Validate_SoHoSo(string $SoHoSo): bool{

    $pattern = '/^(0[1-9]|[1-9][0-9]*)GT(0[1-9]|1[0-2])[0-9]{2}\/505CH$/';

    return preg_match($pattern, $SoHoSo) === 1;
}

function CheckExist_SoHoSo($SoHoSo){
    $check = false;
    $vuviec = DB::table('vu_viec')->where('SoHoSo', trim($SoHoSo))->count();
    if($vuviec != 0)
        $check = true;
    return $check;
}

function GetDonvi_id($SoCV){
    $DonVi_ID = 0;
    if(str_contains($SoCV, "VPCQCSĐT")){
        $donvi = DB::table('donvi_tc')->where('Ten', "PC01")->first();
        $DonVi_ID = $donvi->ID;
    }else if(str_contains($SoCV, "CSHS")){
        $donvi = DB::table('donvi_tc')->where('Ten', "PC02")->first();
        $DonVi_ID = $donvi->ID;
    }else if(str_contains($SoCV, "CSKT")){
        $donvi = DB::table('donvi_tc')->where('Ten', "PC03")->first();
        $DonVi_ID = $donvi->ID;
    }else if(str_contains($SoCV, "CSMT")){
        $donvi = DB::table('donvi_tc')->where('Ten', "PC04")->first();
        $DonVi_ID = $donvi->ID;
    }else if(str_contains($SoCV, "ANĐT")){
        $donvi = DB::table('donvi_tc')->where('Ten', "PA09")->first();
        $DonVi_ID = $donvi->ID;
    }else {
        $DonVi_ID = null;
    }

    return $DonVi_ID;
}

function Str_Metatitle($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(Đ)/", 'd', $str);
    $str = preg_replace("/(' ')/", '-', $str);
    $str = str_replace(" ","",trim($str));
    $str = strtolower($str);
    return $str;
}

