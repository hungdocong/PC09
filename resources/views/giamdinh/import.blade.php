@extends('layout._layout')

@section('title', 'Nhập vụ việc')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Danh sách vụ việc trong file
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-book"></i>Quản lý giám định</a></li>
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
                          <h3 class="box-title">Đã xảy ra lỗi khi nhập file vụ việc: <b>{{ Session::get('File_Name') != null ? Session::get('File_Name') : 'Không tìm thấy file.' }}</h3>
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
              <h3 class="box-title">Danh sách vụ việc nhập từ file: <b>{{ Session::get('File_Name') != null ? Session::get('File_Name') : 'Không tìm thấy file.' }}</h3>
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
                      <th class="text-center">Số HS</th>
                      <th class="text-center">Trưng cầu số</th>
                      <th class="text-center">Ngày TC</th>
                      <th class="text-center">Đơn vị TC</th>
                      <th class="text-center">Tên vụ việc</th>
                      <th class="text-center">Thời gian</th>
                      <th class="text-center">Địa điểm</th>
                      <th class="text-center">Ngày tiếp nhận/Ngày lập</th>
                      <th class="text-center">Ngày Đky</th>
                      <th class="text-center">Thời hạn GĐ</th>
                      <th class="text-center">Ngày KT</th>
                      <th class="text-center">Lĩnh vực</th>
                      <th class="text-center">GĐV</th>
                      <th class="text-center">Trợ lý GĐ</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('arr_error') == null && Session::get('giamdinh') != null)
                        @php  $dem = 1;  @endphp
                      @foreach (Session::get('giamdinh') as $key=>$value)
                          <tr>
                            <td class="text-center">{{ $dem }}</td>
                            <td class="text-center">{{ $value['SoHoSo'] }}</td>
                            <td class="text-center">{{ $value['SoCV'] }}</td>
                            <td class="text-center">{{ $value['NgayTC'] }}</td>
                            <td class="text-center">{{ $value['DonVi_TC'] }}</td>
                            <td class="text-center">{{ $value['NoiDung'] }}</td>
                            <td class="text-center">{{ $value['ThoiGian'] }}</td>
                            <td class="text-center">{{ $value['DiaDiem'] }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($value['NgayTiepNhan'])->format('d/m/Y') }}</td>
                            <td class="text-center">{{ empty($value['NgayGD']) ? null: $value['NgayGD'] }}</td>
                            <td class="text-center">{{ $value['ThoiHan_GD'] }}</td>
                            <td class="text-center">{{ empty($value['NgayKT']) ? null: $value['NgayKT'] }}</td>
                            <td class="text-center">{{ $value['TenVuViec'] }}</td>
                            <td class="text-center">{{ $value['GĐV'] }}</td>
                            <td class="text-center">{{ $value['TLGĐ'] }}</td>
                        </tr>
                        @php  $dem++;  @endphp
                        @endforeach
                    @endif
                </tbody>
              
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <form role="form" action="/giam-dinh/addImport" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="box-footer text-center">
               <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
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
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Nhập công văn từ file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/FrmImport" enctype = "multipart/form-data" method="Post" id="frmImport">
                    {{ csrf_field() }}
                    <div class="form-group col-md-12">
                      <label for="exampleInputFile">Chọn file</label>
                      <input type="file" name="File" id="exampleInputFile" accept=".xls, .xlsx, .csv" required>
                      <p class="help-block">Chọn file thống kê công văn: .xls, .xlsx, .csv</p>
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
