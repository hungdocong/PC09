<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
class CanBoController extends Controller
{
    //
    public function Index(){
        $lanh_dao = DB::table('can_bo')
                        ->where('LanhDao', 'Phòng')
                        ->where('TrangThai', 1)
                        ->get();
        $lstcan_bo = DB::table('can_bo')
                        ->where('LanhDao','!=', 'Phòng')
                        ->where('TrangThai', 1)
                        ->get();
        $doi = DB::table('doi')
                        ->get();
        $trinh_do =  DB::table('trinh_do')
                        ->get();
        return view('canbo.index')->with([
                                            'lanh_dao'=> $lanh_dao,
                                            'lstcan_bo'=> $lstcan_bo,
                                            'doi'=> $doi,
                                            'trinh_do'=> $trinh_do
                                        ]);
    }

    public function Delete($ID){
        DB::table('can_bo')
            ->where("ID", $ID)
            ->update([
                'TrangThai' => 0
            ]);
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function Detail($ID){
        $doi = DB::table('doi')->get();
        $canbo = DB::table('can_bo')->where("ID", $ID)->first();
        $trinh_do = DB::table('trinh_do')->where("CanBo_ID", $ID)->first();
        return view('canbo.detail')->with([
                                            'canbo'=> $canbo,
                                            'trinh_do'=> $trinh_do,
                                            'doi'=> $doi
                                        ]);
    }

    public function Add(){
        $doi = DB::table('doi')->get();
        return view('canbo.add')->with([
                                            'doi'=> $doi
                                        ]);
    }

    public function GetListDoi(){
        $query = DB::table('doi')->get();

        return response()->json([
            'query' => $query
        ]);
    }


    public function frmAdd(Request $request){
        $HoTen = $request->get("HoTen");
        $DanToc = $request->get("DanToc");
        $SoHieu_CAND = $request->get("SoHieu_CAND");
        $GioiTinh = $request->get("GioiTinh");
        $QueQuan = $request->get("QueQuan");
        $NgaySinh = $request->get("NgaySinh");
        $TrinhDo_VH = $request->get("TrinhDo_VH");
        $CapBac = $request->get("CapBac");
        $ChucVu = $request->get("ChucVu");
        $ChucDanh = $request->get("ChucDanh");
        $NgayVao_Dang = $request->get("NgayVao_Dang");
        $ChinhThuc_Dang = $request->get("ChinhThuc_Dang");

        $NgayVao_CA = $request->get("NgayVao_CA");
        $QuyHoach = $request->get("QuyHoach");
        // $CongTac_CAH = $request->get("CongTac_CAH");
        $NgayNhan_CT = $request->get("NgayNhan_CT");
        $GhiChu = $request->get("GhiChu");
        $LanhDao = $request->get("LanhDao");
        $Doi_ID = $request->get("Doi_ID");
        $created_at = Carbon::now('Asia/Ho_Chi_Minh');

        DB::insert('insert into can_bo 
            (HoTen,  DanToc, SoHieu_CAND, GioiTinh, QueQuan, NgaySinh, TrinhDo_VH, CapBac, ChucVu, ChucDanh, QuyHoach, NgayVao_Dang, ChinhThuc_Dang, NgayVao_CA, NgayNhan_CT, GhiChu, LanhDao, Vang, Doi_ID, created_at) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [$HoTen,  $DanToc, $SoHieu_CAND, $GioiTinh, $QueQuan, $NgaySinh, $TrinhDo_VH, $CapBac, $ChucVu, $ChucDanh, $QuyHoach, $NgayVao_Dang, $ChinhThuc_Dang, $NgayVao_CA,  $NgayNhan_CT, $GhiChu, $LanhDao, 0, $Doi_ID, $created_at]);

        $NghiepVu_CA = $request->get("NghiepVu_CA");
        $TN_NganhNgoai = $request->get("TN_NganhNgoai");
        $LyLuan_CT = $request->get("LyLuan_CT");
        $NgoaiNgu = $request->get("NgoaiNgu");
        $TinHoc = $request->get("TinHoc");
        $CanBo_ID = DB::table('can_bo')->max('ID');
        
        $NgayCapNhat = Carbon::now('Asia/Ho_Chi_Minh');
        DB::insert('insert into trinh_do 
            (NghiepVu_CA, TN_NganhNgoai, LyLuan_CT, NgoaiNgu, TinHoc, NgayCapNhat, CanBo_ID) 
            values (?, ?, ?, ?, ?, ?, ?)', 
            [$NghiepVu_CA, $TN_NganhNgoai, $LyLuan_CT, $NgoaiNgu, $TinHoc, $NgayCapNhat, $CanBo_ID]);

        //Cập nhật số cán bộ
        if($Doi_ID != null){
            $canbo = DB::table('doi')->where("ID", $Doi_ID)->first();
            $so_cb = $canbo->SoCB + 1;
            DB::table('doi')
                ->where("ID", $Doi_ID)
                ->update([
                    'SoCB' => $so_cb
                ]);
            if($ChucVu == "Đội Trưởng"){
                DB::table('doi')
                ->where("ID", $Doi_ID)
                ->update([
                    'Doi_Truong' => $CanBo_ID
                ]);
            }
        }

        Session::flash('message', 'Thêm cán bộ thành công.');
        return redirect('/can-bo/danh-sach.html');
    }

    public function Edit($ID){
        $doi = DB::table('doi')->get();
        $canbo = DB::table('can_bo')->where("ID", $ID)->first();
        $trinh_do = DB::table('trinh_do')->where("CanBo_ID", $ID)->first();
        return view('canbo.edit')->with([
                                            'canbo'=> $canbo,
                                            'trinh_do'=> $trinh_do,
                                            'doi'=> $doi
                                        ]);
    }

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $HoTen = $request->get("HoTen");
        $DanToc = $request->get("DanToc");
        $SoHieu_CAND = $request->get("SoHieu_CAND");
        $GioiTinh = $request->get("GioiTinh");
        $QueQuan = $request->get("QueQuan");
        $NgaySinh = $request->get("NgaySinh");
        $TrinhDo_VH = $request->get("TrinhDo_VH");
        $CapBac = $request->get("CapBac");
        $ChucVu = $request->get("ChucVu");
        $ChucDanh = $request->get("ChucDanh");
        $NgayVao_Dang = $request->get("NgayVao_Dang");
        $ChinhThuc_Dang = $request->get("ChinhThuc_Dang");

        $NgayVao_CA = $request->get("NgayVao_CA");
        $QuyHoach = $request->get("QuyHoach");
        // $CongTac_CAH = $request->get("CongTac_CAH");
        $NgayNhan_CT = $request->get("NgayNhan_CT");
        $GhiChu = $request->get("GhiChu");
        $LanhDao = $request->get("LanhDao");
        $Doi_ID = $request->get("Doi_ID");
        $updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $canbo = DB::table('can_bo')->where("ID", $ID)->first();
        if($canbo->Doi_ID != null)
            $canbo_old = DB::table('doi')->where("ID", $canbo->Doi_ID)->first();
        //Cập nhật số cán bộ

        if($Doi_ID != null){ //cán bộ chọn lại đội
            if($LanhDao != "Không"){
               if($ChucVu == "Đội Trưởng"){
                    DB::table('doi')
                    ->where("ID", $Doi_ID)
                    ->update([
                        'Doi_Truong' => $ID
                    ]);
               }else if($ChucVu == "Phó Đội Trưởng"){
                    $canbo_new = DB::table('doi')->where("ID", $Doi_ID)->first();
                    DB::table('doi')
                    ->where("ID", $Doi_ID)
                    ->update([
                        'SoCB' => $canbo_new->SoCB + 1
                    ]);
                    if($canbo_old->SoCB != 0){
                        DB::table('doi')
                        ->where("ID", $canbo->Doi_ID)
                        ->update([
                            'SoCB' => $canbo_old->SoCB - 1
                        ]);
                    }
               }
            }else{
                $canbo_new = DB::table('doi')->where("ID", $Doi_ID)->first();
                DB::table('doi')
                ->where("ID", $Doi_ID)
                ->update([
                    'SoCB' => $canbo_new->SoCB + 1
                ]);

                if($canbo_old->SoCB != 0){
                    DB::table('doi')
                    ->where("ID", $canbo->Doi_ID)
                    ->update([
                        'SoCB' => $canbo_old->SoCB - 1
                    ]);
                }
            }
        }


        DB::table('can_bo')
            ->where("ID", $ID)
            ->update([
                'HoTen' => $HoTen,
                'DanToc' => $DanToc,
                'SoHieu_CAND' => $SoHieu_CAND,
                'GioiTinh' => $GioiTinh,
                'QueQuan' => $QueQuan,
                'NgaySinh' => $NgaySinh,
                'TrinhDo_VH' => $TrinhDo_VH,
                'CapBac' => $CapBac,
                'ChucVu' => $ChucVu,
                'ChucDanh' => $ChucDanh,
                'NgayVao_Dang' => $NgayVao_Dang,
                'ChinhThuc_Dang' => $ChinhThuc_Dang,
                'NgayVao_CA' => $NgayVao_CA,
                // 'CongTac_CAH' => $CongTac_CAH,
                'NgayNhan_CT' => $NgayNhan_CT,
                'GhiChu' => $GhiChu,
                'LanhDao' => $LanhDao,
                'Doi_ID' => $Doi_ID,
                'updated_at' => $updated_at,
                'QuyHoach' => $QuyHoach
            ]);

        $NghiepVu_CA = $request->get("NghiepVu_CA");
        $TN_NganhNgoai = $request->get("TN_NganhNgoai");
        $LyLuan_CT = $request->get("LyLuan_CT");
        $NgoaiNgu = $request->get("NgoaiNgu");
        $TinHoc = $request->get("TinHoc");
        $NgayCapNhat = Carbon::now('Asia/Ho_Chi_Minh');

        DB::table('trinh_do')
            ->where("CanBo_ID", $ID)
            ->update([
                'NghiepVu_CA' => $NghiepVu_CA,
                'TN_NganhNgoai' => $TN_NganhNgoai,
                'LyLuan_CT' => $LyLuan_CT,
                'NgoaiNgu' => $NgoaiNgu,
                'TinHoc' => $TinHoc,
                'NgayCapNhat' => $NgayCapNhat
            ]);

        Session::flash('message', 'Cập nhật cán bộ thành công.');
        return redirect('/can-bo/danh-sach.html');
    }


     public function Upload_Anh(Request $request){
        $CanBo_ID = $request->get("CanBo_ID");
        $avatarPath = null;
        if ($request->hasFile('anh')) {
            $file = $request->file('anh');
            $fileName = '';

            $file_exist = public_path('assets/img/canbo/' . $file->getClientOriginalName());// ktra File đã tồn tại hay chưa
            
            if (File::exists($file_exist)) { //file bị trùng
                $fileName = time() . '_' . $file->getClientOriginalName();
                // Bắt đầu chuyển file vào thư mục
                $file->move(public_path('assets/img/canbo/'), $fileName);
            }else{
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('assets/img/canbo/'), $fileName);
            }

                
                // Bắt đầu chuyển file vào thư mục
                // $avatarPath->move($uploadPath, $avatar->getClientOriginalName());
            // $fileName = time() . '.' . $file->getClientOriginalExtension();
                // $hinhanh = $avatar->getClientOriginalName();

                DB::table('can_bo')
                ->where("ID", $CanBo_ID)
                ->update([
                    'Anh' => $fileName
                ]);

                return response()->json([
                   'status' => true
               ]);
        }else{
            return response()->json([
                 'status' => false
            ]);
        }
        
    }
}
