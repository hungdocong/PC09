<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class DoiController extends Controller
{
    //
    public function Index(){
        $query = DB::table('doi')
                        ->get();
        $lanhdao_doi = DB::table('can_bo')
                        ->where('LanhDao', 'Đội')
                        ->get();
        $lstcan_bo = DB::table('can_bo')
                        ->where('LanhDao','!=', 'Phòng')
                        ->get();
        return view('doi.index')->with([
                                            'query'=> $query,
                                            'lanhdao_doi'=> $lanhdao_doi,
                                            'lstcan_bo'=> $lstcan_bo
                                        ]);
    }

    public function Delete($ID){
        DB::table('doi')->where("ID", $ID)->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }


    public function formAdd(Request $request){
        $Ten = $request->get("Ten");
        $SoCB = 0;
        $NhiemVu = $request->get("NhiemVu");
        $Doi_Truong = $request->get("Doi_Truong");
        $Doi_Pho = $request->get("Doi_Pho");

        DB::insert('insert into doi 
            (Ten, SoCB, NhiemVu, Doi_Truong, Doi_Pho) 
            values (?, ?, ?, ?, ?)', 
            [$Ten, $SoCB, $NhiemVu, $Doi_Truong, $Doi_Pho]);

        Session::flash('message', 'Thêm đội thành công.');
        return redirect('/doi/danh-sach.html');
    }

    public function formEdit(Request $request){
        $ID = $request->get("ID");
        $Ten = $request->get("Ten");
        $NhiemVu = $request->get("NhiemVu");
        $Doi_Truong = $request->get("Doi_Truong");
        $Doi_Pho = $request->get("Doi_Pho");

        DB::table('doi')
            ->where("ID", $ID)
            ->update([
                'Ten' => $Ten,
                'NhiemVu' => $NhiemVu,
                'Doi_Truong' => $Doi_Truong,
                'Doi_Pho' => $Doi_Pho
            ]);

        Session::flash('message', 'Cập nhật đội thành công.');
        return redirect('/doi/danh-sach.html');
    }

    public function GetByID($ID){
        $query = DB::table('doi')->where('ID', $ID)->first();

        return response()->json([
            'query' => $query
        ]);
    }
}
