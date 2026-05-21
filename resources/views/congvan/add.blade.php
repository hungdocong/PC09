@extends('layout._layout')

@section('title', 'Thêm công văn')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thêm công văn
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-bars"></i> Quản lý công văn</a></li>
            <li class="active">Thêm công văn</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		@if (Session::get('message') != null)
     <div class="row">
        <div class="alert alert-success text-center" id="AlertBox">
           {{ Session::get('message') }}
       </div>
   </div>
   @endif
   <div class="row">
     <!-- left column -->
     <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
           <div class="box-header with-border">
              <h3 class="box-title">Thêm mới công văn</h3>
              
            <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa {{ Session::get('congvan')!=null ? 'fa-plus' : 'fa-minus' }}"></i>
                </button>
            </div>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/cong-van/add" method="post" id="frmValidate" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="box-body pad" style="display: {{ Session::get('congvan')!=null ? 'none' : 'block' }};">
            <div class="form-group col-md-12">
                 <button type="button" data-toggle="modal" data-target="#importFile" class="btn btn-primary">
                    <i class="fa fa-upload fa-fw"></i>Nhập từ file
                </button>
            </div>
             <div class="form-group col-md-3">
                <label for="recipient-name" class="col-form-label">Số công văn:</label>
                <input type="text" name="SoCV" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="recipient-name" class="col-form-label">Ngày gửi:</label>
                <input type="date" name="NgayGui"class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="recipient-name" class="col-form-label">Loại công văn:</label>
                <select name="LoaiCV_ID" class="form-control">
                    <option value="">---Chọn loại công văn---</option>
                    @foreach($lstLoaiCV as $item)
                        <option value="{{ $item->ID }}">{{ $item->TenLoai }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="recipient-name" class="col-form-label">Năm:</label>
                <select name="Nam" class="form-control">
                    {{-- <option value="">-Chọn năm nhập hồ sơ-</option> --}}
                    @for($i = 0; $i < count($arr_year) ; $i++)
                        <option value="{{ $arr_year[$i] }}" {{ $i == 0 ? 'selected' : '' }}>{{ $arr_year[$i] }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-12 NoiGui" style="display: none;">
                <label for="recipient-name" class="col-form-label">Nơi gửi:</label>
                <input type="text" name="NoiGui" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="recipient-name" class="col-form-label">Nội dung:</label>
                <textarea class="form-control" name="NoiDung"rows="4"></textarea>
            </div>

            <div class="form-group col-md-12">
                <label for="recipient-name" class="col-form-label">Ghi chú:</label>
                <input type="text" name="GhiChu" class="form-control" placeholder="Độ mật...">
            </div>
            <div class="form-group col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
            </div>
        </div><!-- /.box-body -->

 </form>
</div><!-- /.box -->

</div><!--/.col (left) -->
</div>   <!-- /.row -->

@if(Session::get('congvan') != null)

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Nhập công văn: <b>{{ Session::get('loaicv')['TenLoai'] }}</b>, năm <b>{{ Session::get('loaicv')['Nam']}}</b></h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
               <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Số công văn</th>
                    <th class="text-center">Nơi gửi / ngày gửi</th>
                    <th class="text-center">Nội dung</th>
                    <th class="text-center">Tờ số</th>
                </tr>
            </thead>
            <tbody>
             @php  $dem = 1;  @endphp
             @foreach (Session::get('congvan') as $key=>$value)
             <tr>
                <td class="text-center">{{ $dem }}</td>
                <td class="text-center">{{ $value['KHVB'] }}</td>
                <td class="text-center">
                    {{-- <p>{{ $value['Price'] }}</p> --}}
                    <p>{{ $value['NgayThang'] }}</p>
                </td>
                <td>{{ $value['VB'] }}</td>
                <td class="text-center">{{ $value['ToSo'] }}</td>
            </tr>
            @php  $dem++;  @endphp
            @endforeach
        </tbody>
    </table>

</div>
<div class="box-footer">
    <form role="form" action="/cong-van/frmImport" method="post" enctype="multipart/form-data">
       {{ csrf_field() }}
       <input type="hidden" name="LoaiCV_ID" value="{{ Session::get('loaicv')['LoaiCV_ID'] }}" class="form-control">
       <input type="hidden" name="Nam" value="{{ Session::get('loaicv')['Nam'] }}" class="form-control">
       <div class="box-footer text-center">
           <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
       </div>
   </form>
</div>
</div><!-- /.box-body -->
</div><!-- /.box -->

</div><!-- /.col -->


@endif



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
                <form action="/cong-van/import" enctype = "multipart/form-data" method="Post" id="frmImport">
                    {{ csrf_field() }}
                    
                    <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Loại công văn:</label>
                        <select name="LoaiCV_ID" class="form-control">
                            <option value="">---Chọn loại công văn---</option>
                            @foreach($lstLoaiCV as $item)
                                <option value="{{ $item->ID }}">{{ $item->TenLoai }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="recipient-name" class="col-form-label">Năm:</label>
                        <select name="Nam" class="form-control">
                            {{-- <option value="">-Chọn năm nhập công văn-</option> --}}
                            @for($i = 0; $i < count($arr_year) ; $i++)
                                <option value="{{ $arr_year[$i] }}" {{ $i == 0 ? 'selected' : '' }}>{{ $arr_year[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputFile">Chọn file</label>
                      <input type="file" name="File" id="exampleInputFile" accept=".xls, .xlsx, .csv">
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

@section('jsAdmin')

   
    <script type="text/javascript">

        $(function () {
            $(".datepicker").datepicker({
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                autoclose: true,
                language: 'vi'
            });
        	 //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(3000).slideUp(500);


            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");

            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmValidate").validate({
                rules: {
                    SoCV: "required",
                    NoiGui: "required",
                    NgayGui: "required",
                    NoiDung: "required",
                    LoaiCV_ID: {
                        select_validate: true
                    },
                    Nam: {
                        select_validate: true
                    }
                },
                messages: {
                    SoCV: "Vui lòng nhập số công văn",
                    NoiGui: "Vui lòng đơn vị gửi công văn",
                    NgayGui: "Vui lòng chọn ngày gửi công văn",
                    NoiDung: "Vui lòng nhập tiêu đề công văn",
                    LoaiCV_ID: {
                        select_validate: "Bạn chưa chọn loại công văn"
                    },
                    Nam: {
                        select_validate: "Bạn chưa chọn năm nhập công văn"
                    }
                }
            });

            $("#frmImport").validate({
                rules: {
                    File: "required",
                    LoaiCV_ID: {
                        select_validate: true
                    },
                    Nam: {
                        select_validate: true
                    }
                },
                messages: {
                    File: "Vui lòng chọn file",
                    LoaiCV_ID: {
                        select_validate: "Bạn chưa chọn loại công văn"
                    },
                    Nam: {
                        select_validate: "Bạn chưa chọn năm nhập công văn"
                    }
                }
            });

            
        });


    </script>
    
@endsection