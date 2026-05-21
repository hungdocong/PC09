<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    //
    public function Index()
    {
        $month    = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $Y        = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $lst_year = DB::table('vu_viec')->where('LoaiVuViec_ID', 1)->select('NgayTiepNhan')->get();
        $year     = [];
        $i        = 0;
        foreach ($lst_year as $item) {
            // code...
            $yr = Carbon::createFromFormat('Y-m-d h:m:s', $item->NgayTiepNhan)->format('Y') + 1;
            if (! in_array($yr, $year)) {
                $year[] = $yr;
            }
        }

        //vụ việc hoàn thành trong tháng
        $hoanthanh_vv = DB::table('vu_viec')->whereMonth('NgayKT', $month)->where('TrangThai', 1)->count();

        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        //vụ việc tiếp nhận hôm nay
        $tiepnhan_now = DB::table('vu_viec')->where('NgayTiepNhan', $date)->where('TrangThai', 0)->count();
        // $tiepnhan_now = DB::table('vu_viec')->whereDate('NgayTiepNhan', '>=', '2025-07-01')->where('LoaiVuViec_ID', 1)->count();

        //đã tiếp nhận
        $da_tiep_nhan = DB::table('vu_viec')->whereYear('NgayTiepNhan', $Y)->where('TrangThai', 0)->count();
        // $da_tiep_nhan = DB::table('vu_viec')->whereMonth('NgayTiepNhan', $month)->where('LoaiVuViec_ID', 1)->count();

        //Tổng số vụ
        $tong_vv = DB::table('vu_viec')->whereYear('NgayTiepNhan', $Y)->count();

        // print_r($year);
        return view('home.index')->with([
            'hoanthanh_vv' => $hoanthanh_vv,
            'tiepnhan_now' => $tiepnhan_now,
            'da_tiep_nhan' => $da_tiep_nhan,
            'arryear'      => $year,
            'tong_vv'      => $tong_vv,
        ]);
    }

    public function Charting($Year)
    {
        $month    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $lstTotal = [];
        for ($i = 1; $i <= 12; $i++) {

            $tiepnhan = DB::table('vu_viec')
                ->whereYear('NgayTiepNhan', $Year)
                ->whereMonth('NgayTiepNhan', $i)
                // ->where('LoaiVuViec_ID', 1)
                ->count();
            $ketthuc = DB::table('vu_viec')
                ->whereYear('NgayKT', $Year)
                ->whereMonth('NgayKT', $i)
                // ->where('LoaiVuViec_ID', 1)
                ->count();
            $lstTotal[$i]['TiepNhan'] = $tiepnhan;
            $lstTotal[$i]['KetThuc']  = $ketthuc;
        }

        return response()->json([
            'lstTotal' => $lstTotal,
        ]);
    }

    public function ChartingCategory($Year)
    {
        $lstTotal = [];
        // $donvi    = DB::table('donvi_tc')->get();
        $donvi_tc    = DB::table('vu_viec')->select('DonVi_TC')->distinct()->get();
        $i        = 0;
        foreach ($donvi_tc as $item) {
            $vuviec = DB::table('vu_viec')
                ->whereYear('NgayTiepNhan', $Year)
                ->where('DonVi_TC', $item->DonVi_TC)
                // ->where('DonVi_ID', $item->ID)
                // ->where('LoaiVuViec_ID', 1)
                ->count();
            if ($vuviec >= 3) {
                $lstTotal[$i]['DonVi'] = $item->DonVi_TC;
                $lstTotal[$i]['Total'] = $vuviec;
                $i++;
            } else {
                continue;
            }
        }
        return response()->json([
            'lstTotal' => $lstTotal,
        ]);
    }

    public function Charting_LinhVucGD($Year)
    {
        $lstTotal = [];
        // $donvi    = DB::table('donvi_tc')->get();
        $linhvuc_gd    = DB::table('vu_viec')->select('TenVuViec')->distinct()->get();
        $i        = 0;
        foreach ($linhvuc_gd as $item) {
            $vuviec = DB::table('vu_viec')
                ->whereYear('NgayTiepNhan', $Year)
                ->where('TenVuViec', $item->TenVuViec)
                // ->where('DonVi_ID', $item->ID)
                // ->where('LoaiVuViec_ID', 1)
                ->count();
            if ($vuviec >= 1) {
                $lstTotal[$i]['LinhVuc'] = $item->TenVuViec;
                $lstTotal[$i]['Total'] = $vuviec;
                $i++;
            } else {
                continue;
            }
        }
        return response()->json([
            'lstTotal' => $lstTotal,
        ]);
    }
}
