<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class DonViController extends Controller
{
    //

    public function Index(){
        $lstDonVi = DB::table('donvi_tc')->get();
        $lstVuViec = DB::table('vu_viec')->where('LoaiVuViec_ID', 1)->get();
        return view('donvi.index')->with([
                                            'lstDonVi'=> $lstDonVi,
                                            'lstVuViec'=> $lstVuViec
                                        ]);
    }

    public function frmAdd(Request $request){
        $Ten = $request->get("Ten");
        $GhiChu = $request->get("GhiChu");
        DB::insert('insert into donvi_tc 
            (Ten, GhiChu) 
            values (?, ?)', 
            [$Ten, $GhiChu]);

        Session::flash('message', 'Thêm đơn vị trưng cầu thành công.');
        return redirect('/don-vi/danh-sach.html');
    }

    public function GetByID($ID){
       
        $donvi = DB::table('donvi_tc')
                        ->where('ID', $ID)
                        ->first();
        return response()->json([
            'query' => $donvi
        ]);
    }

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $Ten = $request->get("Ten");
        $GhiChu = $request->get("GhiChu");

        DB::table('donvi_tc')
        ->where("ID", $ID)
        ->update([
            'Ten' => $Ten,
            'GhiChu' => $GhiChu,
        ]);


       Session::flash('message', 'Thêm đơn vị trưng cầu thành công.');
       return redirect('/don-vi/danh-sach.html');
   }

   public function ChangeStatus($ID, $Status){
        DB::table('donvi_tc')
        ->where("ID", $ID)
        ->update([
                'TrangThai' => $Status
            ]);
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function Delete($ID){
        DB::table('donvi_tc')
        ->where("ID", $ID)
        ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }
}
