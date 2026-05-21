@extends('layout._layout')

@section('title', 'Nhập vụ việc')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Danh sách vụ việc KNHT trong file
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-newspaper-o"></i>Khám nghiệm hiện trường</a></li>
			<li class="active">Nhập vụ việc</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			@if (Session::get('arr_error') != null)
                    <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-close "></i>
                          <h3 class="box-title">Đã xảy ra lỗi khi nhập file vụ việc</h3>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <blockquote>
                            @foreach (Session::get('arr_error') as $key=>$value)
                                <p>Tại STT: <span class="text-red">{{ $value['STT'] }}</span>, {!! $value['ERROR'] !!}</p>
                            @endforeach
                        </blockquote>
                      </div><!-- /.box-body -->
                  </div>
			@endif
		</div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Danh sách vụ việc nhập từ file: <b>{{ Session::get('File_Name') != null ? Session::get('File_Name') : 'Không tìm thấy file.' }}</b></h3>
              <div class="pull-right">
                <button type="button" data-toggle="modal" data-target="#importFile" class="btn btn-primary">
                    <i class="fa fa-upload fa-fw"></i>Nhập từ file
                </button>
              </div>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table class="table table-bordered" id="tblData" style="font-size: 12px">
                <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Vụ việc</th>
                      <th class="text-center">Ngày tiếp nhận</th>
                      <th class="text-center">Đơn vị trưng cầu</th>
                      <th class="text-center">Địa điểm</th>
                      <th class="text-center">Cán bộ KNHT</th>
                      <th class="text-center">Pháp y</th>
                      <th class="text-center">Nội dung vụ việc</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('arr_error') == null && Session::get('knht') != null)
                        @php  $dem = 1;  @endphp
                      @foreach (Session::get('knht') as $key=>$value)
                          <tr>
                            <td class="text-center">{{ $dem }}</td>
                            <td class="text-center">{{ $value['TenVuViec'] }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($value['NgayTiepNhan'])->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $value['DonVi_TC'] }}</td>
                            <td class="text-center">{{ $value['DiaDiem'] }}</td>
                            <td class="text-center">{{ $value['CB_KNHT'] }}</td>
                            <td class="text-center">{{ $value['CB_PY'] }}</td>
                            <td>{{ \Illuminate\Support\Str::words($value['NoiDung'], 20, '...') }}</td>
                            {{-- <td class="text-center load-phutrach" data-id={{ $item->ID }}>
                                <span class="res_knht">Loading...</span>
                            </td>
                            <td class="text-center load-phutrach" data-id={{ $item->ID }}>
                                <span class="res_py">Loading...</span>
                            </td> --}}
                        </tr>
                        @php  $dem++;  @endphp
                        @endforeach
                    @endif
                </tbody>
              
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <form role="form" action="/knht/addImport" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="box-footer text-center">
               <button type="submit" class="btn btn-primary btn-lg" title="Lưu dữ liệu trên">Thêm mới</button>
           </div>
       </form>
    </div>
</div>
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="importFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Nhập vụ việc từ file</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/knht/FrmImport" enctype = "multipart/form-data" method="Post" id="frmImport">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12">
                          <label for="exampleInputFile">Chọn file</label>
                          <input type="file" name="File" id="exampleInputFile" accept=".xls, .xlsx, .csv" required>
                          <p class="help-block">Chọn file excel chứa vụ việc knht: .xls, .xlsx, .csv</p>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Nhập file</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsAdmin'){
    <script type="text/javascript">

      $(document).ready(function(){
        $('.load-phutrach').each(function () {
            var td = $(this);
            var vv_id = td.data('id');

            $.ajax({
                url: '/knht/getPhuTrach_knhtid/' + vv_id,
                method: 'GET',
                success: function (res) {
                    var knht ='';var py ='';
                    $.each(res.query, function(i, item){
                        if(item.ChucDanh == "KNHT"){
                            knht += '<span class="badge">'+ item.HoTen + '</span><br>';
                        }else{
                            py += '<span class="badge">'+ item.HoTen + '</span><br>';
                        }

                    });
                    td.find('.res_knht').html(knht);
                    td.find('.res_py').html(py);
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

    function TextDate(text, startDate, endDate){
            console.log(text);
            var str = '';
            if(text == 'Hôm nay'){
                str = 'Hôm nay: ' + startDate;
            }else if(text == 'Hôm qua'){
                str = 'Hôm qua: ' + startDate;
            }else if(text == '7 ngày gần nhất'){
                str = '7 ngày gần nhất. Từ ngày: ' + startDate + ' đến ngày: ' + endDate;
            }else{
                str = 'Từ ngày: ' + startDate + ' đến ngày: ' + endDate;
            }

            $('#txtDate').text(str);
        }


    </script>
    @endsection
