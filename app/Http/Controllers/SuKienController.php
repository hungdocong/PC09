<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class SuKienController extends Controller
{
    //
    public function frmAdd(Request $request)
    {

        $NoiDung = $request->get("NoiDung");
        $TuNgay  = Carbon::createFromFormat('d/m/Y', $request->get("TuNgay"))->format('Y-m-d');
        $DenNgay = Carbon::createFromFormat('d/m/Y', $request->get("DenNgay"))->format('Y-m-d');

        DB::insert('insert into su_kien
                        (NoiDung, TuNgay, DenNgay)
                        values (?, ?, ?)',
            [$NoiDung, $TuNgay, $DenNgay]);
        Session::flash('message', 'Thêm sự kiện thành công.');
        return redirect('/knht/danh-sach.html');
    }

    public function frmEdit(Request $request)
    {
        $ID      = $request->get("ID");
        $NoiDung = $request->get("NoiDung");
        $TuNgay  = Carbon::createFromFormat('d/m/Y', $request->get("TuNgay"))->format('Y-m-d');
        $DenNgay = Carbon::createFromFormat('d/m/Y', $request->get("DenNgay"))->format('Y-m-d');

        DB::table('su_kien')
            ->where("ID", $ID)
            ->update([
                'NoiDung' => $NoiDung,
                'TuNgay'  => $TuNgay,
                'DenNgay' => $DenNgay,
            ]);

        Session::flash('message', 'Cập nhật thành công.');
        return redirect('/knht/danh-sach.html');
    }
}
