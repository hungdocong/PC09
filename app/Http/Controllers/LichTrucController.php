<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class LichTrucController extends Controller
{
    //
    public function Index(){
        
        $lichtruc = DB::table('lich_truc')->orderBy('NgayCapNhat', 'desc')->first();

        $date_now = Carbon::now('Asia/Ho_Chi_Minh');

        $weekStartDate = $date_now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $date_now->endOfWeek()->format('Y-m-d');

        $ngaycapnhat = !empty($lichtruc) ? Carbon::parse($lichtruc->NgayCapNhat)->format('Y-m-d') : "";
        // $ngaycapnhat = Carbon::parse('2022-07-1 07:51:10')->format('Y-m-d');

        // echo "date-monday: ". $date_now->startOfWeek()->addDays(0)->format('Y-m-d') ." <br>";
        // echo "date-friday: ". $date_now->startOfWeek()->addDays(4)->format('Y-m-d') ." <br>";

        //Ngày cập nhật thuộc ngày trong tuần không?
        // if($weekStartDate >= $ngaycapnhat){
        //     echo "weekStartDate: ". $weekStartDate ." <br>";
        //     echo "ngaycapnhat: ". $ngaycapnhat ." <br>";
        //     echo "weekEndDate: ". $weekEndDate ." <br>";
          
        //     echo "weekStartDate >= ngaycapnhat <br>";
        //     $TuNgay = $date_now->startOfWeek()->addDays(0)->format('Y-m-d');
        //     $DenNgay = $date_now->startOfWeek()->addDays(4)->format('Y-m-d');
        //     echo "date-monday: ". $TuNgay ." <br>";
        //     echo "date-friday: ". $DenNgay ." <br>";
        // }else{
        //     echo "weekStartDate <= ngaycapnhat <br>";
        // }

        // $week_now = $date_now->weekOfYear;
        // $week_check = $date_check->weekOfYear;

        // $date = getdate();
        // $weekday = $date['weekday'];
        
        //Kiểm tra xem đã sang tuần mới chưa để tự động xếp lịch
        $ds_canbo = DB::table('can_bo')
                        ->where('LanhDao','!=', 'Phòng')
                        ->where('Vang', 1)
                        ->orderBy('HoTen')
                        ->get();
        $ds_lanhdao = DB::table('can_bo')
                        ->where('LanhDao', 'Phòng')
                        ->where('Vang', 1)
                        ->orderBy('HoTen')
                        ->get();
        if($weekStartDate > $ngaycapnhat){
            
            $TuNgay = $date_now->startOfWeek()->addDays(0)->format('Y-m-d');
            $DenNgay = $date_now->startOfWeek()->addDays(4)->format('Y-m-d');

            $lanhdao_truc = DB::table('lich_truc')
                        ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
                        ->select('lich_truc.ID','lich_truc.TuNgay','lich_truc.DenNgay','lich_truc.LoaiTruc','can_bo.HoTen','lich_truc.NgayCapNhat','lich_truc.Truc_LD')
                        ->where('lich_truc.LoaiTruc', 'Trực ban')
                        ->where('lich_truc.Truc_LD', '!=', null)
                        ->take(count($ds_lanhdao) - 1)
                        ->get();
            $canbo_truc = DB::table('ct_lichtruc')
                        ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->select('ct_lichtruc.ID','ct_lichtruc.NgayTruc','can_bo.HoTen','ct_lichtruc.CanBo_ID')
                        ->orderBy('lich_truc.ID', 'desc')
                        ->take(10)
                        ->get();

            //Phân lãnh đạo trực
            foreach ($ds_lanhdao as $item) {
                if(!$lanhdao_truc->contains('Truc_LD', $item->ID)){

                    // $TuNgay = Carbon::today()->addDays(1)->format('Y-m-d');
                    // $DenNgay = Carbon::today()->addDays(5)->format('Y-m-d');
                    $LoaiTruc = "Trực ban";
                    $NgayCapNhat = Carbon::now('Asia/Ho_Chi_Minh');
                    $Truc_LD = $item->ID;

                    DB::insert('insert into lich_truc 
                        (TuNgay, DenNgay, LoaiTruc, NgayCapNhat, Truc_LD) 
                        values (?, ?, ?, ?, ?)', 
                        [$TuNgay, $DenNgay, $LoaiTruc, $NgayCapNhat, $Truc_LD]);

                    break;
                }
            }

            $dem = 0;

            $LichTruc_ID = DB::table('lich_truc')->max('ID');
            foreach ($ds_canbo as $item) {
                if(!$canbo_truc->contains('CanBo_ID', $item->ID) && $dem <= 4){

                    $NgayTruc = $date_now->startOfWeek()->addDays($dem)->format('Y-m-d');
                    $CanBo_ID = $item->ID;

                    DB::insert('insert into ct_lichtruc 
                        (NgayTruc, LichTruc_ID, CanBo_ID) 
                        values (?, ?, ?)', 
                        [$NgayTruc, $LichTruc_ID, $CanBo_ID]);
                   
                    $dem++;
                }

            }

            //Nếu chưa đủ 5 người trực ban
            if($dem <= 4){
                foreach ($ds_canbo as $item) {
                    $NgayTruc = $date_now->startOfWeek()->addDays($dem)->format('Y-m-d');
                    $CanBo_ID = $item->ID;

                    DB::insert('insert into ct_lichtruc 
                        (NgayTruc, LichTruc_ID, CanBo_ID) 
                        values (?, ?, ?)', 
                        [$NgayTruc, $LichTruc_ID, $CanBo_ID]);
                    $dem++;
                    if($dem > 4)
                        break;
                }
            }

            //Phân lịch trực khám nghiệm
            TrucKN($TuNgay, $DenNgay);            
        }
        
        return view('lichtruc.index')->with([
                                            'ds_canbo'=> $ds_canbo,
                                            'ds_lanhdao'=> $ds_lanhdao
                                        ]);

        
    }

    public function GetLichTruc(){
       
        $lanhdao_truc = DB::table('lich_truc')
                        ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
                        ->select('lich_truc.ID','lich_truc.TuNgay','lich_truc.DenNgay','lich_truc.LoaiTruc','can_bo.HoTen','lich_truc.NgayCapNhat','lich_truc.Truc_LD')
                        ->where('lich_truc.LoaiTruc', 'Trực ban')
                        // ->orwhere('lich_truc.LoaiTruc', 'Trực khám nghiệm')
                        ->get();
        $trucban = DB::table('ct_lichtruc')
                        ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', 'Trực ban')
                        ->select('ct_lichtruc.ID','ct_lichtruc.NgayTruc','ct_lichtruc.CanBo_ID','can_bo.HoTen','lich_truc.LoaiTruc')
                        ->get();
        $truc_kn = DB::table('ct_lichtruc')
                        ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', 'Trực khám nghiệm')
                        ->select('ct_lichtruc.ID','ct_lichtruc.NgayTruc','ct_lichtruc.CanBo_ID','can_bo.HoTen','lich_truc.LoaiTruc')
                        ->get();
        return response()->json([
            'lanhdao_truc' => $lanhdao_truc,
            'trucban' => $trucban,
            'truc_kn' => $truc_kn
        ]);
    }

    //Xóa lịch trực cán bộ
    public function Delete($ID){
        DB::table('ct_lichtruc')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    //Cập nhật lịch trực cán bộ
    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $CanBo_ID = $request->get("CanBo_ID");

        DB::table('ct_lichtruc')
            ->where("ID", $ID)
            ->update([
                'CanBo_ID' => $CanBo_ID
            ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/lich-truc/danh-sach.html');
    }


    //Cập nhật lịch trực lãnh đạo
    public function frmEditLichTruc(Request $request){

        $ID = $request->get("ID");
        $Truc_LD = $request->get("Truc_LD");
        $TuNgay = Carbon::createFromFormat('d-m-Y', $request->get("TuNgay"))->format('Y-m-d');
        $DenNgay = Carbon::createFromFormat('d-m-Y', $request->get("DenNgay"))->format('Y-m-d');

        DB::table('lich_truc')
            ->where("ID", $ID)
            ->update([
                'Truc_LD' => $Truc_LD,
                'TuNgay' => $TuNgay,
                'DenNgay' => $DenNgay
            ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/lich-truc/danh-sach.html');
    }

    //Thêm mới cán bộ trực ban
    public function frmAdd(Request $request){

        $CanBo_ID = $request->get("CanBo_ID");
        $NgayTruc = $request->get("NgayTruc");
        $LichTruc_ID = DB::table('lich_truc')->max('ID');

        DB::insert('insert into ct_lichtruc 
                        (NgayTruc, LichTruc_ID, CanBo_ID) 
                        values (?, ?, ?)', 
                        [$NgayTruc, $LichTruc_ID, $CanBo_ID]);
        Session::flash('message', 'Thêm cán bộ trực ban thành công.');
        return redirect('/lich-truc/danh-sach.html');
    }

    public function Other(){
        $ds_canbo = DB::table('can_bo')
                        ->where('LanhDao','!=', 'Phòng')
                        ->where('Status', 1)
                        ->orderBy('HoTen')
                        ->get();
        $ds_lanhdao = DB::table('can_bo')
                        ->where('LanhDao', 'Phòng')
                        ->where('Status', 1)
                        ->orderBy('HoTen')
                        ->get();
        return view('lichtruc.other')->with([
                                            'ds_canbo'=> $ds_canbo,
                                            'ds_lanhdao'=> $ds_lanhdao
                                        ]);
    }

    public function GetLichTrucKhac(){
       
        $lanhdao_truc = DB::table('lich_truc')
                        ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
                        ->select('lich_truc.ID','lich_truc.TuNgay','lich_truc.DenNgay','lich_truc.LoaiTruc','can_bo.HoTen','lich_truc.NgayCapNhat','lich_truc.Truc_LD')
                        ->where('lich_truc.LoaiTruc', '!=', 'Trực ban')
                        ->get();
        $canbo_truc = DB::table('ct_lichtruc')
                        // ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->where('ct_lichtruc.LichTruc_ID', null)
                        ->select('ct_lichtruc.ID','ct_lichtruc.NgayTruc','ct_lichtruc.CanBo_ID','can_bo.HoTen')
                        ->get();
        
        return response()->json([
            'lanhdao_truc' => $lanhdao_truc,
            'canbo_truc' => $canbo_truc
        ]);
    }

    //Thêm mới lịch trực khác
    public function frmAdd_Other(Request $request){
        $DateRange = $request->get("DateRange");
        $SoLuong = $request->get("SoLuong");
        $LoaiTruc = $request->get("LoaiTruc");

        $date = explode(" - ", $DateRange);
        // echo "Daterange: " . $DateRange;
        // echo "<br>";
        // echo "start: " . $date[0];
        // echo "<br>";
        // echo "end: " . $date[1];

        $start = Carbon::createFromFormat('d/m/Y', $date[0])->format('d-m-Y');
        $end = Carbon::createFromFormat('d/m/Y', $date[1])->format('d-m-Y');

        $Date_nhan_tra = CarbonPeriod::create($start, $end);
        //  echo "<br>";    
        // echo "count " . count($Date_nhan_tra);
        
        $ds_canbo = DB::table('can_bo')
                        ->where('LanhDao','!=', 'Phòng')
                        ->where('Status', 1)
                        ->orderBy('HoTen')
                        ->get();
        $ds_lanhdao = DB::table('can_bo')
                        ->where('LanhDao', 'Phòng')
                        ->where('Status', 1)
                        ->orderBy('HoTen')
                        ->get();

        $ld_truc = [];

        $dem = 0;
       while(true){
            foreach ($ds_lanhdao as $item) {
               // code...
                $ld_truc[$dem] = $item->ID;
                $dem++;
                if($dem == count($Date_nhan_tra))
                    break;
            }
            
            if($dem == count($Date_nhan_tra))
                    break;
       }

       // echo "Lịch trực lãnh đạo<br>";    
       // print_r($ld_truc);
       // echo "<br>";

       $i = 0;
       $NgayCapNhat = Carbon::now('Asia/Ho_Chi_Minh');
       foreach ($Date_nhan_tra as $item) {
           // code...

           $NgayTruc = Carbon::parse($item)->format('Y-m-d');
           DB::insert('insert into lich_truc 
                        (TuNgay, DenNgay, LoaiTruc, NgayCapNhat, Truc_LD) 
                        values (?, ?, ?, ?, ?)', 
                        [$NgayTruc, $NgayTruc, $LoaiTruc, $NgayCapNhat, $ld_truc[$i]]);

           $i++;
       }

        
       $canbo_truc = [];
       
       $i = 0;
       $so_cb = count($Date_nhan_tra) * $SoLuong;
       while(true){
            foreach ($ds_canbo as $item){
                $canbo_truc[$i] = $item->ID;
                $i++;
                if($i == $so_cb)
                    break;
            }

            if($i == $so_cb)
                break;
       }
          
       $dem = 0;
       $canbo_truc_next = [];
       $canbo = [];
       foreach ($canbo_truc as $item) {
                // code...
            array_push($canbo, $item);
            $dem++;
            if($dem == $SoLuong){
                array_push($canbo_truc_next, $canbo);
                $dem = 0;
                $canbo = [];
            }
        }

        $i = 0;

        foreach ($Date_nhan_tra as $item) {
           
           $NgayTruc = Carbon::parse($item)->format('Y-m-d');
           foreach ($canbo_truc_next[$i] as $value) {
               // code...
                // echo $value;
                // echo "<br>";

                DB::insert('insert into ct_lichtruc 
                        (NgayTruc, CanBo_ID) 
                        values (?, ?)', 
                        [$NgayTruc, $value]);

           }
           
           $i++;
       }

        Session::flash('message', 'Xếp lịch trực thành công.');
        return redirect('/lich-truc/lich-truc-khac.html');
    }

    //Cập nhật lịch trực cán bộ
    public function frmEdit_Other(Request $request){

        $ID = $request->get("ID");
        $CanBo_ID = $request->get("CanBo_ID");

        DB::table('ct_lichtruc')
            ->where("ID", $ID)
            ->update([
                'CanBo_ID' => $CanBo_ID
            ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/lich-truc/lich-truc-khac.html');
    }


    //Cập nhật lịch trực lãnh đạo
    public function frmEditLichTruc_Other(Request $request){

        $ID = $request->get("ID");
        $Truc_LD = $request->get("Truc_LD");
        DB::table('lich_truc')
            ->where("ID", $ID)
            ->update([
                'Truc_LD' => $Truc_LD
            ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/lich-truc/lich-truc-khac.html');
    }

    
}

function TrucKN($TuNgay, $DenNgay){
    // $TuNgay = Carbon::today()->addDays(0)->format('Y-m-d');
    // $DenNgay = Carbon::today()->addDays(6)->format('Y-m-d');
    //Lịch trực khám nghiệm
    // $cb_truckn = DB::table('ct_lichtruc')
    //                 ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
    //                 ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
    //                 ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
    //                 ->where('lich_truc.LoaiTruc', "Trực khám nghiệm")
    //                 ->select('ct_lichtruc.ID','ct_lichtruc.NgayTruc','can_bo.HoTen','ct_lichtruc.CanBo_ID')
    //                 ->orderBy('lich_truc.ID', 'desc')
    //                 ->take(10)
    //                 ->get();

    $NgayCapNhat = Carbon::now('Asia/Ho_Chi_Minh');
    DB::insert('insert into lich_truc 
        (TuNgay, DenNgay, LoaiTruc, NgayCapNhat) 
        values (?, ?, ?, ?)', 
        [$TuNgay, $DenNgay, "Trực khám nghiệm", $NgayCapNhat]);            


    $LichTruc_ID = DB::table('lich_truc')->max('ID');

    $start = Carbon::createFromFormat('Y-m-d', $TuNgay)->format('d-m-Y');
    $end = Carbon::createFromFormat('Y-m-d', $DenNgay)->format('d-m-Y');

    $Date_nhan_tra = CarbonPeriod::create($start, $end);

    $ds_canbo = DB::table('can_bo')
            ->where('LanhDao','!=', 'Phòng')
            ->where('Status', 1)
            ->where('Doi_ID', 1)
            ->orderBy('HoTen')
            ->get();

    $canbo_truc = [];

    $i = 0;
    $so_cb = count($Date_nhan_tra) * 2;
    while(true){
        foreach ($ds_canbo as $item){
            $canbo_truc[$i] = $item->ID;
            $i++;
            if($i == $so_cb)
                break;
        }

        if($i == $so_cb)
            break;
    }

    $dem = 0;
    $canbo_truc_next = [];
    $canbo = [];
    foreach ($canbo_truc as $item) {
                // code...
        array_push($canbo, $item);
        $dem++;
        if($dem == 2){
            array_push($canbo_truc_next, $canbo);
            $dem = 0;
            $canbo = [];
        }
    }

    $i = 0;

    foreach ($Date_nhan_tra as $item) {

         $NgayTruc = Carbon::parse($item)->format('Y-m-d');
         foreach ($canbo_truc_next[$i] as $value) {

            DB::insert('insert into ct_lichtruc 
                (NgayTruc, CanBo_ID, LichTruc_ID) 
                values (?, ?, ?)', 
                [$NgayTruc, $value, $LichTruc_ID]);

        }

        $i++;
    }
}


