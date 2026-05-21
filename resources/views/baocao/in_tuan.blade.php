<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>In Báo cáo tuần | PC09</title>
    {{-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css" /> --}}
    <style>
        

        *{
            /*font: normal 16px/1.5em 'times-news-roman', 'Times-news-roman';*/
            font-family: 'times-news-roman';
            font-size: 16px;
        }
        
        .baocao p, .baocao strong{
          line-height: 18px;
          margin: -3px;
          text-indent: 15px;
          text-align: justify;
        }

        
        .wrapper{
          margin-left: 45px;
          margin-right: 30px;
        }

        tr{
            line-height: 15px;
        }
    </style>


  </head>
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info" style="margin-bottom: 60px;">
          <div class="invoice-col" style="text-align:center;float:left; width: 40%;line-height: 15px;">
            CÔNG AN TỈNH KON TUM<br>
            <b>
                PHÒNG KỸ THUẬT HÌNH SỰ
                <hr width="65%" align="center" style="margin-top: 0px; border-top: 0.5px solid black;">
            </b>   
            
          </div><!-- /.col -->
          <div class="invoice-col" style="text-align:center;float:left; width: 60%;line-height: 15px;">
            <b>
                CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập – Tự do – Hạnh phúc
                <hr width="50%" align="center" style="margin-top: 0px; border-top: 0.5px solid black; margin-bottom: 5px;">
            </b>
           @php
              $ngay = \Carbon\Carbon::createFromFormat('d/m/Y',$DenNgay)->format('d');
              $thang = \Carbon\Carbon::createFromFormat('d/m/Y',$DenNgay)->format('m');
              $nam = \Carbon\Carbon::createFromFormat('d/m/Y',$DenNgay)->format('Y');
            @endphp
            <i>Kon Tum, ngày {{ $ngay }} tháng {{ $thang }} năm {{ $nam }}</i>
          </div><!-- /.col -->
         
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-sm-12" style="margin-bottom: 20px">
                <div class="text-center">
                    <div class="col-md-12 control-label" style="font-size:large; text-align:center; ">
                        <p style="font-weight: bold;margin-bottom: -20px;">BÁO CÁO TUẦN</p>
                        <p>(Từ ngày {{ $TuNgay }} đến ngày {{ $DenNgay }})</p>
                        <hr width="20%" align="center" style="margin-top: -15px; border-top: 0.5px solid black;">
                    </div>
                </div>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row baocao">

          <div class="col-sm-10" style="padding-left: 30px">
            <strong>I. TÌNH HÌNH CÔNG TÁC TRONG TUẦN</strong><br>
            <strong>1. Công tác nghiệp vụ chuyên môn</strong><br>
            <strong style="font-style: italic;">1.1. Công tác khám nghiệm hiện trường (KNHT):</strong>
            @if(count($vv_khamnghiem) > 0)
            @foreach($vv_khamnghiem as $item)
                @php
                    $donvi_tc = str_replace("CAH","Công an huyện", str_replace("CATP","Công an thành phố",$item->DonVi_TC));
                @endphp
                <p>- Tiếp nhận vụ {{ $item->TenVuViec }} do Cơ quan CSĐT {{ $donvi_tc }} trưng cầu</p>
            @endforeach
            @else
                <p>Trong tuần đơn vị không tham gia khám nghiệm vụ việc nào.</p>
            @endif

            <strong style="font-style: italic;">1.2. Công tác giám định kỹ thuật hình sự và pháp y:</strong>
            @if(count($vv_giamdinh) > 0)
                <p>Trong tuần đơn vị tiếp nhận giám định {{ $tong_vv }} vụ, {{ $tong_yeucau }} yêu cầu cụ thể:</p>
                <table style="width: 75%;">
                    <tbody>
                        @for($i = 0; $i < count($vv_giamdinh) ; $i++)
                            @php
                                $tenvuviec = str_replace("KTS-ĐT","kỹ thuật số - điện tử", $vv_giamdinh[$i]['TenVuViec']);
                            @endphp
                            <tr>
                              <td>- {{ $tenvuviec }}:</td>
                              <td class="text-right">
                                    {{ $vv_giamdinh[$i]['SoVu'] }} vụ, {{ $vv_giamdinh[$i]['SoYC'] }} yêu cầu.
                              </td>
                            </tr>
                      @endfor
                  </tbody>
              </table>
          @else
                <p>Trong tuần đơn vị không tiếp nhận giám định vụ việc nào.</p>
          @endif
          <strong style="font-style: italic;">1.3. Công tác kỹ thuật phòng chống tội phạm (KTPCTP):</strong><br>
            {!!html_entity_decode($KTPCTP)!!}
          <strong>2. Công tác XDLL</strong><br>
            {!!html_entity_decode($XDLL)!!}
          <strong>II. KẾ HOẠCH CÔNG TÁC TUẦN TỚI</strong><br>
            {!!html_entity_decode($KeHoachCTTuan)!!}
          <p>Trên đây là báo cáo tuần, phòng Kỹ thuật hình sự báo Công an tỉnh (qua PV01) biết, theo dõi./.</p>
      </div><!-- /.col -->
      <div class="col-sm-12" style="margin-top: 25px;">
           <div class="invoice-col" style="float:left; width: 65%; font-size: 14px;line-height: 15px;">
              <strong><i>Nơi nhận:</i> </strong><br>
              - PV01;<br>
              - Lưu: PC09;<br>
          </div><!-- /.col -->
          <div class="invoice-col" style="float: right; width: 35%;margin-left: 150px; text-align:center; ">
              <strong>PHÓ TRƯỞNG PHÒNG</strong><br>
              <i>(Đã ký)</i>   <br><br><br><br>

              <strong>{{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }}</strong><br>
          </div><!-- /.col -->
       </div><!-- /.col --><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
     
    </div><!-- ./wrapper -->
    
   
  </body>
</html>
