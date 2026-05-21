@extends('layout._layout')

@section('title', 'Đơn vị trưng cầu')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Đơn vị trưng cầu
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>Giám định KTSĐT</a></li>
			<li class="active">Đơn vị trưng cầu</li>
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
                        <h3 class="box-title text-center">Thêm đơn vị trưng cầu mới</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/don-vi/add" method="post" id="frmValidate" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">Tên đơn vị</label>
                            <input type="text" class="form-control" name="Ten" placeholder="Nhập tên đơn vị..." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <input type="text" class="form-control" name="GhiChu">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
                    </div>
                </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
    </div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Danh sách đơn vị trưng cầu</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table class="table table-bordered" id="tblData">
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Tên</th>
                  <th class="text-center">Số vụ việc</th>
                  <th class="text-center">Ghi chú</th>
                  <th class="text-center">Trạng thái</th>
                  <th></th>
              </tr>
              @php  $dem = 1;  @endphp
              @foreach ($lstDonVi as $item)
                  <tr>
                    <td class="text-center">{{ $dem }}</td>
                    <td class="text-center">{{ $item->Ten }}</td>
                    <td class="text-center">
                        @php  $count = 0;  @endphp
                        @foreach ($lstVuViec as $jtem)
                            @if($jtem->DonVi_ID == $item->ID)
                                @php  $count++;  @endphp
                            @endif
                        @endforeach
                        {{ $count }}
                    </td>
                    <td class="text-center">{{ $item->GhiChu }}</td>
                    <td class="text-center">
                        @if($item->TrangThai == 1)
                             <button class="btn btn-primary btnStatus" data-id="{{ $item->ID }}" data-stt="0" title="Click để khoá đơn vị trưng cầu">
                                Đang hoạt động </button>
                        @else
                             <button class="btn btn-default btnStatus" data-id="{{ $item->ID }}" data-stt="1" title="Click để hoạt động đơn vị trưng cầu">
                             Đã khoá</button>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật"><i class="fa fa-edit fa-fw"></i></button>
                        <button class="btn btn-danger btnDelete"data-ten="{{ $item->Ten }}" data-id="{{ $item->ID }}" title="Xóa"><i class="fa fa-remove"></i></button>
                    </td>
                  </tr>
            @php  $dem++;  @endphp
            @endforeach
        </table>
    </div><!-- /.box-body -->
</div>
</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center text-uppercase" >
                    Cập nhật thông tin 
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/don-vi/update" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">Tên đơn vị</label>
                            <input type="text" class="form-control" name="Ten" id="Ten" placeholder="Nhập tên đơn vị..." required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">Ghi chú</label>
                            <input type="text" class="form-control" name="GhiChu" id="GhiChu">
                        </div>
                    <div class="form-group text-center">
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


@endsection

@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {
        	 //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(3000).slideUp(500);

            $('.btnDelete').off('click').on('click', function () {

                const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa : ' + $(this).data('ten') + ' ?',
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
                    url: '/don-vi/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa thành công.'
                        });
                        window.location.href = "/don-vi/danh-sach.html";
                        
                    }
                })

                 );
                //notice.on('pnotify:cancel', () => alert('Oh ok. Chicken, I see.'));
            });

            $('.btnEdit').click(function(event) {
                $('.edit').modal('show');
                var ID = $(this).data('id');
                $.ajax({
                    url: "/don-vi/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#Ten').val(res.query.Ten);
                        $('#GhiChu').val(res.query.GhiChu);
                        $('#ID').val(res.query.ID);
                    }
                });
            });
            $('.btnStatus').off('click').on('click', function () {
                 $.ajax({
                    data: {},
                    url: '/don-vi/change-status/' + $(this).data('id') + '/' + $(this).data('stt'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                       PNotify.success({
                        title: 'THÔNG BÁO!!',
                        text: 'Cập nhật thành công.'
                       });
                        setTimeout(function(){window.location.href = "/don-vi/danh-sach.html";}, 2000);
                    }
                })
            });
           
        });
        
    </script>
    @endsection