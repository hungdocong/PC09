@extends('layout._layout')

@section('title', 'Danh sách - Tra cứu công văn')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Danh sách - Tra cứu công văn
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bars"></i>Quản lý công văn</a></li>
			<li class="active">Danh sách - Tra cứu công văn</li>
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
         <a href="/cong-van/them-moi.html" class="btn btn-lg btn-primary">Thêm mới</a>
     </div>
     <div class="col-md-3">
        <div class="form-group">
            <label for="">Năm</label>
            <select id="filter_year" class="form-control">
                @for($i = 0; $i < count($arr_year) ; $i++)
                    <option value="{{ $arr_year[$i] }}" {{ $arr_year[$i] == $view_year ? 'selected' : '' }}>{{ $arr_year[$i] }}</option>
                @endfor
            </select>
        </div>
    </div>
 </div>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách công văn năm: <b>{{ $view_year }}</b></h3>
      </div>
      <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?php $i = 0; ?>
               @foreach($lstLoaiCV as $item)
                    @if($i == 0)
                        <li class="active"><a href="#loai_cv_{{ $item->ID }}" data-toggle="tab">{{ $item->TenLoai }}</a></li>
                    @else
                        <li><a href="#loai_cv_{{ $item->ID }}" data-toggle="tab">{{ $item->TenLoai }}</a></li>
                    @endif
                    <?php $i++; ?>
               @endforeach
          </ul>
          <div class="tab-content">
                <?php $i = 0; ?>
                @foreach($lstLoaiCV as $jtem)

                    @if($i == 0)
                        <div class="tab-pane active" id="loai_cv_{{ $jtem->ID }}">
                            <table class="table table-bordered table-hover" id="tblData_{{ $jtem->ID }}">
                                 <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Số công văn</th>
                                        <th class="text-center">Nơi gửi / ngày gửi</th>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Tờ số</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @php  $dem = 1;  @endphp
                                   @foreach ($lstCongVan as $item)
                                       @if($item->LoaiCV_ID === $jtem->ID)
                                            <tr>
                                                <td class="text-center">{{ $dem }}</td>
                                                <td class="text-center">{{ $item->SoCV }}</td>
                                                <td class="text-center">{{ $item->NgayGui }}/td>
                                                <td class="text-center">{{ $item->NoiDung }}</td>
                                                <td class="text-center">{{ $item->GhiChu }}</td>
                                                <td class="text-center">{{ $item->ToSo }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật công văn">
                                                        <i class="fa fa-edit fa-fw"></i>
                                                    </button>
                                                    <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa công văn">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php  $dem++;  @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="tab-pane" id="loai_cv_{{ $jtem->ID }}">
                           <table class="table table-bordered table-hover" id="tblData_{{ $jtem->ID }}">
                               <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Số công văn</th>
                                        <th class="text-center">Nơi gửi / ngày gửi</th>
                                        <th class="text-center">Nội dung</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Tờ số</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php  $dem = 1;  @endphp
                                     @foreach ($lstCongVan as $item)
                                        @if($item->LoaiCV_ID === $jtem->ID)
                                            <tr>
                                                <td class="text-center">{{ $dem }}</td>
                                                <td class="text-center">{{ $item->SoCV }}</td>
                                                <td class="text-center">{{ $item->NgayGui }}</td>
                                                <td class="text-center">{{ $item->NoiDung }}</td>
                                                <td class="text-center">{{ $item->GhiChu }}</td>
                                                <td class="text-center">{{ $item->ToSo }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật công văn">
                                                        <i class="fa fa-edit fa-fw"></i>
                                                    </button>
                                                    <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa công văn">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php  $dem++;  @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                <?php $i++; ?>
                @endforeach
             
          </div>

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
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Cập nhật công văn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/cong-van/update" enctype = "multipart/form-data" method="Post" id="frmEdit">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Số công văn:</label>
                        <input type="text" name="SoCV" id="SoCV" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Ngày gửi:</label>
                        <input type="date" name="NgayGui" id="NgayGui" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="recipient-name" class="col-form-label">Tờ số:</label>
                        <input type="text" name="ToSo" id="ToSo" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Nội dung:</label>
                        <textarea class="form-control" name="NoiDung" id="NoiDung" rows="4"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Loại công văn:</label>
                        <select name="LoaiCV_ID" id="LoaiCV_ID" class="form-control">
                           @foreach($lstLoaiCV as $item)
                           <option value="{{ $item->ID }}">{{ $item->TenLoai }}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group col-md-12">
                        <label for="recipient-name" class="col-form-label">Ghi chú:</label>
                        <input type="text" name="GhiChu" id="GhiChu" class="form-control">
                    </div>
                    <div class="form-group col-md-12 text-center">
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

            @foreach($lstLoaiCV as $jtem)
                $('#tblData_{{ $jtem->ID }}').DataTable({       
                    // scrollX:        true,
                    // scrollCollapse: true,
                    // autoWidth:         true,  
                    // paging:         true,       
                    columnDefs: [
                        { "width": "100px", "targets": [1,2] },       
                        { "width": "350px", "targets": [3] }
                    ]
                });
            @endforeach
            
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
                language: 'vi'
            });

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);

            $('#filter_year').change(function(){

                var value = this.value;
                window.location.href = "/cong-van/danh-sach/" + value; 

            });

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
                    url: '/cong-van/delete/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                        PNotify.success({
                            title: 'THÔNG BÁO!!',
                            text: 'Xóa công văn thành công.'
                        });
                        window.location.href = "/cong-van/danh-sach.html";
                        
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
                    url: "/cong-van/getByID/" + ID,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                        // var ngaygui = formatDate_VN(res.query.NgayGui.replace("\\"));
                        $('#SoCV').val(res.query.SoCV);
                        $('select#LoaiCV_ID').val(res.query.LoaiCV_ID);
                        $('#ToSo').val(res.query.ToSo);
                        $('#NoiDung').val(res.query.NoiDung);
                        $('#GhiChu').val(res.query.GhiChu);
                        $('#NgayGui').val(res.query.NgayGui);
                        $('#ID').val(res.query.ID);

                        // console.log(res.query.NgayGui.replace("\\"));
                        // console.log(ngaygui);
                    }
                });
            });
            
        });

        function formatDate_VN(date) {
            var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
            console.log(new Date(date));
            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }
    </script>
    @endsection