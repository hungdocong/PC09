<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>In Báo cáo ngày</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css" />
    <style>
        *{
            font-family: "Times New Roman", Times, serif;
            font-size: 14px;
        }

        .row p, .row strong{
            font-size: 18px;
        }
    </style>

  </head>
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="baocao invoice">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info col-sm-12">
          <div class="invoice-col" style="text-align:center;float:left; width: 45%;">
            CÔNG AN TỈNH KON TUM<br>
            <b>
                PHÒNG KỸ THUẬT HÌNH SỰ
                <hr width="50%" align="center" style="margin-top: 0px; border-top: 1px solid black;">
            </b>   
            
          </div><!-- /.col -->
          <div class="invoice-col" style="text-align:center;float:left; width: 55%;">
            <b>
                CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập – Tự do – Hạnh phúc
                <hr width="50%" align="center" style="margin-top: 0px; border-top: 1px solid black; margin-bottom: 5px;">
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
          <div class="col-sm-12" style="margin-top: 25px">
                <div class="text-center">
                    <p class="col-md-12 control-label" style="font-size:large; text-align:center; font-weight: bold; margin: 0px;">
                        BÁO CÁO NGÀY
                        <br>
                        (Từ 13 giờ ngày {{ $TuNgay }} đến 13 giờ ngày {{ $DenNgay }})
                        <hr width="20%" align="center" style="margin-top: 0px; border-top: 1px solid black;">
                    </p>
                </div>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
         

          <div class="col-sm-10" style="padding-left: 40px">
            <strong>1. Quân số đơn vị</strong>
            <p>- Tổng số: {{ $quanso }} đ/c</p>
            <p>- Có mặt: {{ $co_mat }} đ/c</p>
            <p>- Vắng: {{ $vang }} đ/c (Có lý do)</p>
            <p>- Trực lãnh đạo: Đ/c {{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }} - {{ $truc_ld->ChucVu }}</p>
            <p>- Trực KNHT: Đ/c {{ $truckn[0] }} - {{ $truckn[1] }}</p>
            <p>- Trực ban: Đ/c {{ $truc_ban->HoTen }}</p>

            <strong>2. Tình hình công tác trong ngày</strong><br>
            <strong>2.1 Công tác KNHT</strong>
            @if(count($vv_khamnghiem) > 0)
              @foreach($vv_khamnghiem as $item)
                <p>- Tiếp nhận vụ {{ $item->TenVuViec }} do Cơ quan CSĐT {{ $item->DonVi_TC }} trưng cầu</p>
              @endforeach
            @else
                <p>Trong ngày đơn vị không tham gia khám nghiệm vụ việc nào.</p>
            @endif
            <strong>2.2 Công tác giám định</strong>
            @if(count($vv_giamdinh) > 0)
                @foreach($vv_giamdinh as $item)
                    <p>- Tiếp nhận vụ {{ $item->TenVuViec }} do Cơ quan CSĐT {{ $item->DonVi_TC }} trưng cầu</p>
                @endforeach
            @else
                <p>Trong ngày đơn vị không tiếp nhận giám định vụ việc nào.</p>
            @endif
            <strong>2.3 Công tác kỹ thuật phòng chống tội phạm</strong>
                {!!html_entity_decode($KTPCTP)!!}
            <strong>2.4 Công tác khác</strong>
              {!!html_entity_decode($CTK)!!}
          </div>
          <div class="col-sm-12" style="margin-top: 25px">
            <div class="invoice-col" style="text-align:left; width: 60%; ">
                  <strong><i>Nơi nhận:</i> </strong><br>
                  - Phòng PV01;<br>
                  - Lưu: PC09;<br>
              </div><!-- /.col -->
              <div class="invoice-col" style="text-align:center; width: 40%;">
                  <strong>P. TRƯỞNG PHÒNG</strong><br>
                  <p style="padding-left: 15px;">(Đã ký)</p>   <br><br><br><br>


                  <strong style="padding-top: 50px;">{{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }}</strong><br>
              </div><!-- /.col -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
     
    </div><!-- ./wrapper -->
    
    <!-- AdminLTE App -->
    <!-- <script src="../../dist/js/app.min.js" type="text/javascript"></script> -->
  </body>
</html>
