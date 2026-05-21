@extends('layout._layout')

@section('title', 'Lĩnh vực giám định')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Lĩnh vực giám định
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>Quản lý Giám định</a></li>
			<li class="active">Lĩnh vực giám định</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
     <div class="row">
      @if (Session::get('message') != null)
      <div class="alert alert-success text-center" id="AlertBox">
        {{ Session::get('message') }}
    </div>
    @endif
</div>

<div class="row">
  <div class="col-md-4" style="margin-bottom: 10px">
   <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addProvider">Thêm mới </button>
</div>
</div>

<div class="modal fade" id="addProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Thêm mới loại vụ việc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/Add_LoaiVV" enctype = "multipart/form-data" method="Post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên lĩnh vực:</label>
                        <input type="text" name="Ten" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Thuộc lĩnh vực</label>
                        <br>
                        <div class="radio">
                           <label>
                                <input type="radio" name="GhiChu" value="GĐ" class="minimal-red" checked />
                                Giám định
                            </label>
                        </div>
                        <div class="radio">
                           <label>
                                <input type="radio" name="GhiChu" value="KNHT" class="minimal-red" />
                                Khám nghiệm hiện trường
                            </label>
                        </div>
                    </div> --}}
                    <div class="form-group text-center">
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

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách loại vụ việc</h3>
      </div>
      <div class="box-body">

          <table class="table table-bordered">
           <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Loại vụ việc</th>
                <th class="text-center">Tổng số vụ việc</th>
                <th class="text-center">Ghi chú</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
         @php  $dem = 1;  @endphp
         @foreach ($query as $item)
             <tr>
                <td class="text-center">{{ $dem }}</td>
                <td class="text-center">{{ $item->Ten }}</td>
                <td class="text-center">
                    @for($i = 0; $i < count($count_cv); $i++)
                        @if($count_cv[$i]['LoaiVuViec_ID'] == $item->ID)
                            {{ $count_cv[$i]['Count'] }}
                        @endif
                    @endfor
                </td>
                <td class="text-center">
                    {{ $item->GhiChu == "GĐ" ? "Giám định" : "Khám nghiệm hiện trường" }}
                </td>
                <td class="text-center">
                    <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật vụ việc">
                        <i class="fa fa-edit fa-fw"></i>
                    </button>
                    <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa vụ việc">
                        <i class="fa fa-remove"></i>
                    </button>
                </td>
            </tr>
            @php  $dem++;  @endphp
        @endforeach
    </tbody>
</table>

</div>
</div><!-- /.box-body -->
</div><!-- /.box -->

</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật loại vụ việc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/giam-dinh/Edit_LoaiVV" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên loại vụ việc:</label>
                        <input type="text" name="Ten" id="Ten" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Thuộc lĩnh vực</label>
                        <br>
                        <div class="radio">
                            <label>
                                <input type="radio" name="GhiChu" value="GĐ" class="minimal-red update_ghichu" />
                                Giám định
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="GhiChu" value="KNHT" class="minimal-red update_ghichu" />
                                Khám nghiệm hiện trường
                            </label>
                        </div>

                    </div> --}}
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

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnDelete').off('click').on('click', function () {

                const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa?',
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
                    url: '/giam-dinh/Delete_LoaiVV/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa loại lĩnh vực thành công.'
                        });
                        window.location.href = "/giam-dinh/loai-vu-viec.html";

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
                    url: "/giam-dinh/GetLoai_VVByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        $('#Ten').val(res.query.Ten);
                        $('#ID').val(res.query.ID);
                        {{-- $('input:radio[name=GhiChu][value=' + res.query.GhiChu +']').attr('checked', true); --}}

                    }
                });
            });

        });

    </script>
    @endsection
