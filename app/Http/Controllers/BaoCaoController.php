<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Session;
use Carbon\Carbon;
class BaoCaoController extends Controller
{
    //
    public function Ngay(Request $request){

            $TuNgay = Carbon::parse($request->get("Ngay"))->addDays(-1)->format('Y-m-d');
            $DenNgay = Carbon::parse($request->get("Ngay"))->addDays(0)->format('Y-m-d');
            $quanso = DB::table('can_bo')
                        ->where('Status', 1)
                        ->count();
            $co_mat = DB::table('can_bo')
                        ->where('Vang', 0)
                        ->where('Status', 1)
                        ->count();
            $vang = DB::table('can_bo')
                        ->where('Vang', 1)
                        ->where('Status', 1)
                        ->count();
            $truc_ld = DB::table('lich_truc')
                        ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', "Trực ban")
                        ->whereDate('lich_truc.TuNgay', '<=', $TuNgay)
                        ->whereDate('lich_truc.DenNgay', '>=', $DenNgay)
                        ->select('can_bo.HoTen','can_bo.CapBac','can_bo.ChucVu', 'lich_truc.TuNgay', 'lich_truc.DenNgay')
                        ->first();

            $truc_kn = DB::table('ct_lichtruc')
                        ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', "Trực khám nghiệm")
                        ->where('ct_lichtruc.NgayTruc', $DenNgay)
                        ->select('can_bo.ID','can_bo.HoTen')
                        ->get();
            $truc_ban = DB::table('ct_lichtruc')
                        ->join('lich_truc', 'ct_lichtruc.LichTruc_ID', '=', 'lich_truc.ID')
                        ->join('can_bo', 'ct_lichtruc.CanBo_ID', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', "Trực ban")
                        ->where('ct_lichtruc.NgayTruc', $DenNgay)
                        ->select('can_bo.ID','can_bo.HoTen')
                        ->first();
            // echo "Từ ngày:  " . $TuNgay . '<br>';
            // echo "Đến ngày:  " . $DenNgay . '<br>';
            // var_dump($truc_ld);
            $truckn = [];
            $i = 0;
            foreach ($truc_kn as $item) {
                // code...
                $arr = explode(' ', $item->HoTen);
                $truckn[$i] = $arr[count($arr)- 1];
                // echo "Tên:  " . $trucban[$i];
                $i++;
            }

            // var_dump($truckn);

            $vv_khamnghiem = DB::table('vu_viec')
                        ->where('NgayTiepNhan', $DenNgay)
                        ->where('SoCV', null)
                        ->select('ID','TenVuViec','NgayTiepNhan','DonVi_TC')
                        ->get();
            $vv_giamdinh = DB::table('vu_viec')
                        ->where('NgayTiepNhan', $DenNgay)
                        ->where('SoCV', '!=', null)
                        ->select('ID','TenVuViec','NgayTiepNhan','DonVi_TC', 'CanBo_ID', 'LoaiVuViec_ID', 'SoCV')
                        ->get();
            $baocao_ngay = new \stdClass;
            $baocao_ngay->TuNgay = $TuNgay;
            $baocao_ngay->DenNgay = $DenNgay;
            $baocao_ngay->quanso = $quanso;
            $baocao_ngay->co_mat = $co_mat;
            $baocao_ngay->vang = $vang;
            $baocao_ngay->truc_ld = $truc_ld;
            $baocao_ngay->truckn = $truckn;
            $baocao_ngay->truc_ban = $truc_ban;
            $baocao_ngay->vv_khamnghiem = $vv_khamnghiem;
            $baocao_ngay->vv_giamdinh = $vv_giamdinh;

            Session::put('baocao_ngay', $baocao_ngay);

            return view('baocao.ngay')->with([
                                            'TuNgay'=> Carbon::createFromFormat('Y-m-d', $TuNgay)->format('d/m/Y'),
                                            'DenNgay'=> Carbon::createFromFormat('Y-m-d', $DenNgay)->format('d/m/Y'),
                                            'quanso'=> $quanso,
                                            'co_mat'=> $co_mat,
                                            'vang'=> $vang,
                                            'truc_ld'=> $truc_ld,
                                            'truckn'=> $truckn,
                                            'truc_ban'=> $truc_ban,
                                            'vv_khamnghiem'=> $vv_khamnghiem,
                                            'vv_giamdinh'=> $vv_giamdinh
                                        ]);

        
        
    }

    //In báo cáo ngày
     public function frmBaoCao_Ngay(Request $request){

        $KTPCTP = $request->get("KTPCTP");
        $CTK = $request->get("CTK");

        $baocao = Session::get('baocao_ngay');

        $data = [
            'TuNgay'=> Carbon::createFromFormat('Y-m-d', $baocao->TuNgay)->format('d/m/Y'),
            'DenNgay'=> Carbon::createFromFormat('Y-m-d',$baocao->DenNgay)->format('d/m/Y'),
            'quanso'=> $baocao->quanso,
            'co_mat'=> $baocao->co_mat,
            'vang'=> $baocao->vang,
            'truc_ld'=> $baocao->truc_ld,
            'truckn'=> $baocao->truckn,
            'truc_ban'=> $baocao->truc_ban,
            'KTPCTP'=> $KTPCTP,
            'CTK'=> $CTK,
            'vv_khamnghiem'=> $baocao->vv_khamnghiem,
            'vv_giamdinh'=> $baocao->vv_giamdinh
        ];
        $pdf = PDF::loadView('baocao.in_ngay', $data);

        $file = 'bao-cao-ngay-' . Carbon::createFromFormat('Y-m-d',$baocao->DenNgay)->format('d-m-Y') . '.pdf';
        return $pdf->stream($file);
        // return view('pdf');
    }



    public function Tuan(Request $request){
        
            $TuNgay = Carbon::parse($request->get("Date"))->addDays(-6)->format('Y-m-d');
            $DenNgay = Carbon::parse($request->get("Date"))->addDays(0)->format('Y-m-d');
            
            $truc_ld = DB::table('lich_truc')
                        ->join('can_bo', 'lich_truc.Truc_LD', '=', 'can_bo.ID')
                        ->where('lich_truc.LoaiTruc', "Trực ban")
                        ->whereDate('lich_truc.TuNgay', '<=', $DenNgay)
                        ->whereDate('lich_truc.DenNgay', '>=', $DenNgay)
                        ->select('can_bo.HoTen','can_bo.CapBac','can_bo.ChucVu', 'lich_truc.TuNgay', 'lich_truc.DenNgay')
                        ->first();

            $vv_khamnghiem = DB::table('vu_viec')
                        ->where('NgayTiepNhan', '>=', $TuNgay)
                        ->where('NgayTiepNhan', '<=', $DenNgay)
                        ->where('SoCV', null)
                        ->select('ID','TenVuViec','NgayTiepNhan','DonVi_TC')
                        ->get();
            $giamdinh = DB::table('vu_viec')
                        ->whereDate('NgayTiepNhan', '>=', $TuNgay)
                        ->whereDate('NgayTiepNhan', '<=', $DenNgay)
                        ->where('SoCV', '!=', null)
                        ->select('ID','NgayTiepNhan','SoYC', 'LoaiVuViec_ID')
                        ->get();
            $loai_vv = DB::table('loai_vuviec')->get();            
            $vv_giamdinh = [];            
            $i = 0;
            $tong_vv = 0;
            $tong_yeucau = 0;
            foreach ($loai_vv as $item) {
                // code...
                $dem = 0;
                $so_yc = 0;
                foreach ($giamdinh as $jtem) {
                    // code...
                    if($jtem->LoaiVuViec_ID == $item->ID){
                        $dem++;
                        $so_yc += $jtem->SoYC;
                    }

                }

                if($dem!=0){
                    $vv_giamdinh[$i]['TenVuViec'] = str_replace("GĐ","Giám định",$item->Ten);

                    if($dem < 10){
                        $dem = '0' . $dem;
                    }

                    $vv_giamdinh[$i]['SoVu'] = $dem;
                    $vv_giamdinh[$i]['SoYC'] = $so_yc;
                    $i++;
                    $tong_vv++;
                    $tong_yeucau += $so_yc;
                }
            }

            if($tong_vv < 10){
                $tong_vv = '0' . $tong_vv; 
            }

            $baocao_tuan = new \stdClass;
            $baocao_tuan->TuNgay = $TuNgay;
            $baocao_tuan->DenNgay = $DenNgay;
            $baocao_tuan->truc_ld = $truc_ld;
            $baocao_tuan->vv_khamnghiem = $vv_khamnghiem;
            $baocao_tuan->vv_giamdinh = $vv_giamdinh;
            $baocao_tuan->tong_yeucau = $tong_yeucau;
            $baocao_tuan->tong_vv = $tong_vv;

            Session::put('baocao_tuan', $baocao_tuan);

            // print_r($truc_ld);

            return view('baocao.tuan')->with([
                                            'TuNgay'=> Carbon::createFromFormat('Y-m-d', $TuNgay)->format('d/m/Y'),
                                            'DenNgay'=> Carbon::createFromFormat('Y-m-d', $DenNgay)->format('d/m/Y'),
                                            'truc_ld'=> $truc_ld,
                                            'tong_vv'=> $tong_vv,
                                            'tong_yeucau'=> $tong_yeucau,
                                            'vv_khamnghiem'=> $vv_khamnghiem,
                                            'vv_giamdinh'=> $vv_giamdinh
                                        ]);

        
        
    }

    //In báo cáo ngày
    public function frmBaoCao_Tuan(Request $request){

        $KTPCTP = $request->get("KTPCTP");
        $XDLL = $request->get("XDLL");
        $KeHoachCTTuan = $request->get("KeHoachCTTuan");

        $baocao = Session::get('baocao_tuan');

        $data = [
            'TuNgay'=> Carbon::createFromFormat('Y-m-d', $baocao->TuNgay)->format('d/m/Y'),
            'DenNgay'=> Carbon::createFromFormat('Y-m-d',$baocao->DenNgay)->format('d/m/Y'),
            'truc_ld'=> $baocao->truc_ld,
            'tong_yeucau'=> $baocao->tong_yeucau,
            'tong_vv'=> $baocao->tong_vv,
            'KeHoachCTTuan'=> $KeHoachCTTuan,
            'KTPCTP'=> $KTPCTP,
            'XDLL'=> $XDLL,
            'vv_khamnghiem'=> $baocao->vv_khamnghiem,
            'vv_giamdinh'=> $baocao->vv_giamdinh
        ];
        $pdf = PDF::loadView('baocao.in_tuan', $data);
        $file = 'bao-cao-tuan-tu-' 
                    . Carbon::createFromFormat('Y-m-d',$baocao->TuNgay)->format('d-m-Y')  . '-den-ngay-'
                    . Carbon::createFromFormat('Y-m-d',$baocao->DenNgay)->format('d-m-Y')  . '.pdf';
                   
        return $pdf->stream($file);

    }


}
