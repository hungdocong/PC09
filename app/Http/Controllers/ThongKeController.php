<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use app\Helper;
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

class ThongKeController extends Controller
{
    //
    public function Index(){
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $ds_canbo = DB::table('can_bo')->where('Vang', 0)->orderBy('HoTen')->get();

        $lstVuViec = DB::table('vu_viec')->orderBy('SoHoSo', 'desc')->get();
        
        $lstDonVi = DB::table('vu_viec')->select('DonVi_TC')->distinct()->orderBy('DonVi_TC', 'desc')->get();

        $lstLinhVuc = DB::table('loai_vuviec')->where('GhiChu', "GĐ")->get();
        $lst_year = DB::table('vu_viec')->select('NgayTiepNhan')->get();
        $year = array(); $i = 0;

        // $lstPhuTrach = DB::table('phu_trach')
        //                 ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
        //                 ->join('vu_viec', 'vu_viec.ID', '=', 'phu_trach.VuViec_ID')
        //                 ->where('VuViec_ID', '!=', null)
        //                 ->select('can_bo.HoTen','phu_trach.VuViec_ID', 'vu_viec.NgayTiepNhan')
        //                 ->get();
        foreach ($lst_year as $item) {
            // code...
            $yr = Carbon::createFromFormat('Y-m-d h:m:s', $item->NgayTiepNhan)->format('Y') + 1;
            if (!in_array($yr, $year)) {
                $year[] = $yr;
            } 
        }
        return view('thongke.index')->with([
            'ds_canbo'=> $ds_canbo,
            'lstLinhVuc'=> $lstLinhVuc,
                                            // 'lstPhuTrach'=> $lstPhuTrach,
            'lstVuViec'=> $lstVuViec,
            'lstDonVi'=> $lstDonVi,
            'arryear'=> $year
        ]);
    }

    public function ListName($query){
        // $search = $request->query;
        $vuviec = DB::table('vu_viec')->where('SoCV', 'like', '%'.$query.'%')->orWhere('SoHoSo', 'like', '%'.$query.'%')->select('SoCV','SoHoSo')->get();

        $response = array();
        foreach($vuviec as $autocomplate){
            $response[] = array("value"=>$autocomplate->SoCV,"label"=>$autocomplate->SoHoSo);
        }

        echo json_encode($response);
        // return response()->json([
        //     'product' => $product
        // ]);
    }

    public function getPhuTrachVVID($ID)
    {
        $phutrach = DB::table('phu_trach')
        ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
        ->where('VuViec_ID', $ID)
        ->select('can_bo.HoTen')
        ->get();
        return response()->json([
            'query' => $phutrach,
        ]);
    }

    public function Search(Request $request){
        $Linh_Vuc = $request->get('Linh_Vuc');
        $DonVi = $request->get('DonVi');

        $TuNgay = $request->get('TuNgay');
        $DenNgay = $request->get('DenNgay');

        $phu_trach = $request->phu_trach;
        $lstLinhVuc = DB::table('loai_vuviec')->where('GhiChu', "GĐ")->get();
        $ds_canbo = DB::table('can_bo')->where('Vang', 0)->orderBy('HoTen')->get();
        
        $lstDonVi = DB::table('vu_viec')->select('DonVi_TC')->distinct()->orderBy('DonVi_TC', 'desc')->get();
        $year = array();

        // echo "<br> TuNgay: " . $TuNgay;
        // echo "<br> DenNgay: " . $DenNgay;
        if(!empty($TuNgay) || !empty($DenNgay)){
            $Year_TuNgay = Carbon::parse($request->get('TuNgay'))->format('Y');
            $Year_DenNgay = Carbon::parse($request->get('DenNgay'))->format('Y');
            $year = range($Year_TuNgay, $Year_DenNgay);
            // dd($year);
        }else{
            $year = DB::table('vu_viec')
            ->selectRaw('YEAR(NgayTiepNhan) as year')
            ->distinct()
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        }
        
        $coll_phutrach = collect();
        $params = [];
        if($Linh_Vuc != "" && $DonVi != ""){
            $sql = "SELECT * FROM vu_viec WHERE LoaiVuViec_ID = ? AND DonVi_TC = ?";
            array_push($params, $Linh_Vuc, $DonVi);
            
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('LoaiVuViec_ID', $Linh_Vuc)
                        ->where('DonVi_TC', $DonVi)
                        ->Where('NgayTiepNhan','>=', $tu_Ngay)
                        ->Where('NgayTiepNhan','<=', $den_Ngay)
                        ->select('vu_viec.*')->distinct()->get();
                    }else{
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('LoaiVuViec_ID', $Linh_Vuc)
                        ->where('DonVi_TC', $DonVi)
                        ->select('vu_viec.*')->distinct()->get();
                    }
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'SoCV' => $jtem->SoCV,
                            'NgayTC' => $jtem->NgayTC,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'SoHoSo' => $jtem->SoHoSo,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'CanBo_ID ' => $jtem->CanBo_ID,
                            'NgayGD' => $jtem->NgayGD,
                            'NgayKT' => $jtem->NgayKT,
                            'LoaiVuViec_ID ' => $jtem->LoaiVuViec_ID,
                            'NoiDung' => $jtem->NoiDung,
                            'ThoiGian' => $jtem->ThoiGian,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'DiaDiem' => $jtem->DiaDiem,
                            'TrangThai' => $jtem->TrangThai
                        ]);
                    }
                }

                $lstVuViec = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });
                return view('thongke.index')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstVuViec'=> $lstVuViec,
                    'lstLinhVuc'=> $lstLinhVuc,
                    'lstDonVi'=> $lstDonVi,
                    'Linh_Vuc'=> $Linh_Vuc,
                    'Donvi'=> $DonVi,
                    'phutrach'=> $phu_trach,
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
            $lstVuViec = DB::select($sql, $params);
            return view('thongke.index')->with([
                'ds_canbo'=> $ds_canbo,
                'lstVuViec'=> $lstVuViec,
                'lstLinhVuc'=> $lstLinhVuc,
                'lstDonVi'=> $lstDonVi,
                'Linh_Vuc'=> $Linh_Vuc,
                'Donvi'=> $DonVi,
                'phutrach'=> $phu_trach,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }else if ($DonVi != "") {
            $sql = "SELECT *
            FROM vu_viec WHERE DonVi_TC = ?";
            array_push($params, $DonVi);
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('DonVi_TC', $DonVi)
                        ->Where('NgayTiepNhan','>=', $tu_Ngay)
                        ->Where('NgayTiepNhan','<=', $den_Ngay)
                        ->select('vu_viec.*')->distinct()->get();
                    }else{
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('DonVi_TC', $DonVi)
                        ->select('vu_viec.*')->distinct()->get();
                    }
                    
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'SoCV' => $jtem->SoCV,
                            'NgayTC' => $jtem->NgayTC,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'SoHoSo' => $jtem->SoHoSo,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'CanBo_ID ' => $jtem->CanBo_ID,
                            'NgayGD' => $jtem->NgayGD,
                            'NgayKT' => $jtem->NgayKT,
                            'LoaiVuViec_ID ' => $jtem->LoaiVuViec_ID,
                            'NoiDung' => $jtem->NoiDung,
                            'ThoiGian' => $jtem->ThoiGian,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'DiaDiem' => $jtem->DiaDiem,
                            'TrangThai' => $jtem->TrangThai
                        ]);
                    }
                }

                $lstVuViec = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });;

                return view('thongke.index')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstVuViec'=> $lstVuViec,
                    'lstLinhVuc'=> $lstLinhVuc,
                    'lstDonVi'=> $lstDonVi,
                    'Donvi'=> $DonVi,
                    'phutrach'=> $phu_trach,
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
            $lstVuViec = DB::select($sql, $params);
            return view('thongke.index')->with([
                'ds_canbo'=> $ds_canbo,
                'lstVuViec'=> $lstVuViec,
                'lstLinhVuc'=> $lstLinhVuc,
                'lstDonVi'=> $lstDonVi,
                'Donvi'=> $DonVi,
                'phutrach'=> $phu_trach,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }else if ($Linh_Vuc != ""){
            $sql = "SELECT * FROM vu_viec WHERE LoaiVuViec_ID = ?";
            array_push($params, $Linh_Vuc);
            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('LoaiVuViec_ID', $Linh_Vuc)
                        ->Where('NgayTiepNhan','>=', $TuNgay)
                        ->Where('NgayTiepNhan','<=', $DenNgay)
                        ->select('vu_viec.*')->distinct()->get();
                    }else{
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->where('LoaiVuViec_ID', $Linh_Vuc)
                        ->select('vu_viec.*')->distinct()->get();
                    }
                    
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'SoCV' => $jtem->SoCV,
                            'NgayTC' => $jtem->NgayTC,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'SoHoSo' => $jtem->SoHoSo,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'CanBo_ID ' => $jtem->CanBo_ID,
                            'NgayGD' => $jtem->NgayGD,
                            'NgayKT' => $jtem->NgayKT,
                            'LoaiVuViec_ID ' => $jtem->LoaiVuViec_ID,
                            'NoiDung' => $jtem->NoiDung,
                            'ThoiGian' => $jtem->ThoiGian,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'DiaDiem' => $jtem->DiaDiem,
                            'TrangThai' => $jtem->TrangThai
                        ]);
                    }
                }

                $lstVuViec = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });

                return view('thongke.index')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstVuViec'=> $lstVuViec,
                    'lstLinhVuc'=> $lstLinhVuc,
                    'lstDonVi'=> $lstDonVi,
                    'Linh_Vuc'=> $Linh_Vuc,
                    'phutrach'=> $phu_trach,
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
            $lstVuViec = DB::select($sql, $params);
            return view('thongke.index')->with([
                'ds_canbo'=> $ds_canbo,
                'lstVuViec'=> $lstVuViec,
                'lstLinhVuc'=> $lstLinhVuc,
                'lstDonVi'=> $lstDonVi,
                'Linh_Vuc'=> $Linh_Vuc,
                'phutrach'=> $phu_trach,
                'TuNgay'=> $TuNgay,
                'DenNgay'=> $DenNgay,
                'arryear'=> $year
            ]);
        }else{
            $sql = "SELECT * FROM vu_viec ";

            if(!empty($phu_trach)){
                foreach ($phu_trach as $item) {
                    // code...
                    if(!empty($TuNgay) || !empty($DenNgay)){
                        $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                        $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->Where('NgayTiepNhan','>=', $tu_Ngay)
                        ->Where('NgayTiepNhan','<=', $den_Ngay)
                        ->select('vu_viec.*')->distinct()->get();
                    }else{
                        $data = DB::table('vu_viec')
                        ->join('phu_trach', 'phu_trach.VuViec_ID', '=', 'vu_viec.ID')
                        ->where('phu_trach.CanBo_ID', $item)
                        ->select('vu_viec.*')->distinct()->get();
                    }
                    
                    foreach ($data as $jtem) {
                        $coll_phutrach->push([
                            'ID' => $jtem->ID,
                            'TenVuViec' => $jtem->TenVuViec,
                            'SoCV' => $jtem->SoCV,
                            'NgayTC' => $jtem->NgayTC,
                            'DonVi_TC' => $jtem->DonVi_TC,
                            'SoHoSo' => $jtem->SoHoSo,
                            'NgayTiepNhan' => $jtem->NgayTiepNhan,
                            'CanBo_ID ' => $jtem->CanBo_ID,
                            'NgayGD' => $jtem->NgayGD,
                            'NgayKT' => $jtem->NgayKT,
                            'LoaiVuViec_ID ' => $jtem->LoaiVuViec_ID,
                            'NoiDung' => $jtem->NoiDung,
                            'ThoiGian' => $jtem->ThoiGian,
                            'DonVi_ID' => $jtem->DonVi_ID,
                            'DiaDiem' => $jtem->DiaDiem,
                            'TrangThai' => $jtem->TrangThai
                        ]);
                    }
                }

                $lstVuViec = $coll_phutrach->map(function ($item) {
                    return (object) $item;
                });;
                return view('thongke.index')->with([
                    'ds_canbo'=> $ds_canbo,
                    'lstVuViec'=> $lstVuViec,
                    'lstLinhVuc'=> $lstLinhVuc,
                    'lstDonVi'=> $lstDonVi,
                    'phutrach'=> $phu_trach,
                    'TuNgay'=> $TuNgay,
                    'DenNgay'=> $DenNgay,
                    'arryear'=> $year
                ]);
            }else if(!empty($TuNgay) || !empty($DenNgay)){
                $tu_Ngay = Carbon::parse($TuNgay)->format('Y-m-d');
                $den_Ngay = Carbon::parse($DenNgay)->format('Y-m-d');
                $sql .= " WHERE NgayTiepNhan BETWEEN ? AND ?";
                array_push($params, $tu_Ngay, $den_Ngay);
            }
            $sql .= " ORDER BY NgayTiepNhan DESC";
            $lstVuViec = DB::select($sql, $params);
            // dd($params);
            // dd($lstVuViec);
            return view('thongke.index')->with([
                'ds_canbo'=> $ds_canbo,
                'lstVuViec'=> $lstVuViec,
                'lstLinhVuc'=> $lstLinhVuc,
                'lstDonVi'=> $lstDonVi,
                'phutrach'=> $phu_trach,
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
        $lstVuViec = json_decode($request->get('lstVuViec'), true);
        $reportTitle = $request->title;
        // dd($lstVuViec);
         // echo getPhuTrach(5);
         // echo "<br> Str_Metatitle: " . Str_Metatitle($reportTitle);
         // echo "<br> Str_Metatitle \: " . Str_Metatitle(str_replace("/",'\\',$reportTitle));
        // Tạo export nhiều sheet ngay trong controller
        $export = new class($years, $reportTitle, $lstVuViec) implements WithMultipleSheets {
            protected $years;
            protected $reportTitle;
            protected $lstVuViec;
            public function __construct(array $years, string $reportTitle, array $lstVuViec)
            {
                $this->years = $years;
                $this->reportTitle = $reportTitle;
                $this->lstVuViec = $lstVuViec;
            }

            public function sheets(): array
            {
                $sheets = [];

                foreach ($this->years as $year) {

                // Mỗi năm là một sheet
                    $sheets[] = new class($year, $this->reportTitle, $this->lstVuViec) implements FromArray, WithTitle, WithStyles, ShouldAutoSize
                    {
                        protected $reportTitle;
                        protected $year;
                        protected $lstVuViec;

                        public function __construct($year, $reportTitle, $lstVuViec)
                        {
                            $this->year = $year;
                            $this->reportTitle = $reportTitle;
                            $this->lstVuViec = $lstVuViec;
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
                                'Lĩnh vực',
                                'Số hồ sơ',
                                'Ngày lập',
                                'ĐVTC',
                                'Số trưng cầu',
                                'Chấm công',
                                'Tên vụ việc',
                                'Xảy ra (thời gian)',
                                'Tại (Địa điểm)',
                                'GĐV/TLGĐ',
                                'Trạng thái'
                            ];

                            // Tự động đánh số thứ tự
                            $stt = 1;
                            
                            foreach ($this->lstVuViec as $row) {
                                if(Carbon::parse($row['NgayTiepNhan'])->format('Y') != $this->year)
                                    continue;
                                if(!empty($row['NgayGD']) || !empty($row['NgayKT']))
                                    $ChamCong = date('d/m/Y', strtotime($row['NgayGD'])). ' - ' . date('d/m/Y', strtotime($row['NgayKT']));
                                else
                                    $ChamCong = '';
                                if($row['TrangThai'] == 0)
                                    $TrangThai = 'Đã tiếp nhận';
                                else
                                    $TrangThai = 'Đã kết luận';
                                $data[] = [
                                    $stt++,
                                    $row['TenVuViec'],
                                    $row['SoHoSo'],
                                    date('d/m/Y', strtotime($row['NgayTiepNhan'])),
                                    $row['DonVi_TC'],
                                    $row['SoCV'] . ' - ' . date('d/m/Y', strtotime($row['NgayTC'])),
                                    $ChamCong,
                                    $row['NoiDung'],
                                    $row['ThoiGian'],
                                    $row['DiaDiem'],
                                    getPhuTrach($row['ID']),
                                    $TrangThai,
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
                                'Lĩnh vực',
                                'Số hồ sơ',
                                'Ngày lập',
                                'ĐVTC',
                                'Số trưng cầu',
                                'Chấm công',
                                'Tên vụ việc',
                                'Xảy ra (thời gian)',
                                'Tại (Địa điểm)',
                                'GĐV/TLGĐ',
                                'Trạng thái'
                            ];
                        }

                        public function styles(Worksheet $sheet)
                        {
                            // Tiêu đề trang
                            // $sheet->mergeCells($this->headings());
                            // $sheet->setCellValue('A1', 'DANH SÁCH NGƯỜI DÙNG');
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


function getPhuTrach($ID)
{
    $phutrach = DB::table('phu_trach')
    ->join('can_bo', 'can_bo.ID', '=', 'phu_trach.CanBo_ID')
    ->where('VuViec_ID', $ID)
    ->select('can_bo.HoTen')
    ->get();
    // dd($phutrach);
    $string = $phutrach->pluck('HoTen')->implode(', ') . '.';
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
