@extends('layout._layout')

@section('title', 'Báo cáo ngày')

@section('content')

<section class="container baocao invoice" style="padding-left: 240px; padding-top: 20px; padding-bottom: 20px;">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info col-sm-12">
          <div class="col-sm-6 invoice-col" style="text-align:center;float:left; width: 40%;">
            CÔNG AN TỈNH KON TUM<br>
            <b>
                PHÒNG KỸ THUẬT HÌNH SỰ
                <hr width="50%" align="center" style="margin-top: 0px; border-top: 1px solid black;">
            </b>   
            
          </div><!-- /.col -->
          <div class="col-sm-6 invoice-col" style="text-align:center;float:left; width: 60%;">
            <b>
                CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                Độc lập – Tự do – Hạnh phúc
                <hr width="40%" align="center" style="margin-top: 0px; border-top: 1px solid black; margin-bottom: 5px;">
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
                    <p class="col-md-12 control-label" style="font-size:large; text-align:center; font-weight: bold;">
                        BÁO CÁO TUẦN
                        <br>
                        (Từ ngày {{ $TuNgay }} đến ngày {{ $DenNgay }})
                        <hr width="20%" align="center" style="margin-top: 0px; border-top: 1px solid black;">
                    </p>
                </div>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <form action="/bao-cao/tuan-xuatbc" method="post">
                {{ csrf_field() }}
                <div class="col-sm-10" style="padding-left: 135px">
                    <strong>I. TÌNH HÌNH CÔNG TÁC TRONG TUẦN</strong><br>
                    <strong>1. Công tác nghiệp vụ chuyên môn</strong><br>
                    <strong><i>1.1. Công tác khám nghiệm hiện trường(KNHT):</i></strong>
                        @if(count($vv_khamnghiem) > 0)
                            @foreach($vv_khamnghiem as $item)
                            <p>- Tiếp nhận vụ {{ $item->TenVuViec }} do Cơ quan CSĐT {{ $item->DonVi_TC }} trưng cầu</p>
                            @endforeach
                        @else
                            <p>Trong tuần đơn vị không tham gia khám nghiệm vụ việc nào.</p>
                        @endif

                    <strong><i>1.2. Công tác giám định kỹ thuật hình sự và pháp y:</i></strong>
                        @if(count($vv_giamdinh) > 0)
                            <p>Trong tuần đơn vị tiếp nhận giám định vụ {{ $tong_vv }} vụ, {{ $tong_yeucau }} yêu cầu cụ thể:</p>
                            <table style="width: 75%;">
                                <tbody>
                                    @for($i = 0; $i < count($vv_giamdinh) ; $i++)
                                        <tr style="line-height: 25px;">
                                              <td >- {{ $vv_giamdinh[$i]['TenVuViec'] }}:</td>
                                              <td class="text-right">{{ $vv_giamdinh[$i]['SoVu'] }} vụ, {{ $vv_giamdinh[$i]['SoYC'] }} yêu cầu.</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @else
                            <p>Trong tuần đơn vị không tiếp nhận giám định vụ việc nào.</p>
                        @endif
                    <strong><i>1.3. Công tác kỹ thuật phòng chống tội phạm (KTPCTP):</i></strong><br>
                        <textarea name="KTPCTP" id="editor1">
                            <p>Cán bộ, chiến sỹ tham gia ứng trực theo quy định.</p>
                        </textarea>
                    <strong>2. Công tác XDLL</strong><br>
                        <textarea name="XDLL" id="editor2">
                            <p>Cán bộ, chiến sỹ tham gia ứng trực theo quy định.</p>
                        </textarea>
                    <strong>II. KẾ HOẠCH CÔNG TÁC TUẦN TỚI</strong><br>
                        <textarea name="KeHoachCTTuan" id="editor3">
                            <p>- Thực hiện nghiêm túc chế độ trực ban, trực chiến, chủ động về lực lượng và phương tiện sẵn sàng đáp ứng yêu cầu khi có vụ việc xảy ra.</p>
                            <p>- Thực hiện tốt công tác phòng chống dịch Covid-19 theo quy định.</p>
                        </textarea>
                        <br>
                        <p>Trên đây là báo cáo tuần, phòng Kỹ thuật hình sự báo Công an tỉnh (qua PV01) biết, theo dõi./.</p>
                </div><!-- /.col -->
                <div class="col-sm-12" style="padding-left: 120px; margin-top: 25px;">
                    <div class="col-sm-6 invoice-col" style="text-align:left; margin-left: -50px;">
                      <strong><i>Nơi nhận:</i> </strong><br>
                      - PV01;<br>
                      - Lưu: PC09;<br>
                  </div><!-- /.col -->
                  <div class="col-sm-6 invoice-col" style="text-align:center;">
                      <strong>P. TRƯỞNG PHÒNG</strong><br>
                      <p style="padding-left: 140px;">(Đã ký)</p>   <br><br><br><br>

                      <strong style="padding-top: 50px;">{{ $truc_ld->CapBac }} {{ $truc_ld->HoTen }}</strong><br>
                  </div><!-- /.col -->
              </div><!-- /.col -->

              <div class="col-sm-12 text-center" style="margin-top: 50px;">
                  <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> In báo cáo</button>
              </div>
          </form>
          <!-- accepted payments column -->
          
        </div><!-- /.row -->
      </section>

@endsection

@section('jsAdmin')

    <script src="https://cdn.ckeditor.com/4.19.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1', {
            height: 100,
        });
        CKEDITOR.replace('editor2', {
            height: 100,
        });
         CKEDITOR.replace('editor3', {
            height: 100,
        });
    </script>

@endsection


