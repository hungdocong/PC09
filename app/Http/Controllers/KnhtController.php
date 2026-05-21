<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class KnhtController extends Controller
{
    //
    public function Index()
    {

        $ds_canbo = DB::table('can_bo')
            ->where('Vang', 0)
        // ->where('LanhDao', '!=', "Phòng")
            ->orderBy('HoTen')
            ->get();
        $ds_lanhdao = DB::table('can_bo')
            ->where('LanhDao', "Phòng")
            ->orderBy('HoTen')
            ->get();
        $lstLoai_vuviec = DB::table('loai_vuviec')->where('GhiChu', "GĐ")->get();
        $lstDonVi       = DB::table('donvi_tc')->orderBy('Ten', 'desc')->where('TrangThai', 1)->get();
        return view('knht.index')->with([
            'ds_canbo'       => $ds_canbo,
            'ds_lanhdao'     => $ds_lanhdao,
            'lstLoai_vuviec' => $lstLoai_vuviec,
            'lstDonVi'       => $lstDonVi,
        ]);
    }

    public function GetVuViec()
    {
        $lstKNHT = DB::table('knht')->get();
        $lstSuKien = DB::table('su_kien')->get();
        return response()->json([
            'lstKNHT'     => $lstKNHT,
            'lstSuKien'   => $lstSuKien,
        ]);
    }

    public function frmAdd_KNHT(Request $request)
    {

        // $CanBo_ID  = $request->get("CanBo_ID");
        $DiaDiem   = $request->get("DiaDiem");
        $TenVuViec = $request->get("TenVuViec");
        $NoiDung = $request->get("NoiDung");

        $NgayTiepNhan = Carbon::createFromFormat('d/m/Y', $request->get("NgayTiepNhan"))->format('Y-m-d');
        // $DonVi_ID     = $request->get("DonVi_ID");
        // $DonVi        = DB::table('donvi_tc')->where('ID', $DonVi_ID)->first();
        $DonVi        = $request->get("DonVi");

        $knht = $request->knht;
        $py = $request->py;
        DB::insert('insert into knht
                (TenVuViec, NgayTiepNhan, DonVi_TC, DiaDiem, NoiDung, TrangThai)
                values (?, ?, ?, ?, ?, ?)',
            [$TenVuViec, $NgayTiepNhan, $DonVi, $DiaDiem, $NoiDung, 0]);

        $KNHT_ID = DB::table('knht')->max('ID');
        foreach ($knht as $item) {
            // code...
            DB::insert('insert into phu_trach
                    (KNHT_ID, CanBo_ID, ChucDanh)
                    values (?, ?, ?)',
                [$KNHT_ID, $item, "KNHT"]);
        }

        if (!empty($py)) {
            foreach ($py as $item) {
            // code...
                DB::insert('insert into phu_trach
                    (KNHT_ID, CanBo_ID, ChucDanh)
                    values (?, ?, ?)',
                    [$KNHT_ID, $item, "Pháp y"]);
            }
        }
        Session::flash('message', 'Thêm vụ việc khám nghiệm hiện trường thành công.');
        return redirect('/knht/danh-sach.html');
    }

    public function frmEdit_KNHT(Request $request)
    {
        $ID = $request->get("ID");
        // $CanBo_ID  = $request->get("CanBo_ID");
        $DiaDiem   = $request->get("DiaDiem");
        $TenVuViec = $request->get("TenVuViec");
        $NoiDung = $request->get("NoiDung");

        $NgayTiepNhan = Carbon::createFromFormat('d/m/Y', $request->get("NgayTiepNhan"))->format('Y-m-d');
        // $DonVi_ID     = $request->get("DonVi_ID");
        // $DonVi        = DB::table('donvi_tc')->where('ID', $DonVi_ID)->first();
        $DonVi        = $request->get("DonVi");
        DB::table('knht')
            ->where("ID", $ID)
            ->update([
                'NgayTiepNhan' => $NgayTiepNhan,
                'DonVi_TC'     => $DonVi,
                'NoiDung'     => $NoiDung,
                'TenVuViec'    => $TenVuViec,
                'DiaDiem'      => $DiaDiem,
            ]);

        DB::table('phu_trach')->where("KNHT_ID", $ID)->where("ChucDanh", "KNHT")->delete();
        $knht = $request->knht;
        $py = $request->py;
        foreach ($knht as $item) {
            DB::insert('insert into phu_trach
                    (KNHT_ID, CanBo_ID, ChucDanh)
                    values (?, ?, ?)',
                [$ID, $item, "KNHT"]);

        }

        $check_py = DB::table('phu_trach')->where("KNHT_ID", $ID)->where("ChucDanh", "Pháp y")->count();

        if (!empty($py)) {
            if ($check_py != 0) {
                DB::table('phu_trach')->where("KNHT_ID", $ID)->where("ChucDanh", "Pháp y")->delete();
            }
            foreach ($py as $item) {
                    DB::insert('insert into phu_trach 
                        (KNHT_ID, CanBo_ID, ChucDanh) 
                        values (?, ?, ?)', 
                        [$ID, $item, "Pháp y"]);
            }
        }else{
            if ($check_py != 0) {
                DB::table('phu_trach')->where("KNHT_ID", $ID)->where("ChucDanh", "Pháp y")->delete();
            }
        }
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/knht/danh-sach.html');
    }
    public function getPhuTrachByID($ID)
    {
        $phutrach = DB::table('phu_trach')->where('VuViec_ID', $ID)->get();

        return response()->json([
            'query' => $phutrach,
        ]);
    }

    public function getPhuTrachKnhtID($ID)
    {
        $phutrach = DB::table('phu_trach')->where('KNHT_ID', $ID)->get();

        return response()->json([
            'query' => $phutrach,
        ]);
    }

    public function Delete($ID, $Type)
    {
        if ($Type == "KNHT") {
            $knht = DB::table('knht')->where("ID", $ID)->first();
            DB::table('phu_trach')
                ->where("KNHT_ID", $ID)
                ->delete();
            DB::table('knht')
                ->where("ID", $ID)
                ->delete();
        } else {
            DB::table('su_kien')
                ->where("ID", $ID)
                ->delete();
        }
        return response()->json([
            'success' => 'Record deleted successfully!',
        ]);
    }

    public function Import(){
        return view('knht.import');
    }

    public function FrmImport(Request $request){

        // require_once 'bootstrap.php';
        if ($request->hasFile('File')){
            $file = $request->file("File");

            // Thư mục upload $file_title = );
            $file_name  = Str_Metatitle($file->getClientOriginalName());
            $path = public_path('/assets/file/knht/');

            // Bắt đầu chuyển file vào thư mục
            $file->move($path, $file_name);

            $filepath = public_path('/assets/file/knht/'. $file_name);
            $reader = ReaderEntityFactory::createReaderFromFile($filepath);
            $reader->open($filepath);
            $knht = [];
            $dem = 0; $arr_error = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {

                    $cells = $row->getCells();


                    if (!is_numeric($cells[0]->getValue())){
                        continue;
                    }

                    $STT = $cells[0]->getValue(); 
                    if($cells[1]== null || $cells[1] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Tên vụ việc</span> không được bỏ trống.']);
                    if($cells[2]->getValue()== null || $cells[2]->getValue() == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Ngày tiếp nhận</span> không được bỏ trống.']);
                    }else if(is_string($cells[2]->getValue())){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Ngày tiếp nhận: <span class="text-red">'. $cells[2]->getValue() .' </span> sai định dạng ngày/tháng/năm hoặc không tồn tại.']);
                    }
                    if($cells[3]== null || $cells[3] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Đơn vị trưng cầu</span> không được bỏ trống.']);
                    if($cells[4]== null || $cells[4] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Địa điểm</span> không được bỏ trống.']);
                    if($cells[5]== null || $cells[5] == "")
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Nội dung vụ việc</span> không được bỏ trống.']);
                    
                    if($cells[6]== null || $cells[6] == ""){
                        array_push($arr_error, ['STT' => $STT, 'ERROR' => '<span class="text-red">Cán bộ KNHT</span> không được bỏ trống.']);
                    }else{
                        $arr_knht = explode(",", $cells[6]);
                        for ($i=0; $i < count($arr_knht) ; $i++) {
                            $canbo = DB::table('can_bo')->where('HoTen', trim($arr_knht[$i]))->count();
                            if($canbo == 0)
                                array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Cán bộ KNHT: <span class="text-red">' . $arr_knht[$i] . '</span> không có trong danh sách']);
                        }
                    }

                    if($cells[7] != null && $cells[7] != ""){
                        $arr_py = explode(",", $cells[7]);
                        for ($i=0; $i < count($arr_py) ; $i++) {
                            $canbo = DB::table('can_bo')->where('HoTen', trim($arr_py[$i]))->count();
                            if($canbo == 0)
                                array_push($arr_error, ['STT' => $STT, 'ERROR' => 'Cán bộ Pháp y: <span class="text-red">' . $arr_py[$i] . '</span> không có trong danh sách']);
                        }
                    }

                    $TenVuViec = $cells[1]; 
                    $NgayTiepNhan = $cells[2]->getValue(); 
                    $DonVi_TC = $cells[3]; 
                    $DiaDiem = $cells[4]; 
                    $NoiDung = $cells[5];
                    $CB_KNHT = $cells[6]; 
                    $PY = $cells[7];  

                    $knht[$dem] = [
                        "STT" => $STT,
                        "TenVuViec" => $TenVuViec->getValue(),
                        "NgayTiepNhan" => $NgayTiepNhan,
                        "DonVi_TC" => $DonVi_TC->getValue(),
                        "DiaDiem" => $DiaDiem->getValue(),
                        "NoiDung" => $NoiDung->getValue(),
                        "CB_KNHT" => $CB_KNHT->getValue(),
                        "CB_PY" => $PY->getValue()
                    ];

                    $dem++;
                }
            }

            // dd($arr_error);
            // print_r($giamdinh);
            
            // $loai_cv = DB::table('loai_cv')->where('ID', $LoaiCV_ID)->first();
            // $arr = array('LoaiCV_ID' => $LoaiCV_ID, 'Nam' => $Nam, 'TenLoai' => $loai_cv->TenLoai);

            Session::put('arr_error', $arr_error);
            Session::put('knht', $knht);
            Session::put('File_Name', $file_name);
            $reader->close();
            return view('knht.import');
        }
    }

    public function addImport(Request $request){

        foreach (Session::get('knht') as $key=>$value){

            $TenVuViec = $value['TenVuViec'];
            $NgayTiepNhan = $value['NgayTiepNhan'];
            $DonVi_TC = $value['DonVi_TC'] ;
            $DiaDiem = $value['DiaDiem'];
            $NoiDung = $value['NoiDung'];

            $arr_knht = explode(",", $value['CB_KNHT']);
            $phutrach = [];

            $j = 0;
            for ($i=0; $i < count($arr_knht) ; $i++) {
                $CB_ID = DB::table('can_bo')->where('HoTen', trim($arr_knht[$i]))->first()->ID;
                $phutrach[$i]['id'] = $CB_ID;
                $phutrach[$i]['chucdanh'] = "KNHT";
                $j++;
            }

            if ($value['CB_PY'] != null && $value['CB_PY'] != "") {
                $arr_py = explode(",", $value['CB_PY']);
                for ($i=0; $i < count($arr_py) ; $i++) {
                    $CB_ID = DB::table('can_bo')->where('HoTen', trim($arr_py[$i]))->first()->ID;
                    $phutrach[$j]['id'] = $CB_ID;
                    $phutrach[$j]['chucdanh'] = "Pháp y";
                    $j++;
                }
            }

            DB::insert('insert into knht
                (TenVuViec, NgayTiepNhan, DonVi_TC, DiaDiem, NoiDung, TrangThai)
                values (?, ?, ?, ?, ?, ?)',
            [$TenVuViec, $NgayTiepNhan, $DonVi_TC, $DiaDiem, $NoiDung, 0]);


            $KNHT_ID = DB::table('knht')->max('ID');
            $i = 0;
            foreach ($phutrach as $item) {
                $CanBo_ID = $phutrach[$i]['id'];
                $ChucDanh = $phutrach[$i]['chucdanh'];
                DB::insert('insert into phu_trach 
                    (KNHT_ID, CanBo_ID, ChucDanh) 
                    values (?, ?, ?)', 
                    [$KNHT_ID, $CanBo_ID, $ChucDanh]);
                $i++;
            }

        }
        Session::flash('message', 'Thêm vụ việc Khám nghiệm hiện trường thành công.');
        return redirect('/knht/danh-sach.html');
    }

    //Thống kê
    public function ThongKe(){
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $ds_canbo = DB::table('can_bo')
        ->where('Vang', 0)
        // ->where('Doi_ID', 3)
        ->orderBy('HoTen')
        ->get();

        // $lstVuViec = DB::table('vu_viec')->where('LoaiVuViec_ID', 1)->whereYear('NgayTiepNhan', $year)->get();
        // $lstLoai_vuviec = DB::table('loai_vuviec')->where('GhiChu', "GĐ")->get();
        // $lstVuViec = DB::table('vu_viec')->whereYear('NgayTiepNhan', $year)->get();
        $lstKNHT= DB::table('knht')->orderBy('NgayTiepNhan', 'desc')->get();
        $lstPhuTrach = DB::table('phu_trach')
                        ->join('can_bo', 'phu_trach.CanBo_ID', '=', 'can_bo.ID')
                        ->select('can_bo.ID','can_bo.HoTen','phu_trach.KNHT_ID','phu_trach.ChucDanh')
                        ->get();
        $lstDonVi = DB::table('donvi_tc')->orderBy('Ten', 'desc')->where('TrangThai', 1)->get();

        $lst_year = DB::table('vu_viec')->select('NgayTiepNhan')->get();
        $year = array(); $i = 0;
        foreach ($lst_year as $item) {
            // code...
            $yr = Carbon::createFromFormat('Y-m-d h:m:s', $item->NgayTiepNhan)->format('Y') + 1;
            if (!in_array($yr, $year)) {
                $year[] = $yr;
            } 
        }
        return view('knht.thongke')->with([
            'ds_canbo'=> $ds_canbo,
            // 'lstVuViec'=> $lstVuViec,
            'lstPhuTrach'=> $lstPhuTrach,
            'lstKNHT'=> $lstKNHT,
            'lstDonVi'=> $lstDonVi,
            'arryear'=> $year
        ]);
    }

     public function ListName($query){
        // $search = $request->query;
        $vuviec = DB::table('knht')
                ->where('TenVuViec', 'like', '%'.$query.'%')
                // ->orWhere('DiaDiem', 'like', '%'.$query.'%')
                ->select('TenVuViec')
                ->get();

        $response = array();
        foreach($vuviec as $autocomplate){
            $response[] = array("value"=>$autocomplate->TenVuViec);
       }

      echo json_encode($response);
        // return response()->json([
        //     'product' => $product
        // ]);
    }

    public function getPhuTrachKNHT_ID($ID)
    {
        $phutrach = DB::table('phu_trach')
                        ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
                        ->where('KNHT_ID', $ID)
                        ->select('can_bo.HoTen', 'phu_trach.ChucDanh')
                        ->get();
        return response()->json([
            'query' => $phutrach,
        ]);
    }

    public function Search(Request $request){
        $ds_canbo = DB::table('can_bo')
                        ->where('Vang', 0)
                        // ->where('Doi_ID', 3)
                        ->orderBy('HoTen')
                        ->get();
        $lstPhuTrach = DB::table('phu_trach')
                        ->join('can_bo', 'phu_trach.CanBo_ID', '=', 'can_bo.ID')
                        ->select('can_bo.ID','can_bo.HoTen','phu_trach.KNHT_ID','phu_trach.ChucDanh')
                        ->get();
        $keyword = $request->get('keyword');
        $DonVi = $request->get('DonVi');

        $TuNgay = $request->get('TuNgay');
        $DenNgay = $request->get('DenNgay');

        $phu_trach = $request->phu_trach;

        $lstDonVi = DB::table('donvi_tc')->orderBy('Ten', 'desc')->where('TrangThai', 1)->get();
        $lst_year = DB::table('Knht')->select('NgayTiepNhan')->get();
        $year = array(); 
        if(!empty($TuNgay) || !empty($DenNgay)){
            $Year_TuNgay = Carbon::parse($request->get('TuNgay'))->format('Y');
            $Year_DenNgay = Carbon::parse($request->get('DenNgay'))->format('Y');
            $year = range($Year_TuNgay, $Year_DenNgay);
            // dd($year);
        }else{
            $year = DB::table('Knht')
            ->selectRaw('YEAR(NgayTiepNhan) as year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        }
        // foreach ($lst_year as $item) {
        //     // code...
        //     $yr = Carbon::createFromFormat('Y-m-d h:m:s', $item->NgayTiepNhan)->format('Y') + 1;
        //     if (!in_array($yr, $year)) {
        //         $year[] = $yr;
        //     } 
        // }

        $coll_phutrach = collect();
        $params = [];
        if($keyword != "" && $DonVi != ""){

            // $lstKNHT = DB::table('knht')
            //                     ->where('TenVuViec', 'like', '%'.$keyword.'%')
            //                     ->Where('DonVi_TC', 'like', '%'.$DonVi.'%')
            //                     ->orderBy('NgayTiepNhan', 'desc')
            //                     ->get();
            $sql = "SELECT * FROM knht WHERE TenVuViec LIKE ? AND DonVi_TC LIKE ?";
            array_push($params, "%{$keyword}%", "%{$DonVi}%");
                                
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('TenVuViec', 'like', '%'.$keyword.'%')
                            ->Where('DonVi_TC', 'like', '%'.$DonVi.'%')
                            ->Where('NgayTiepNhan','>=', $tu_Ngay)
                            ->Where('NgayTiepNhan','<=', $den_Ngay)
                            ->select('knht.*')->get();
                    }else{
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('TenVuViec', 'like', '%'.$keyword.'%')
                            ->Where('DonVi_TC', 'like', '%'.$DonVi.'%')
                            ->select('knht.*')->get();
                    }
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'DiaDiem' => $jtem->DiaDiem,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'TrangThai' => $jtem->TrangThai,
                            'NoiDung' => $jtem->NoiDung
                        ]);
                    }
                }

               
                $lstKNHT = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });;
                return view('knht.thongke')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstPhuTrach'=> $lstPhuTrach,
                    'phutrach'=> $phu_trach,
                    'lstKNHT'=> $lstKNHT,
                    'lstDonVi'=> $lstDonVi,
                    'keyword'=> $keyword,
                    'Donvi'=> $DonVi,
                    'TuNgay'=> $TuNgay,
                    'DenNgay'=> $DenNgay,
                    'arryear'=> $year
                ]);
            }else if(!empty($TuNgay) || !empty($DenNgay)){
                $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                $sql .= " AND NgayTiepNhan >= ? AND NgayTiepNhan <= ?";
                array_push($params, $tu_Ngay, $den_Ngay);
            }
            $sql .= " ORDER BY NgayTiepNhan DESC";
            $lstKNHT = DB::select($sql, $params);

            return view('knht.thongke')->with([
                'ds_canbo'=> $ds_canbo,
                'lstPhuTrach'=> $lstPhuTrach,
                'phutrach'=> $phu_trach,
                'lstKNHT'=> $lstKNHT,
                'lstDonVi'=> $lstDonVi,
                'keyword'=> $keyword,
                'Donvi'=> $DonVi,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);

        }else if ($DonVi != "") {
            // $lstKNHT = DB::table('knht')
            //                     ->where('DonVi_TC', 'like', '%'.$DonVi.'%')
            //                     ->orderBy('NgayTiepNhan', 'desc')
            //                     ->get();
            $sql = "SELECT * FROM knht WHERE DonVi_TC LIKE ?";
            array_push($params, "%{$DonVi}%");

            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('DonVi_TC', 'like', '%'.$DonVi.'%')
                            ->Where('NgayTiepNhan','>=', $tu_Ngay)
                            ->Where('NgayTiepNhan','<=', $den_Ngay)
                            ->select('knht.*')->get();
                    }else{
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('DonVi_TC', 'like', '%'.$DonVi.'%')
                            ->select('knht.*')->get();
                    }
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'DiaDiem' => $jtem->DiaDiem,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'TrangThai' => $jtem->TrangThai,
                            'NoiDung' => $jtem->NoiDung
                        ]);
                    }
                }

                $lstKNHT = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });;
                return view('knht.thongke')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstPhuTrach'=> $lstPhuTrach,
                    'phutrach'=> $phu_trach,
                    'lstKNHT'=> $lstKNHT,
                    'lstDonVi'=> $lstDonVi,
                    'Donvi'=> $DonVi,
                    'TuNgay'=> $TuNgay,
                    'DenNgay'=> $DenNgay,
                    'arryear'=> $year
                ]);
            }else if(!empty($TuNgay) || !empty($DenNgay)){
                $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                $sql .= " AND NgayTiepNhan >= ? AND NgayTiepNhan <= ?";
                array_push($params, $tu_Ngay, $den_Ngay);
            }
            $sql .= " ORDER BY NgayTiepNhan DESC";
            $lstKNHT = DB::select($sql, $params);

            return view('knht.thongke')->with([
                'lstPhuTrach'=> $lstPhuTrach,
                'phutrach'=> $phu_trach,
                'ds_canbo'=> $ds_canbo,
                'lstKNHT'=> $lstKNHT,
                'lstDonVi'=> $lstDonVi,
                // 'keyword'=> $keyword,
                'Donvi'=> $DonVi,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }else if (!empty($keyword)){

             // $lstKNHT = DB::table('knht')
             //                    ->where('TenVuViec', 'like', '%'.$keyword.'%')
             //                    ->orderBy('NgayTiepNhan', 'desc')
             //                    ->get();
            $sql = "SELECT * FROM knht WHERE TenVuViec LIKE ?";
            array_push($params, "%{$keyword}%");
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('TenVuViec', 'like', '%'.$keyword.'%')
                            ->Where('NgayTiepNhan','>=', $tu_Ngay)
                            ->Where('NgayTiepNhan','<=', $den_Ngay)
                            ->select('knht.*')->get();
                    }else{
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->where('TenVuViec', 'like', '%'.$keyword.'%')
                            ->select('knht.*')->get();
                    }

                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'DiaDiem' => $jtem->DiaDiem,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'TrangThai' => $jtem->TrangThai,
                            'NoiDung' => $jtem->NoiDung
                        ]);
                    }
                }

                $lstKNHT = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });
                return view('knht.thongke')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstPhuTrach'=> $lstPhuTrach,
                    'phutrach'=> $phu_trach,
                    'lstKNHT'=> $lstKNHT,
                    'lstDonVi'=> $lstDonVi,
                    'keyword'=> $keyword,
                    'TuNgay'=> $TuNgay,
                    'DenNgay'=> $DenNgay,
                    'arryear'=> $year
                ]);
            }else if(!empty($TuNgay) || !empty($DenNgay)){
                $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                $sql .= " AND NgayTiepNhan >= ? AND NgayTiepNhan <= ?";
                array_push($params, $tu_Ngay, $den_Ngay);
            }
            $sql .= " ORDER BY NgayTiepNhan DESC";
            $lstKNHT = DB::select($sql, $params);
            return view('knht.thongke')->with([
                'lstPhuTrach'=> $lstPhuTrach,
                'phutrach'=> $phu_trach,
                'ds_canbo'=> $ds_canbo,
                'lstKNHT'=> $lstKNHT,
                'lstDonVi'=> $lstDonVi,
                'keyword'=> $keyword,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }else {

             // $lstKNHT = DB::table('knht')
             //                    ->orderBy('NgayTiepNhan', 'desc')
             //                    ->get();
             $sql = "SELECT * FROM knht ";
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->Where('NgayTiepNhan','>=', $tu_Ngay)
                            ->Where('NgayTiepNhan','<=', $den_Ngay)
                            ->select('knht.*')->get();
                    }else{
                        $data = DB::table('knht')
                            ->join('phu_trach', 'phu_trach.KNHT_ID', '=', 'knht.ID')
                            ->where('phu_trach.CanBo_ID', $item)
                            ->select('knht.*')->get();
                    }

                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'DiaDiem' => $jtem->DiaDiem,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'TrangThai' => $jtem->TrangThai,
                            'NoiDung' => $jtem->NoiDung
                        ]);
                    }
                }

                // echo "<pre>";
                // print_r($coll_phutrach);
                // echo "</pre>";
                $lstKNHT = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });
                return view('knht.thongke')->with([
                    'lstPhuTrach'=> $lstPhuTrach,
                    'phutrach'=> $phu_trach,
                    'ds_canbo'=> $ds_canbo,
                    'lstKNHT'=> $lstKNHT,
                    'lstDonVi'=> $lstDonVi,
                    'TuNgay'=> $TuNgay,
                    'DenNgay'=> $DenNgay,
                    'arryear'=> $year
                ]);
            }else if(!empty($TuNgay) || !empty($DenNgay)){
                $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                $sql .= " WHERE NgayTiepNhan >= ? AND NgayTiepNhan <= ?";
                array_push($params, $tu_Ngay, $den_Ngay);
            }
            $sql .= " ORDER BY NgayTiepNhan DESC";
            $lstKNHT = DB::select($sql, $params);
            return view('knht.thongke')->with([
                'lstPhuTrach'=> $lstPhuTrach,
                'phutrach'=> $phu_trach,
                'ds_canbo'=> $ds_canbo,
                'lstKNHT'=> $lstKNHT,
                'lstDonVi'=> $lstDonVi,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }
       
    }  

    public function Export(Request $request)
    {

        // Chuyển thành Collection
        $years = json_decode($request->arryear, true);
        $lstKNHT = json_decode($request->get('lstKNHT'), true);
        $reportTitle = $request->title;

        // Tạo export nhiều sheet ngay trong controller
        $export = new class($years, $reportTitle, $lstKNHT) implements WithMultipleSheets {
            protected $years;
            protected $reportTitle;
            protected $lstKNHT;
            public function __construct(array $years, string $reportTitle, array $lstKNHT)
            {
                $this->years = $years;
                $this->reportTitle = $reportTitle;
                $this->lstKNHT = $lstKNHT;
            }

            public function sheets(): array
            {
                $sheets = [];

                foreach ($this->years as $year) {

                // Mỗi năm là một sheet
                    $sheets[] = new class($year, $this->reportTitle, $this->lstKNHT) implements FromArray, WithTitle, WithStyles, ShouldAutoSize
                    {
                        protected $reportTitle;
                        protected $year;
                        protected $lstKNHT;

                        public function __construct($year, $reportTitle, $lstKNHT)
                        {
                            $this->year = $year;
                            $this->reportTitle = $reportTitle;
                            $this->lstKNHT = $lstKNHT;
                        }

                        public function array(): array
                        {
                            // Dữ liệu xuất ra Excel
                            $data = [];
                            // Dòng tiêu đề lớn
                            $data[] = [$this->reportTitle];
                            $data[] = ['Năm ' . $this->year];
                            // Header
                            $data[] = [
                                'STT',
                                'Tên vụ việc',
                                'Ngày tiếp nhận',
                                'ĐVTC',
                                'Địa điểm xảy ra vụ việc',
                                'Cán bộ KNHT',
                                'Pháp y',
                                'Nội dung vụ việc'
                            ];

                            // Tự động đánh số thứ tự
                            $stt = 1;
                            
                            foreach ($this->lstKNHT as $row) {
                                if(Carbon::parse($row['NgayTiepNhan'])->format('Y') != $this->year)
                                    continue;
                                $data[] = [
                                    $stt++,
                                    $row['TenVuViec'],
                                    date('d/m/Y', strtotime($row['NgayTiepNhan'])),
                                    $row['DonVi_TC'],
                                    $row['DiaDiem'],
                                    getPhuTrach_KNHT($row['ID']),
                                    getPhuTrach_PY($row['ID']),
                                    $row['NoiDung'],
                                ];
                            }
                            return $data;
                        }

                        public function title(): string
                        {
                            return (string) $this->year;
                        }   

                        public function headings(): array
                        {
                            return [
                                'STT',
                                'Tên vụ việc',
                                'Ngày tiếp nhận',
                                'ĐVTC',
                                'Địa điểm xảy ra vụ việc',
                                'Cán bộ KNHT',
                                'Pháp y',
                                'Nội dung vụ việc'
                            ];
                        }

                        public function styles(Worksheet $sheet)
                        {
                            // Tiêu đề trang
                            $columnCount = count($this->headings());
                            $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount);
                            // Gộp ô theo số lượng cột
                            $sheet->mergeCells("A1:{$lastColumn}1");

                            // Gán tiêu đề từ Controller
                            $sheet->setCellValue('A1', $this->reportTitle);
                             // Định dạng tiêu đề
                            $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
                                'font' => [
                                    'bold' => true,
                                    'size' => 18,
                                ],
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                                    'vertical'   => Alignment::VERTICAL_CENTER,
                                ],
                            ]);

                            // Định dạng tiêu đề cột
                            $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray([
                                'font' => [
                                    'bold' => true,
                                ],
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                                ],
                            ]);

                            return [];
                        }
                    };
                }

                return $sheets;
            }
        };

        return Excel::download($export, Str_Metatitle($reportTitle) . '.xlsx');
    }  

}

function getPhuTrach_KNHT($ID)
{
    $phutrach = DB::table('phu_trach')
    ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
    ->where('KNHT_ID', $ID)
    ->where('phu_trach.ChucDanh', 'KNHT')
    ->select('can_bo.HoTen')
    ->get();
    // dd($phutrach);
    $string = $phutrach->pluck('HoTen')->implode(', ') . '';
    return $string;
    // return $str_pt;
}

function getPhuTrach_PY($ID)
{
    $phutrach = DB::table('phu_trach')
        ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
        ->where('KNHT_ID', $ID)
        ->where('phu_trach.ChucDanh', 'Pháp y')
        ->select('can_bo.HoTen')
        ->get();
    // dd($phutrach);
    $string = $phutrach->pluck('HoTen')->implode(', ') . '' ;
    return $string;
    // return $str_pt;
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
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(' ')/", '-', $str);
    $str = str_replace(" ","",trim($str));
    $str = str_replace("/","-",$str);
    $str = str_replace("\\","-",$str);
    $str = str_replace(":","_",$str);
    $str = strtolower($str);
    return $str;
}

function isValidDate($date, $format = 'd/m/Y')
{
    try {
        $parsed = Carbon::createFromFormat($format, $date);

        return $parsed && $parsed->format($format) === $date;
    } catch (\Exception $e) {
        return false;
    }
}
