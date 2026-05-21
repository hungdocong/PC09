@extends('layout._layout')

@section('title', 'Giám định KTSĐT')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Danh sách vụ việc giám định
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>Quản lý Giám định</a></li>
			<li class="active">Danh sách vụ việc</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			@if (Session::get('message') != null)
			<div class="alert alert-success text-center text-uppercase" id="AlertBox">
				{{ Session::get('message') }}
			</div>
			@endif
		</div>
		<div class="row">
			<!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        {{-- <h3 class="box-title text-center">Tiếp nhận vụ việc mới</h3> --}}
                        <div class="pull-left">
                            <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary">
                                Thêm mới<i class="fa fa-plus fa-fw"></i>
                            </button>
                        </div>
                        <div class="pull-right">
                            <button type="button" data-toggle="modal" data-target="#importFile" class="btn btn-primary">
                                <i class="fa fa-download fa-fw"></i>Nhập từ file
                            </button>
                        </div>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                </
            </div><!-- /.box -->

        </div><!--/.col (left) -->
    </div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="pull-right box-tools">
                    <button class="btn btn-primary btn-sm daterange pull-right" id="daterange-btn" data-toggle="tooltip" title="Date range">
                        <i class="fa fa-calendar fa-fw"></i>Chọn mốc thời gian
                    </button>
                </div><!-- /. tools -->
              <h3 class="box-title">Danh sách giám định</h3>
              {{-- <div class="checkbox">
                <label><input type="checkbox" id="myCheckbox"> Sắp xếp</label>
               </div>   --}}           
          </div><!-- /.box-header -->
          <div class="box-body">
              <h4 class="text-center" id="txtDate"></h4>
              {{-- id="tblData" --}}
              <table class="table table-bordered" id="tblData">  
                <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Lĩnh vực</th>
                      <th class="text-center">Số hồ sơ</th>
                      <th class="text-center">Ngày lập</th>
                      <th class="text-center">ĐVTC</th>
                      <th class="text-center">Số TC</th>
                      <th class="text-center">Chấm công</th>
                      <th class="text-center">Trạng thái</th>
                      {{-- <th></th> --}}
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php  $dem = 1;  @endphp
                      @foreach ($lstVuViec as $item)
                      <tr>
                        <td class="text-center">{{ $dem }}</td>
                        <td class="text-center">{{ $item->TenVuViec }}</td>
                        <td class="text-center">{{ $item->SoHoSo }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->NgayTiepNhan)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $item->DonVi_TC }}</td>
                        <td class="text-center">{{ $item->SoCV }}, {{ \Carbon\Carbon::parse($item->NgayTC)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if($item->TrangThai == -1)
                                <span class="badge bg-light-red">Trống</span>
                            @elseif(!empty($item->NgayGD) || $item->NgayGD != "")
                                <button class="btn btn-block btn-default btn-xs ToolEdit" data-sohs="{{ $item->SoHoSo }}" data-id="{{ $item->ID }}" title="click để cập nhật">
                                    <b>{{ \Carbon\Carbon::parse($item->NgayGD)->format('d/m/Y') }}</b> - 
                                    <b>{{ \Carbon\Carbon::parse($item->NgayKT)->format('d/m/Y') }}</b>
                                </button>
                            @elseif(!empty($item->GiamDinh) || $item->GiamDinh != "")
                                <button class="btn btn-block btn-default btn-xs SelectDate" data-sohs="{{ $item->SoHoSo }}" data-id="{{ $item->ID }}" title="click để cập nhật">
                                    <?php 
                                        $arr_str = explode(',', $item->GiamDinh); 
                                        $arr = array();
                                        for ($i = 0; $i < count($arr_str) ; $i++)
                                            $arr[] = \DateTime::createFromFormat('Y-m-d', $arr_str[$i])->format('d/m/Y');
                                        $giamdinh = Str::limit(implode(',', $arr), 24);
                                    ?>
                                    <b>{{ $giamdinh }}</b>
                                </button>
                            @else
                                <button class="btn btn-block btn-danger btn-xs ToolEdit" data-sohs="{{ $item->SoHoSo }}" data-id="{{ $item->ID }}" title="click để cập nhật">Trống</button>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->TrangThai == 0)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-xs">Đã tiếp nhận</button>
                                      <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:void(0)" class="ToolEdit" data-sohs="{{ $item->SoHoSo }}" data-id="{{ $item->ID }}">Hoàn thành</a></li>
                                        <li><a href="javascript:void(0)" class="btnRefus" data-id="{{ $item->ID }}">Từ chối giám định</a></li>
                                    </ul>
                                </div>
                            @elseif($item->TrangThai == 1)
                                <span class="badge bg-light-blue">Hoàn thành</span>
                             @else
                                <span class="badge bg-red">Từ chối giám định</span>
                            @endif
                        </td>
                        {{-- <td class="text-center">
                            @if($item->TrangThai == 1)
                                <div class="form-group">
                                    <label>
                                      <input type="radio" class="minimal" data-id="{{ $item->ID }}" {{ $item->ThanhToan == 1 ? "checked" : "" }} style="transform: scale(1.1);" />
                                  </label>
                                </div>
                            @endif
                        </td> --}}
                        <td class="text-center">
                            <button class="btn btn-default btn-xs btnEdit" data-id="{{ $item->ID }}" title="Cập nhật"><i class="fa fa-edit fa-fw"></i></button>
                            <button class="btn btn-danger btn-xs btnDelete"data-sohs="{{ $item->SoHoSo }}" data-id="{{ $item->ID }}" title="Xóa"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                    @php  $dem++;  @endphp
                    @endforeach
                </tbody>
              
        </table>
    </div><!-- /.box-body -->
    {{-- <div class="box-footer clearfix">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
    </div> --}}
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

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center text-uppercase" id="exampleModalLabel">
                    Thêm vụ việc giám định mới <b class="edit-gd"></b>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/giam-dinh/add" method="post" id="frmValidate" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Lĩnh vực giám định</label>
                            <select name="TenVuViec" class="form-control">
                                <option value="">---Chọn lĩnh vực---</option>
                                @foreach($lstLoai_vuviec as $item)
                                    <option value="{{ $item->ID }}">{{ $item->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Số trưng cầu</label>
                            <input type="text" class="form-control" name="SoCV" placeholder="Số trưng cầu..." required>
                            {{-- <p class="help-block">123/QĐ-ĐTTH</p> --}}
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ngày trưng cầu</label>
                            <div class="input-group date_pic">
                                <input type="text" class="form-control datepicker" name="NgayTC" placeholder="Ngày trưng cầu..."required/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Đơn vị trưng cầu:</label>
                            <input type="text" name="DonVi" class="form-control" list="DV_ID" placeholder="Chọn Đơn vị trưng cầu..."/>
                            <datalist id="DV_ID" >
                                <option value="">---Chọn Đơn vị trưng cầu---</option>
                                @foreach($lstDonVi as $item)
                                <option value="{{ $item->Ten }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group col-md-4">
                            <label >Số hồ sơ</label>
                            <input type="text" class="form-control" name="SoHoSo" placeholder="Nhập Số hồ sơ..." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label >Ngày tiếp nhận</label>
                            <div class="input-group date_pic">
                                <input type="text" class="form-control datepicker" name="NgayTiepNhan" id="NgayTiepNhan" required/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="col-form-label">Tên vụ việc:</label>
                            <input type="text" name="NoiDung" class="form-control" list="lst_ND" placeholder="Chọn hoặc nhập tên vụ việc..."/>
                            <datalist id="lst_ND" >
                                @foreach($lstTenVV as $item)
                                <option value="{{ $item->NoiDung }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group col-md-4">
                            <label >Địa điểm xảy ra</label>
                            <input type="text" class="form-control" name="DiaDiem" placeholder="Nhập địa điểm xảy ra vụ việc..." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label >Thời gian xảy ra</label>
                            <div class="input-group date_pic">
                                <input type="text" class="form-control datepicker" placeholder="Nhập thời gian xảy ra vụ việc..." name="ThoiGian" required/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label >Thời hạn giám định</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ThoiHan_GD" placeholder="Nhập thời hạn giám định...." required/>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Giám định viên</label>
                            <select name="GDV[]" id="GDV_ID"class="form-control select2" multiple="multiple" required>
                                @foreach($ds_canbo as $item)
                                <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Trợ lý giám định</label>
                            <select name="TLGD[]" id="TLGD_ID" class="form-control select2" multiple="multiple">
                                @foreach($ds_canbo as $item)
                                <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center text-uppercase" id="exampleModalLabel">
                    Cập nhật thông tin vụ <b class="edit-gd"></b>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/update" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Lĩnh vực giám định</label>
                        <select name="TenVuViec" id="LoaiVuViec_ID" class="form-control">
                            <option value="">---Chọn lĩnh vực---</option>
                            @foreach($lstLoai_vuviec as $item)
                            <option value="{{ $item->ID }}">{{ $item->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Số trưng cầu:</label>
                        <input type="text" name="SoCV" id="SoCV" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label >Ngày trưng cầu</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="NgayTC" id="NgayTC_edit" placeholder="Ngày trưng cầu..."required/>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Đơn vị trưng cầu:</label>
                        <input type="text" name="DonVi" id="DonVi" class="form-control" list="DV_ID" placeholder="Chọn Đơn vị trưng cầu..."/>
                        <datalist id="DV_ID" >
                            <option value="">---Chọn Đơn vị trưng cầu---</option>
                            @foreach($lstDonVi as $item)
                            <option value="{{ $item->Ten }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-group col-md-4">
                        <label >Số hồ sơ</label>
                            <input type="text" class="form-control" name="SoHoSo" id="SoHoSo"placeholder="Nhập Số hồ sơ..." required>
                    </div>
                    <div class="form-group col-md-4">
                       <label >Ngày lập/đăng ký</label>
                       <div class="input-group">
                            <input type="text" class="form-control datepicker" name="NgayTiepNhan" id="NgayTiepNhan_edit" required/>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Tên vụ việc:</label>
                        <input type="text" name="NoiDung" id="NoiDung" class="form-control" list="lst_ND" placeholder="Chọn hoặc nhập tên vụ việc..."/>
                        <datalist id="lst_ND" >
                            @foreach($lstTenVV as $item)
                            <option value="{{ $item->NoiDung }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="form-group col-md-4">
                        <label >Địa điểm xảy ra</label>
                        <input type="text" class="form-control" name="DiaDiem" id="DiaDiem" placeholder="Nhập địa điểm xảy ra vụ việc..." required>
                    </div>
                    <div class="form-group col-md-4">
                        <label >Thời gian xảy ra</label>
                        <div class="input-group date_pic">
                            <input type="text" class="form-control datepicker" placeholder="Nhập thời gian xảy ra vụ việc..." name="ThoiGian" id="ThoiGian" required/>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label >Thời hạn giám định</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="ThoiHan_GD" id="ThoiHan_GD" placeholder="Nhập thời hạn giám định...." required/>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Giám định viên</label>
                        <select name="GDV[]" id="GDV_ID_edit" class="form-control select2" multiple="multiple" required>
                            @foreach($ds_canbo as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Trợ lý giám định</label>
                        <select name="TLGD[]" id="TLGD_ID_edit" class="form-control select2" multiple="multiple">
                            @foreach($ds_canbo as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center col-md-12" style="margin-top: 60px">
                        <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade toolEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật chấm công hồ sơ: <b class="edit-gd"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/update_chamcong" enctype = "multipart/form-data" method="Post" >
                    {{ csrf_field() }}
                    <div div class="form-group col-md-12">
                        <button type="button" id="btnSltDate" class="btn btn-default btn-sm"><i class="fa fa-calendar fa-fw"></i>Chọn ngày</button>
                    </div>
                    <input type="hidden" name="ID" id="ID_VuViec" />
                    <div class="form-group col-md-6">
                        <label >Ngày giám định</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="NgayGD" id="NgayGD" placeholder="Ngày giám định..."required/>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label >Ngày kết thúc</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="NgayKT" id="NgayKT" placeholder="Ngày kết thúc..."/>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade toolUpdateGD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật chấm công hồ sơ: <b class="edit-gd"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/update_chon_NgayGD" enctype = "multipart/form-data" method="Post" >
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                              <h3 class="box-title">Chọn ngày: <b class="selected_date"></b></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                                <input type="hidden" name="ID" id="ID_sltgd" />
                                <div class="form-group col-md-12">
                                    <!-- <label >Chọn ngày</label> -->
                                    <div id="Date_Sel"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label >Ngày đã chọn</label>
                                    <textarea class="form-control" rows="3" placeholder="...." name="date_select" id="date_select"></textarea>
                                </div>
                            </div><!-- /.box-body -->      
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg" >Cập nhật</button>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsAdmin'){
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $str = '';
           $('#Date_Sel').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                locale: 'vi',
                events: function(start, end, timezone, callback) {},
                dayClick: function(date, jsEvent, view) {
                    if(date > new Date()){
                        return;
                    }
                  $date = formatDate(date, 0);
                  
                  if($str.indexOf($date) == -1){
                    if(!$str)
                        $str += $date;
                    else 
                        $str += "," + $date;
                  }else {
                        if($str.length == 10)
                           $str = ''; 
                        else if($str.slice(0, 10) === $date)
                            $str = $str.replace($date + ",", "");
                        else 
                            $str = $str.replace("," + $date, "");
                        
                  }
                  // console.log($str.slice(0, 10));
                  // console.log($str.length);
                  $('#date_select').empty();
                  $('#date_select').val($str);
              },
                select: function(start, end, jsEvent, view) {},
                eventRender: function(event, element, view) {},
                editable: true,
                droppable: true,
                  selectable: true, // this allows things to be dropped onto the calendar !!!
                  drop: function (date, allDay) { // this function is called when something is dropped
                    var originalEventObject = $(this).data('eventObject');
                    var copiedEventObject = $.extend({}, originalEventObject);
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    if ($('#drop-remove').is(':checked')) {
                      $(this).remove();
                  }
                }
           });
            // $('.minimal').click(function(event) {
            $('input[type="radio"]').click(function(event) {
                var ID = $(this).data('id');
                // alert(ID);
                $.ajax({
                    url: "/giam-dinh/update_tt/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $(this).attr("checked", true);
                    }
                });
                // window.location.href = "/giam-dinh/update_tt/" + ID;
            });

            $('.btnRefus').click(function(event) {
                var ID = $(this).data('id');
                // alert(ID);
                $.ajax({
                    url: "/giam-dinh/update_refus/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Cập nhật thành công.'
                        });
                        window.location.href = "/giam-dinh/danh-sach.html";
                    }
                });
                // window.location.href = "/giam-dinh/update_tt/" + ID;
            });

            $('#btnSltDate').click(function(event) {
                $('.toolUpdateGD').modal('show');
                $('#ID_sltgd').val($('#ID_VuViec').val());
                $('#date_select').val('');
                $('.selected_date').empty();
            });

           
            $('.slt').click(function(event) {
               $('#sltDate').css('display', 'block');
               
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#daterange-btn').daterangepicker({
                ranges: {
                    'Tất cả vụ việc': ['01/01/' + moment().year(), moment()],
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày gần nhất': [moment().subtract(6, 'days'), moment()],
                    'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    "daysOfWeek": ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    "monthNames": ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    "format": 'DD-MM-YYYY',
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                maxDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                console.log(start.format('DD/MM/YYYY'));
                console.log(end.format('DD/MM/YYYY'));

                $('#startDate').val(start);
                $('#endDate').val(end);

                var json_date = [];
                json_date.push({
                    startDate: start,
                    endDate: end
                });
                // console.log(json_date);
                // window.location.href = "/giam-dinh/bao-cao/" + JSON.stringify(json_date);
                var txt = $('.ranges ul li.active').text();
                $.ajax({
                    type: 'GET',
                    url: '/giam-dinh/bao-cao/' + JSON.stringify(json_date),
                    data: {},
                    dataType: 'Json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                      
                            $('#tblData').empty();
                            var html = '', dem = 1;
                            html = '<tr>'+
                                          '<th class="text-center">#</th>'+
                                          '<th class="text-center">Lĩnh vực</th>'+
                                          '<th class="text-center">Số hồ sơ</th>'+
                                          '<th class="text-center">Ngày lập</th>'+
                                          '<th class="text-center">ĐVTC</th>'+
                                          '<th class="text-center">Số TC</th>'+
                                          '<th class="text-center">Chấm công</th>'+
                                          '<th class="text-center">Trạng thái</th>'+
                                          '<th></th>'+
                                    '</tr>';
                            $.each(res.lstVuViec, function (i, item) {
                                 // console.log(res.lstVuViec);
                                html += '<tr>'+
                                            '<td class="text-center">' + dem +'</td>'+
                                            '<td class="text-center">' + item.TenVuViec +'</td>'+
                                            '<td class="text-center">' + item.SoHoSo +'</td>'+
                                            '<td class="text-center">' + formatDate(item.NgayTiepNhan) +'</td>'+
                                            '<td class="text-center">' + item.DonVi_TC +'</td>'+
                                            '<td class="text-center">' +item.SoCV +', '+ formatDate(item.NgayTC) +'</td>'+
                                            '<td class="text-center">';
                                                if(item.NgayGD == null){
                                                    html +='<button class="btn btn-block btn-danger btn-xs ToolEdit" data-sohs="' + item.SoHoSo +'" data-id="' + item.ID +'" title="click để cập nhật">Trống</button>';
                                                }else{
                                                      html +='<button class="btn btn-block btn-default btn-xs ToolEdit" data-sohs="' + item.SoHoSo +'" data-id="' + item.ID +'" title="click để cập nhật">'+
                                                    '<b>' + formatDate(item.NgayGD) +'</b> - '+
                                                    '<b>' + formatDate(item.NgayKT) +'</b></button>';
                                                }
                                               
                                            html +='</td>'+
                                                '<td class="text-center">';
                                                if(item.TrangThai == 0){
                                                    html +='<span class="badge bg-yellow">Đã tiếp nhận</span>';
                                                }
                                                else{
                                                    html += '<span class="badge bg-light-blue">Hoàn thành</span>';
                                                }
                                            html +='</td>'+
                                                    '<td class="text-center">'+
                                                        '<button class="btn btn-default btnEdit" data-id="' + item.ID +'" title="Cập nhật"><i class="fa fa-edit fa-fw"></i></button>'+
                                                        '<button class="btn btn-danger btnDelete"data-sohs="' + item.SoHoSo+'" data-id="' + item.ID +'" title="Xóa"><i class="fa fa-remove"></i></button>'+
                                                    '</td>'+
                                            '</tr>';
                                dem++;
                            });
                            TextDate(txt, start.format('DD/MM/YYYY'), end.format('DD/MM/YYYY'))
                            $('#tblData').append(html);  
                    }
                });
            }
            );
        });
        $(function () {
        	 //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(3000).slideUp(500);
            $(".select2").select2();

            $("#tblData").DataTable({
                        'columnDefs': [{
                            'targets': [1, 2, 3, 4, 5, 6 ,7, 8], /* column index */
                            'orderable': false, /* true or false */
                        }],
                        'pageLength': 25,
                        'order': [[0, 'desc']]
                    });

            var original1 = $('#GDV_ID').html();
            var original2 = $('#TLGD_ID').html();
            $('#GDV_ID, #TLGD_ID').select2();
            function refreshOptions() {
                var val1 = $('#GDV_ID').val();
                var val2 = $('#TLGD_ID').val();

                // reset lại dữ liệu gốc
                $('#GDV_ID').html(original1);
                $('#TLGD_ID').html(original2);

                // remove giá trị đã chọn bên kia
                if (val2) {
                    {{-- $("#GDV_ID option[value='" + val2 + "']").remove(); --}}
                    val2.forEach(function(v){
                        $("#GDV_ID option[value='" + v + "']").remove();
                    });
                }
                if (val1) {
                    {{-- $("#TLGD_ID option[value='" + val1 + "']").remove(); --}}
                    val1.forEach(function(v){
                        $("#TLGD_ID option[value='" + v + "']").remove();
                    });
                }

                // set lại value
                $('#GDV_ID').val(val1);
                $('#TLGD_ID').val(val2);

                // update UI
                $('#GDV_ID, #TLGD_ID').trigger('change.TLGD_ID');
            }

            // bắt sự kiện
            $('#GDV_ID, #TLGD_ID').on('change', function () {
                refreshOptions();
            });
            

            var original3 = $('#GDV_ID_edit').html();
            var original4 = $('#TLGD_ID_edit').html();
            $('#GDV_ID_edit, #TLGD_ID_edit').select2();
            function refreshOptions_Edit() {
                var val1 = $('#GDV_ID_edit').val();
                var val2 = $('#TLGD_ID_edit').val();

                // reset lại dữ liệu gốc
                $('#GDV_ID_edit').html(original3);
                $('#TLGD_ID_edit').html(original4);

                // remove giá trị đã chọn bên kia
                if (val2) {
                    {{-- $("#GDV_ID_edit option[value='" + val2 + "']").remove(); --}}
                    val2.forEach(function(v){
                        $("#GDV_ID_edit option[value='" + v + "']").remove();
                    });
                }
                if (val1) {
                    {{-- $("#TLGD_ID_edit option[value='" + val1 + "']").remove(); --}}
                    val1.forEach(function(v){
                        $("#TLGD_ID_edit option[value='" + v + "']").remove();
                    });
                }

                // set lại value
                $('#GDV_ID_edit').val(val1);
                $('#TLGD_ID_edit').val(val2);

                // update UI
                $('#GDV_ID_edit, #TLGD_ID_edit').trigger('change.TLGD_ID_edit');
            }

            // bắt sự kiện
            $('#GDV_ID_edit, #TLGD_ID_edit').on('change', function () {
                refreshOptions_Edit();
            });

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

            $('.btnEdit').click(function(event) {
                $('.edit').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                    url: "/giam-dinh/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#SoCV').val(res.vu_viec.SoCV);
                        $('select#LoaiVuViec_ID').val(res.vu_viec.LoaiVuViec_ID);
                        $('#SoHoSo').val(res.vu_viec.SoHoSo);
                        $('#NgayTC_edit').val(formatDate(res.vu_viec.NgayTC));
                        $('#NgayKT').val(res.vu_viec.NgayKT);
                        $('#NgayTiepNhan_edit').val(formatDate(res.vu_viec.NgayTiepNhan));
                        $('#ID').val(res.vu_viec.ID);
                        $('#DonVi').val(res.vu_viec.DonVi_TC);
                        $('#NoiDung').val(res.vu_viec.NoiDung);
                        $('#DiaDiem').val(res.vu_viec.DiaDiem);
                        $('#ThoiGian').val(res.vu_viec.ThoiGian);
                        $('#ThoiHan_GD').val(res.vu_viec.ThoiHan_GD);
                        $('.edit-gd').text(res.vu_viec.SoHoSo);

                        var gdv = [];
                        var tlgd = [];
                        $.each(res.phutrach, function(i, item){
                            if(item.ChucDanh == "Giám định viên")
                                gdv.push(item.CanBo_ID);
                            if(item.ChucDanh == "Trợ lý")
                                tlgd.push(item.CanBo_ID);

                        });
                        $('#GDV_ID_edit').select2().val(gdv).trigger("change");
                        $('#TLGD_ID_edit').select2().val(tlgd).trigger("change");
                    }
                });
            });

            $('.ToolEdit').click(function(event) {
                $('.toolEdit').modal('show');
                // alert($(this).data('id'));
                var ID = $(this).data('id');
                var Name = $(this).data('sohs');
                $('.edit-gd').text(Name);

                $.ajax({
                    url: "/giam-dinh/getChamCongByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        res.query.NgayKT != null ? $('#NgayKT').val(formatDate(res.query.NgayKT)) : $('#NgayKT').val(today);
                        res.query.NgayGD != null ? $('#NgayGD').val(formatDate(res.query.NgayGD)) : "";
                        $('#ID_VuViec').val(ID);
                    }
                });
            });

            $('.SelectDate').click(function(event) {
                $('.toolUpdateGD').modal('show');
                var ID = $(this).data('id');
                var Name = $(this).data('sohs');
                $('.edit-gd').text(Name);
                $.ajax({
                    url: "/giam-dinh/getChamCongByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        
                        var arr_str = res.giamdinh.split(',');
                                // console.log(arr_str);
                        var date = '';
                        for(var i = 0; i < arr_str.length ; i++){
                           arr_str[i] = formatDate(arr_str[i], 0)
                        }
                        $('#ID_sltgd').val(ID);
                        $('#date_select').val('');
                        $('.selected_date').empty();
                        $('#date_select').val(arr_str.join());
                        $('.selected_date').text(arr_str.join());
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
