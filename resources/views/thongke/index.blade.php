@extends('layout._layout')

@section('title', 'Thống kê giám định')

@section('content')
@php 
    $year =  Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y'); 
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thống kê vụ việc giám định
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-search"></i>Thống kê vụ việc</a></li>
			<li class="active">Danh sách vụ việc</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Thống kê vụ việc</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/thong-ke/tim-kiem.html"  method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="box-body">
                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">Lĩnh vực:</label>
                            <select name="Linh_Vuc" class="form-control">
                                <option value="">---Chọn lĩnh vực---</option>
                                @foreach($lstLinhVuc as $item)
                                    @if(!empty($Linh_Vuc) && $Linh_Vuc == $item->ID)
                                        @php $Ten_LV = $item->Ten @endphp
                                        <option value="{{ $item->ID }}" selected>{{ $item->Ten }}</option>
                                    @else
                                        <option value="{{ $item->ID }}">{{ $item->Ten }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="recipient-name" class="col-form-label">Đơn vị trưng cầu:</label>
                            <input type="text" name="DonVi" value="{{ !empty($Donvi) ? $Donvi : ""  }}" class="form-control" list="DV_ID" placeholder="Chọn Đơn vị trưng cầu..."/>
                            <datalist id="DV_ID" >
                                @foreach($lstDonVi as $item)
                                    <option value="{{ $item->DonVi_TC }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Cán bộ phụ trách</label>
                            <select name="phu_trach[]" class="form-control select2" multiple="multiple" placeholder="Chọn cán bộ phụ trách...">
                                @foreach($ds_canbo as $item)
                                    @if(!empty($phutrach) && in_array($item->ID, $phutrach))
                                        <option value="{{ $item->ID }}" selected>{{ $item->HoTen }}</option>
                                    @else
                                        <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mốc thời gian (tiếp nhận)</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                @php
                                    $moc_tg = ''; $tu_ngay = ''; $den_ngay = '';

                                    if(!empty($TuNgay) && $TuNgay != "" || !empty($DenNgay) && $DenNgay != ""){
                                        $moc_tg .= \Carbon\Carbon::parse($TuNgay)->format('d/m/Y') .' - '. \Carbon\Carbon::parse($DenNgay)->format('d/m/Y');
                                        $tu_ngay .= $TuNgay; $den_ngay .= $DenNgay;
                                    }
                                @endphp
                                <input type="text" class="form-control pull-right" id="moc_thoigian" value="{{ $moc_tg != '' ? $moc_tg : null }}" />
                                <input type="hidden"  name="TuNgay" value="{{ $tu_ngay != '' ? $tu_ngay : null }}" />
                                <input type="hidden"  name="DenNgay" value="{{ $den_ngay != '' ? $den_ngay : null }}"/>
                            </div><!-- /.input group -->
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Tìm kiếm</button>
                    </div>
                    </form>
                </div><!-- /.box -->

            
            </div><!--/.col (left) -->
    </div>
    <div class="row">
        <div class="col-xs-12">
           <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                   <script> let arr_year = [] </script>
                   @foreach($arryear as $key=>$value)
                      <script> arr_year[{{ $key }}] = {{ $value }} </script>
                      @if($value != $year)
                          <li><a href="#Nam_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @else
                          <li class="active"><a href="#Nam_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @endif
                  @endforeach
                  <li class="pull-left header"><i class="fa fa-tasks"></i> Danh sách vụ việc</li>
                </ul>
                <div class="tab-content">
                        
                        <div class="col-md-10">
                            <h4 class="box-title text-center">
                                <i class="fa fa-search"></i> @php $title = '' @endphp 
                                @if(isset($Donvi) && isset($Linh_Vuc) && $Donvi != "" && $Linh_Vuc != "")
                                    @php $title .= 'Lĩnh vực: ' .  $Ten_LV . 'và Đơn vị: '. $Donvi @endphp
                                    Tìm kiếm lĩnh vực: <b>{{ $Ten_LV }}</b> và Đơn vị <b>{{ $Donvi }}</b>
                                @elseif(isset($Donvi) && $Donvi != "")
                                    @php $title .= 'Đơn vị: '. $Donvi  @endphp
                                    Tìm kiếm đơn vị: <b>{{ $Donvi }}</b>
                                @elseif(isset($Linh_Vuc) && $Linh_Vuc != "")
                                    @php $title .= 'Lĩnh vực: '.  $Ten_LV  @endphp
                                    Tìm kiếm lĩnh vực: <b>{{ $Ten_LV }}</b>
                                @endif

                                @if(!empty($TuNgay) && $TuNgay != "" || !empty($DenNgay) && $DenNgay != "")
                                    @php $title .= '. Từ ngày:'.  \Carbon\Carbon::parse($TuNgay)->format('d/m/Y') . ' đến ngày:'. \Carbon\Carbon::parse($DenNgay)->format('d/m/Y') @endphp
                                    <br> Từ ngày: <b>{{ \Carbon\Carbon::parse($TuNgay)->format('d/m/Y') }}</b>
                                         đến ngày: <b>{{ \Carbon\Carbon::parse($DenNgay)->format('d/m/Y') }}</b>
                                @endif
                            </h4>
                        </div>
                        <div class="col-md-2">
                            @if(!empty($Donvi)||!empty($Linh_Vuc)||!empty($TuNgay) || !empty($DenNgay))
                                <form method="POST" class="pull-right" action="/thong-ke/xuat-file" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="title" value='{{ $title }}'>
                                    <input type="hidden" name="lstVuViec" value='@json($lstVuViec)'>
                                    <input type="hidden" name="arryear" value=@json($arryear)>
                                    <button type="submit" class="btn btn-default" title="Xuất file excel theo điều kiện tìm kiếm.">
                                        <i class="fa fa-file-excel-o fa-fw"></i>Xuất file
                                    </button>           
                                </form>
                            @endif
                        </div>
                  @foreach($arryear as $jtem)
                      @if($jtem != $year)
                          <div class="tab-pane" id="Nam_{{ $jtem }}">
                              <table class="table table-bordered" id="tblData_{{ $jtem }}">
                                <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Lĩnh vực</th>
                                      <th class="text-center">Số hồ sơ</th>
                                      <th class="text-center">ĐVTC/Số trưng cầu</th>
                                      <th class="text-center">CB phụ trách</th>
                                      <th class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php  $dem = 1;  @endphp
                                      @foreach ($lstVuViec as $item)
                                      @if(Carbon\Carbon::parse($item->NgayTiepNhan)->format('Y') == $jtem)
                                          <tr>
                                            <td class="text-center">{{ $dem }}</td>
                                            <td class="text-center">{{ $item->TenVuViec }}</td>
                                            <td class="text-center">
                                                {{ $item->SoHoSo }} <br>
                                                {{ \Carbon\Carbon::parse($item->NgayTiepNhan)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->DonVi_TC }} <br>
                                                {{ $item->SoCV }}, {{ \Carbon\Carbon::parse($item->NgayTC)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center load-phutrach" data-id={{ $item->ID }}>
                                                <span class="result">Loading...</span>
                                            </td>
                                            <td class="text-center">
                                                @if($item->TrangThai == 0)
                                                    <span class="badge bg-yellow">Đã tiếp nhận</span>
                                                @else
                                                    <span class="badge bg-light-blue">Đã Kết luận</span> <br>
                                                        @if(!empty($item->NgayKT) || $item->NgayKT !== "")
                                                            {{ \Carbon\Carbon::parse($item->NgayKT)->format('d/m/Y') }}
                                                        @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @php  $dem++;  @endphp
                                      @endif
                                    @endforeach
                                </tbody>
                              </table>
                          </div>
                      @else
                          <div class="tab-pane active" id="Nam_{{ $jtem }}">
                              <table class="table table-bordered" id="tblData_{{ $jtem }}">
                                <thead>
                                    <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Lĩnh vực</th>
                                      <th class="text-center">Số hồ sơ</th>
                                      <th class="text-center">ĐVTC/Số trưng cầu</th>
                                      <th class="text-center">CB phụ trách</th>
                                      <th class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php  $dem = 1;  @endphp
                                      @foreach ($lstVuViec as $item)
                                      @if(Carbon\Carbon::parse($item->NgayTiepNhan)->format('Y') == $jtem)
                                          <tr>
                                            <td class="text-center">{{ $dem }}</td>
                                            <td class="text-center">{{ $item->TenVuViec }}</td>
                                            <td class="text-center">
                                                {{ $item->SoHoSo }} <br>
                                                {{ \Carbon\Carbon::parse($item->NgayTiepNhan)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->DonVi_TC }} <br>
                                                {{ $item->SoCV }}, {{ \Carbon\Carbon::parse($item->NgayTC)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center load-phutrach" data-id={{ $item->ID }}>
                                                <span class="result">Loading...</span>
                                            </td>
                                            <td class="text-center">
                                                @if($item->TrangThai == 0)
                                                    <span class="badge bg-yellow">Đã tiếp nhận</span>
                                                @else
                                                    <span class="badge bg-light-blue">Đã Kết luận</span> <br>
                                                        @if(!empty($item->NgayKT) || $item->NgayKT !== "")
                                                        {{ \Carbon\Carbon::parse($item->NgayKT)->format('d/m/Y') }}
                                                        @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @php  $dem++;  @endphp
                                      @endif
                                    @endforeach
                                </tbody>
                              </table>
                          </div>
                      @endif
                  @endforeach
                  <div class="tab-pane active" id="tab_1-1">
                      
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
          
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('jsAdmin'){
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js"></script>
    <script type="text/javascript">
        
        $(function () {
            //Date range picker
            $('#moc_thoigian').daterangepicker({
              autoUpdateInput: false, // Khởi tạo với giá trị mặc định rỗng
              maxDate: moment(),
              showDropdowns: true, //Được chọn tháng/năm
              ranges: {
                    {{-- 'Chọn ngày': ['01/01/' + moment().year(), moment()], --}}
                    'Từ đầu năm - nay': ['01/01/' + moment().year(), moment()],
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    "daysOfWeek": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    "monthNames": ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    "format": 'DD/MM/YYYY',
                    "separator": ' đến ',
                    "applyLabel": 'Áp dụng',
                    "cancelLabel": 'Hủy',
                    "fromLabel": 'Từ',
                    "toLabel": 'Đến',
                    "customRangeLabel": 'Chọn ngày',
                }
            });
              
              {{-- $('#moc_thoigian').val('');
              $('input[name="TuNgay"]').val('');
              $('input[name="DenNgay"]').val(''); --}}
              $('#moc_thoigian').on('cancel.daterangepicker', function () {
                $(this).val('');
                $('input[name="TuNgay"]').val('');
                $('input[name="DenNgay"]').val('');
             });

              // Khi người dùng chọn ngày
             $('#moc_thoigian').on('apply.daterangepicker', function (ev, picker) {
                const tuNgay = picker.startDate.format('YYYY-MM-DD');
                const denNgay = picker.endDate.format('YYYY-MM-DD');

                // Hiển thị lên input daterangepicker
                $(this).val(
                    picker.startDate.format('DD/MM/YYYY') +
                    ' đến ' +
                    picker.endDate.format('DD/MM/YYYY')
                );

                // Gán vào input ẩn
                $('input[name="TuNgay"]').val(tuNgay);
                $('input[name="DenNgay"]').val(denNgay);
            });


            
            $(".select2").select2();

            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = (day) + "/" + (month) + "/" + now.getFullYear();
            $('#NgayTiepNhan').val(today);

            $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true,
              endDate: '+d',
              todayHighlight: true,
              language: 'vi'
          });

            var NgayTiepNhan = $("#NgayTiepNhan").datepicker();

            var NgayTC = $("#NgayTC").datepicker();

            NgayTC.on('show', function (e) {
               if ($("#NgayTiepNhan").datepicker("getDate") != null) {
                    $("#NgayTC").data('datepicker').setEndDate($("#NgayTiepNhan").datepicker("getDate"));
                }
            });

            var NgayGD = $("#NgayGD").datepicker();
            var NgayKT = $("#NgayKT").datepicker();

            NgayGD.on('show', function (e) {
                if ($("#NgayKT").datepicker("getDate") != null) {
                 $("#NgayGD").data('datepicker').setEndDate($("#NgayKT").datepicker("getDate"));
                }
            });

            NgayKT.on('show', function (e) {
                if ($("#NgayGD").datepicker("getDate") != null) {
                    $("#NgayKT").data('datepicker').setStartDate($("#NgayGD").datepicker("getDate"));
                }
            });


            $('.btnDelete').off('click').on('click', function () {

                const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa hồ sơ: ' + $(this).data('sohs') + ' ?',
                    icon: 'fa fa-question-circle',
                    width: '360px',
                    minHeight: '110px',
                    hide: false,
                    closer: false,
                    sticker: false,
                    destroy: true,
                    stack: new PNotify.Stack({
                        dir1: 'down',
                        modal: true,
                        firstpos1: 25,
                        overlayClose: false
                    }),
                    modules: new Map([
                        ...PNotify.defaultModules,
                        [PNotifyConfirm, {
                            confirm: true
                        }]
                        ])
                });

                notice.on('pnotify:confirm', () =>
                 $.ajax({
                    data: {},
                    url: '/giam-dinh/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa tiếp nhận thành công.'
                        });
                        window.location.href = "/giam-dinh/danh-sach.html";
                        
                    }
                })

                 );
                //notice.on('pnotify:cancel', () => alert('Oh ok. Chicken, I see.'));
            });

            
            $('.load-phutrach').each(function () {
                var td = $(this);
                var vv_id = td.data('id');

                $.ajax({
                    url: '/thong-ke/getPhuTrach_vvid/' + vv_id,
                    method: 'GET',
                    success: function (res) {
                        var htm ='';
                        $.each(res.query, function(i, item){
                                     htm += '<span class="badge">'+
                                                                item.HoTen +
                                                            '</span><br>';
                            });
                        td.find('.result').html(htm);
                    },
                    error: function () {
                        td.find('.result').html('Error');
                    }
                });
            });
        });

      function formatDate(date) {
        // console.log(date);
        var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + (d.getDate()),
        year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [day, month, year].join('/');
    }
    </script>
    <script>
        $(document).ready(function(){
            for(let i = 0; i < arr_year.length; i++){
                $("#tblData_" + arr_year[i]).DataTable({
                'columnDefs': [{
                    'targets': [0, 1, 2, 3, 4, 5], /* column index */
                    'orderable': false, /* true or false */
                    }],
                    'pageLength': 25,
                    'order': [[0, 'desc']],
                    'autoWidth': false,
                });
            }
        });
        var token = $("meta[name='csrf-token']").attr("content");
        var common = {
            init: function () {
                common.registerEvent();
            },
            registerEvent: function () {

                $("#txtKeyword").autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        $.ajax({
                            url: "/thong-ke/" + request.term,//Link lấy dữ liệu gợi ý
                            dataType: "json",
                            type: 'get',
                            data: {},
                            success: function (data) {
                                response(data);
                                //response($.map(data, function (item) {
                                //    return {
                                //        value: item.Product_Name,
                                //        label: item.Image
                                //    }
                                //}));
                            }
                        });
                    },
                    focus: function (event, ui) {
                        $("#txtKeyword").val(ui.item.label);
                        return false;
                    },
                    select: function (event, ui) {
                        $("#txtKeyword").val(ui.item.label);
                        //$("#project-id").val(ui.item.value);
                        //$("#project-description").html(ui.item.desc);
                        //$("#project-icon").attr("src", "images/" + ui.item.icon);

                        return false;
                    }
                })
                .autocomplete("instance")._renderItem = function (ul, item) {
                    return $("<li>")
                            .append("<h4 style='font-size: 14px'> Số CV: " + item.value + " - Số HS: " + item.label + "</h4>")
                            // .append("<h4 style='font-size: 14px'> Số HS: " + item.label + "</h4>")
                            .appendTo(ul);
                        };
                    }
                }
                common.init();
    </script>
    @endsection