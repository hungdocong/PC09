<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class ChamCongController extends Controller
{
    //
    public function Index(){
        $ds_canbo = DB::table('can_bo')
                        ->where('Vang', 0)
                        ->orderBy('HoTen')
                        ->get();
        return view('chamcong.index')->with([
                                            'ds_canbo'=> $ds_canbo
                                        ]);
    }

    public function GetChamCong(){
       
        $lstChamCong = DB::table('cham_cong')
                        ->join('can_bo', 'cham_cong.CanBo_ID', '=', 'can_bo.ID')
                        ->select('cham_cong.ID','cham_cong.TuNgay','cham_cong.DenNgay','cham_cong.TieuDe','cham_cong.CanBo_ID','can_bo.HoTen','cham_cong.NgayCham','cham_cong.NoiDung')
                        ->get();
        return response()->json([
            'lstChamCong' => $lstChamCong
        ]);
    }

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $CanBo_ID = $request->get("CanBo_ID");
        $TieuDe = $request->get("TieuDe");
        $NoiDung = $request->get("NoiDung");
        $TuNgay = Carbon::createFromFormat('d-m-Y', $request->get("TuNgay"))->format('Y-m-d');
        $DenNgay = Carbon::createFromFormat('d-m-Y', $request->get("DenNgay"))->format('Y-m-d');

        DB::table('cham_cong')
            ->where("ID", $ID)
            ->update([
                'CanBo_ID' => $CanBo_ID,
                'TieuDe' => $TieuDe,
                'NoiDung' => $NoiDung,
                'TuNgay' => $TuNgay,
                'DenNgay' => $DenNgay
            ]);
        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/cham-cong/danh-sach.html');
    }

    //Thêm mới cán bộ trực ban
    public function frmAdd(Request $request){

        $CanBo_ID = $request->get("CanBo_ID");
        $TieuDe = $request->get("TieuDe");
        $NoiDung = $request->get("NoiDung");
        $NgayCham = Carbon::now('Asia/Ho_Chi_Minh');
        $TuNgay = Carbon::createFromFormat('d-m-Y', $request->get("TuNgay"))->format('Y-m-d');
        $DenNgay = Carbon::createFromFormat('d-m-Y', $request->get("DenNgay"))->format('Y-m-d');

        DB::insert('insert into cham_cong 
                        (TieuDe, NoiDung, CanBo_ID, NgayCham, TuNgay, DenNgay) 
                        values (?, ?, ?, ?, ?, ?)', 
                        [$TieuDe, $NoiDung, $CanBo_ID, $NgayCham, $TuNgay, $DenNgay]);
        Session::flash('message', 'Thêm chấm công thành công.');
        return redirect('/cham-cong/danh-sach.html');
    }

    public function Delete($ID){
        DB::table('cham_cong')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }
}
