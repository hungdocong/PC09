<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Báo cáo ngày</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
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
    </style>


  </head>
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info" style="margin-bottom: 20px;">
          <div class="invoice-col" style="text-align:center;float:left; width: 40%;line-height: 15px;">
            CÔNG AN TỈNH KON TUM<br>
            <b>
                PHÒNG KỸ THUẬT HÌNH SỰ
                <hr width="55%" align="center" style="margin-top: 0px; border-top: 0.5px solid black;">
            </b>   
            
          </div><!-- /.col -->
          <div class="invoice-col" style="text-align:center;float:left; width: 60%;line-height: 15px;">
            <b>
                CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập – Tự do – Hạnh phúc
                <hr width="40%" align="center" style="margin-top: 0px; border-top: 0.5px solid black; margin-bottom: 5px;">
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
        <div class="row" style="padding-top: 60px">
          <div class="col-sm-12">
                <div class="text-center">
                    <p class="col-md-12 control-label" style="font-size:large; text-align:center; font-weight: bold;line-height: 20px;">
                        BÁO CÁO NGÀY
                        <br>
                        (Từ 13 giờ ngày {{ $TuNgay }} đến 13 giờ ngày {{ $DenNgay }})
                        <hr width="20%" align="center" style="margin-top: -15px; border-top: 0.5px solid black;">
                    </p>
                </div>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row baocao">
          <!-- accepted payments column -->
          <div class="col-sm-10" style="padding-left: 40px">
            <strong>1. Quân số</strong>
            <p>- Tổng số: {{ $quanso }} đ/c</p>
            <p>- Có mặt: {{ $co_mat }} đ/c</p>

            @if($vang != 0)
              <p>- Vắng: {{ $vang }} đ/c (Có lý do)</p>
            @endif
            
            <p>- Trực lãnh đạo: Đ/c {{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }} - {{ $truc_ld->ChucVu }}</p>
            <p>- Trực KNHT: Đ/c {{ $truckn[0] }} - {{ $truckn[1] }}</p>
            <p>- Trực ban: Đ/c {{ $truc_ban->HoTen }}</p>

            <strong>2. Tình hình công tác trong ngày</strong><br>
            <strong>2.1 Công tác KNHT</strong>
            @if(count($vv_khamnghiem) > 0)
              @foreach($vv_khamnghiem as $item)
                @php
                  $donvi_tc = str_replace("CAH","Công an huyện", str_replace("CATP","Công an thành phố",$item->DonVi_TC));
                @endphp
                <p>- Tiếp nhận vụ {{ $item->TenVuViec }} do Cơ quan CSĐT {{ $donvi_tc }} trưng cầu</p>
              @endforeach
            @else
                <p>Trong ngày đơn vị không tham gia khám nghiệm vụ việc nào.</p>
            @endif
            <strong>2.2 Công tác giám định</strong>
            @if(count($vv_giamdinh) > 0)
                @foreach($vv_giamdinh as $item)
                    @php
                      $tenvuviec = str_replace("GĐ","giám định",$item->TenVuViec);
                      $donvi_tc = str_replace("CAH","Công an huyện", str_replace("CATP","Công an thành phố",$item->DonVi_TC));
                    @endphp
                    <p>- Tiếp nhận vụ {{ $tenvuviec }} do Cơ quan CSĐT {{ $donvi_tc }} trưng cầu</p>
                @endforeach
            @else
                <p>Trong ngày đơn vị không tiếp nhận giám định vụ việc nào.</p>
            @endif
            <strong>2.3 Công tác kỹ thuật phòng chống tội phạm</strong>
                {!!html_entity_decode($KTPCTP)!!}
            <strong>2.4 Công tác khác</strong>
              {!!html_entity_decode($CTK)!!}

          </div><!-- /.col -->
          <div style="margin-top: 25px;">
            <div class="invoice-col" style="float:left; width: 65%; font-size: 14px;line-height: 15px;">
              <strong><i>Nơi nhận:</i> </strong><br>
              - Phòng PV01;<br>
              - Lưu: PC09;<br>
            </div><!-- /.col -->
            <div class="invoice-col" style="float: right; width: 35%;margin-left: 150px; text-align:center; ">
              <strong>PHÓ TRƯỞNG PHÒNG</strong><br>
              <i>(Đã ký)</i>   <br><br><br><br>


              <strong>{{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }}</strong><br>
            </div><!-- /.col -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
     
    </div><!-- ./wrapper -->
    
    <!-- AdminLTE App -->
    <!-- <script src="../../dist/js/app.min.js" type="text/javascript"></script> -->
  </body>
</html>
