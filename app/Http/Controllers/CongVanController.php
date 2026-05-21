<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use File;
use ZipArchive;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CongVanController extends Controller
{
    //
    public function Index($nam){

        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        
        $lstCongVan = DB::table('cong_van')
                        // ->where('Nam', $nam)
                        ->orderBy('NgayTiepNhan', 'desc')
                        ->get();
        $view_year = $nam;
        
        $lstLoaiCV = DB::table('loai_cv')->get();
        

        $arr_year = [];
        for ($i=0; $i <= 5; $i++) { 
            // code...
            $arr_year[$i] = $year - $i;
        }
        return view('congvan.index')->with([
                                            'lstCongVan'=> $lstCongVan,
                                            'lstLoaiCV'=> $lstLoaiCV,
                                            'view_year'=> $view_year,
                                            'arr_year'=> $arr_year
                                        ]);
    }

    public function GetByID($ID){
        $congvan = DB::table('cong_van')->where('ID', $ID)->first();

        $query = new \stdClass;
        $query->ID = $congvan->ID;
        $query->SoCV = $congvan->SoCV;
        $query->LoaiCV_ID = $congvan->LoaiCV_ID;
        $query->ToSo = $congvan->ToSo;
        $query->NgayGui = Carbon::createFromFormat('d/m/Y', $congvan->NgayGui)->format('Y-m-d'); 
        $query->NoiDung = $congvan->NoiDung;
        $query->GhiChu = $congvan->GhiChu;
        
        return response()->json([
            'query' => $query
        ]);
    }

    public function Delete($ID){
        DB::table('cong_van')->where("ID", $ID)->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function frmEdit(Request $request){
        $ID = $request->get("ID");
        $SoCV = $request->get("SoCV");
        $ToSo = $request->get("ToSo");
        $NgayGui = Carbon::createFromFormat('Y-m-d', $request->get("NgayGui"))->format('d/m/Y'); ;
        $NoiDung = $request->get("NoiDung");
        // $NgayTiepNhan = Carbon::now('Asia/Ho_Chi_Minh');
        $GhiChu = $request->get("GhiChu");
        $LoaiCV_ID = $request->get("LoaiCV_ID");

        DB::table('cong_van')
            ->where("ID", $ID)
            ->update([
                'SoCV' => $SoCV,
                'ToSo' => $ToSo,
                'NgayGui' => $NgayGui,
                'NoiDung' => $NoiDung,
                // 'NgayTiepNhan' => $NgayTiepNhan,
                'GhiChu' => $GhiChu,
                'LoaiCV_ID' => $LoaiCV_ID
            ]);

        Session::flash('message', 'Cập nhật công văn thành công.');
        return redirect('/cong-van/danh-sach.html');
    }

    public function Add(){
        $lstLoaiCV = DB::table('loai_cv')->get();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->format('Y');

        $arr_year = [];
        for ($i=0; $i <= 5; $i++) { 
            // code...
            $arr_year[$i] = $year - $i;
        }

        return view('congvan.add')->with([
                                            'lstLoaiCV'=> $lstLoaiCV,
                                            'arr_year'=> $arr_year,
                                        ]);
    }

    public function frmAdd(Request $request){
        $SoCV = $request->get("SoCV");
        $NoiGui = $request->get("NoiGui");
        $Nam = $request->get("Nam");
        $NgayGui = $request->get("NgayGui");
        $NoiDung = $request->get("NoiDung");
        $NgayTiepNhan = Carbon::now('Asia/Ho_Chi_Minh');
        $GhiChu = $request->get("GhiChu");
        $LoaiCV_ID = $request->get("LoaiCV_ID");

        DB::insert('insert into cong_van 
            (SoCV, NoiGui, NgayGui, NoiDung, NgayTiepNhan, GhiChu, LoaiCV_ID, Nam) 
            values (?, ?, ?, ?, ?, ?, ?, ?)', 
            [$SoCV, $NoiGui, $NgayGui, $NoiDung, $NgayTiepNhan, $GhiChu, $LoaiCV_ID, $Nam]);
        Session::flash('message', 'Thêm công văn thành công. Bạn vui lòng xem công văn trong danh sách');
        return redirect('/cong-van/them-moi.html');
    }

    public function Import(Request $request){
        $LoaiCV_ID = $request->get("LoaiCV_ID");
        $Nam = $request->get("Nam");
        // require_once 'bootstrap.php';
        if ($request->hasFile('File')){
            $file = $request->file("File");

            // Thư mục upload $file_title = );
            $file_name  = Str_Metatitle($file->getClientOriginalName());
            $path = public_path('/assets/file/');

            // Bắt đầu chuyển file vào thư mục
            $file->move($path, $file_name);

            $filepath = public_path('/assets/file/'. $file_name);
            $reader = ReaderEntityFactory::createReaderFromFile($filepath);
            $reader->open($filepath);
            $congvan = [];
            $dem = 0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                   
                    $cells = $row->getCells();

                    $STT = $cells[0]; 

                    if (!is_numeric($STT->getValue())){
                        continue;
                    }

                    $KHVB = $cells[1]; 
                    $NgayThang = $cells[2]; 
                    $VB = $cells[3]; 
                    $ToSo = $cells[4]; 
                    
                    $ngaythang = '';
                    if(is_string($NgayThang->getValue()))
                        $ngaythang = $NgayThang->getValue();
                    else{
                        $ngaythang = Carbon::parse($NgayThang->getValue())->format('d/m/Y');
                    }

                    $toso = '';
                    if(is_string($ToSo->getValue()))
                        $toso = $ToSo->getValue();
                    else if(is_numeric($ToSo->getValue()))
                        $toso = $ToSo->getValue();
                    else{
                        $toso = $ToSo->getValue()->format('d-m');
                    }
                    
                    $congvan[$dem] = [
                            "STT" => $STT->getValue(),
                            "KHVB" => $KHVB->getValue(),
                            "NgayThang" => $ngaythang,
                            "VB" => $VB->getValue(),
                            "ToSo" => $toso
                        ];
                    
                    $dem++;
                }
            }
            Session::put('congvan', $congvan);
            $loai_cv = DB::table('loai_cv')->where('ID', $LoaiCV_ID)->first();
            $arr = array('LoaiCV_ID' => $LoaiCV_ID, 'Nam' => $Nam, 'TenLoai' => $loai_cv->TenLoai);

            Session::put('loaicv', $arr);
            $reader->close();
            // Session::flash('message', 'Nhập công văn thành công.');
            return redirect('/cong-van/them-moi.html');
            
        }

    }

    public function frmImport(Request $request){
        $LoaiCV_ID = $request->get("LoaiCV_ID");
        $Nam = $request->get("Nam");
        $NgayTiepNhan = Carbon::now('Asia/Ho_Chi_Minh');
        foreach (Session::get('congvan') as $key=>$value){

            $SoCV = $value['KHVB'];
            $NgayGui = $value['NgayThang'];
            $NoiDung = $value['VB'];
            $ToSo = $value['ToSo'];

            DB::insert('insert into cong_van 
            (SoCV, ToSo, NgayGui, NoiDung, NgayTiepNhan, Nam, LoaiCV_ID) 
            values (?, ?, ?, ?, ?, ?, ?)', 
            [$SoCV, $ToSo, $NgayGui, $NoiDung, $NgayTiepNhan, $Nam, $LoaiCV_ID]);

        }

        Session::forget('congvan');
        Session::flash('message', 'Nhập công văn thành công.');
        return redirect('/cong-van/them-moi.html');
    }

    public function List(){
        $query = DB::table('loai_cv')
                        ->orderBy('ID', 'desc')
                        ->paginate(10);
        $count_cv = [];
        $lstLoaiCV = DB::table('loai_cv')->get();

        $i = 0;
        foreach ($lstLoaiCV as $item) {
            $count_cv[$i]['Count'] = DB::table('cong_van')->where('LoaiCV_ID', $item->ID)->count();
            $count_cv[$i]['LoaiCV_ID'] = $item->ID;
            $i++;
        }
        return view('congvan.loaicv')->with([
                                            'query'=> $query,
                                            'count_cv'=> $count_cv
                                        ]);
    }


    public function Delete_LoaiCV($ID){
        DB::table('cong_van')->where('LoaiCV_ID', $ID)->delete();
        DB::table('loai_cv')->where("ID", $ID)->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function AddLoai_cv(Request $request){
        $TenLoai = $request->get("TenLoai");
        $GhiChu = $request->get("GhiChu");
        DB::insert('insert into loai_cv 
            (TenLoai, GhiChu) 
            values (?, ?)', 
            [$TenLoai, $GhiChu]);

        Session::flash('message', 'Thêm loại công văn thành công.');
        return redirect('/cong-van/loai-cong-van.html');
    }

    public function EditLoai_cv(Request $request){
        $ID = $request->get("ID");
        $GhiChu = $request->get("GhiChu");
        $TenLoai = $request->get("TenLoai");

        DB::update('update loai_cv set TenLoai = ?, GhiChu = ? where ID = ?', 
                [$TenLoai, $GhiChu, $ID]);

        Session::flash('message', 'Cập nhật loại công văn thành công.');
        return redirect('/cong-van/loai-cong-van.html');
    }

    public function GetLoai_CVByID($ID){
        $loai_cv = DB::table('loai_cv')->where('ID', $ID)->first();

        return response()->json([
            'query' => $loai_cv
        ]);
    }

    public function Test(){
         $filepath = public_path('/assets/file/baocaocongtackthscah.xlsx');

            $reader = ReaderEntityFactory::createReaderFromFile($filepath);

            $reader->open($filepath);

            $i = 0;
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
        // do stuff with the row
                    if ($i == 0 || $i == 1){
                        $i++;
                        continue;
                    }

                    $cells = $row->getCells();
                    $STT = $cells[0]; 
                    $KHVB = $cells[1]; 
                    $NgayThang = $cells[2]; 
                    $VB = $cells[3]; 
                    $ToSo = $cells[4]; 

                    $ngaythang = Carbon::parse($NgayThang->getValue())->format('d/m/Y');
                    echo "STT: " . $STT->getValue() . "             ";
                    echo "Số, ký hiệu VB: " . $KHVB->getValue() . "             ";
                    echo "Ngày, tháng VB: " . $ngaythang . "            ";
                    echo "Trích yếu VB: " . $VB->getValue() . "             ";
                    echo "Tờ số: " . $ToSo->getValue() . "         <br>";
                    
                }
            }

            $reader->close();

    }
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
        $str = preg_replace("/(Đ)/", 'd', $str);
        $str = preg_replace("/(' ')/", '-', $str);
        $str = str_replace(" ","",trim($str));
        $str = strtolower($str);
        return $str;
    }

// function getTextFromTextRun($element) {
//     for ($index = 0; $index < $element->countElements(); $index++) {
//         $textRunElement = $element->getElement($index);

//         switch (get_class($textRunElement)) {
//             case 'PhpOffice\PhpWord\Element\Text':
//             case 'PhpOffice\PhpWord\Element\TextRun':
//                 $text = $textRunElement->getText();
//                 if (strlen($text) > 0) {
//                     $this->logger->debug("Text: " . $text);
//                     $this->getFont($textRunElement);
//                 }
//                 break;

//             case 'PhpOffice\PhpWord\Element\TextBreak':
//                 break;

//             default:
//                 break;
//         }
//     }
// }

// function iterateOverRows($table) {
//     $rows = $table->getRows();
//     foreach ($rows as $row) {
//         foreach ($row->getCells() as $cell) {
//             $els = $cell->getElements();
//             foreach ($els as $e) {
//                 $this->switchElements($e);
//             }
//         }
//     }
// }


// function switchElements($element) {
//     switch (get_class($element)) {
//         case 'PhpOffice\PhpWord\Element\TextRun':
//             $this->getTextFromTextRun($element);
//             break;

//         case 'PhpOffice\PhpWord\Element\Table':
//             $this->iterateOverRows($element);
//             break;

//         default:
//             break;
//     }
// }
