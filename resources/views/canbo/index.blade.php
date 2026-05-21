@extends('layout._layout')

@section('title', 'Quản lý cán bộ')


@section('content')
@php  $dem = 1; $stt = 1;$stt_doi = 1;  @endphp
<div style="display: none;"></div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Danh sách cán bộ
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
			<li class="active">Danh sách cán bộ</li>
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
				<a href="/can-bo/them-moi.html" class="btn btn-lg btn-primary">Thêm mới</a>
			</div>
		</div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  {{-- <h3 class="box-title">Danh sách cán bộ</h3> --}}
                </div><!-- /.box-header -->
                <div class="box-body">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#All" data-toggle="tab">Danh sách chung</a></li>
                          <li><a href="#Doi" data-toggle="tab">Danh sách đội</a></li>
                        </ul>
                          <div class="tab-content">
                              <div class="tab-pane active" id="All">
                                <table class="table table-bordered table-hover">
                                     <thead>
                                          <tr>
                                            <th rowspan="2" class="text-center">TT</th>
                                            <th rowspan="2" class="text-center" width="15%">Họ và tên</th>
                                            <th rowspan="2" class="text-center">Năm sinh</th>
                                            <th rowspan="2" class="text-center">Dân tộc</th>
                                            <th rowspan="2" class="text-center">Nam / Nữ</th>
                                            <th rowspan="2" class="text-center" width="10%">Quê quán</th>
                                            <th rowspan="2" class="text-center">Cập bậc / chức vụ</th>
                                            {{-- <th colspan="5" class="text-center">Trình độ</th>
                                            <th rowspan="2" class="text-center">Chức danh quy hoạch</th>
                                            <th rowspan="2" class="text-center">Thời gian công tác tại CAH</th>
                                            <th rowspan="2" class="text-center">Ghi chú</th> --}}
                                        </tr>
                                        {{-- <tr>
                                            <th class="text-center">Nghiệp vụ công an</th>
                                            <th class="text-center">Tốt nghiệp ngành ngoài</th>
                                            <th class="text-center">Lý luận chính trị</th>
                                            <th class="text-center">Ngoại ngữ</th>
                                            <th class="text-center">Tin học</th>
                                        </tr> --}}
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-uppercase" style="font-weight: bold;" colspan="15">
                                                {{ $stt }}. Lãnh đạo đơn vị
                                            </td>
                                        </tr>
                                        
                                        @foreach ($lanh_dao as $item)
                                            <tr class="ToolEdit" data-name="{{ $item->HoTen }}" data-id="{{ $item->ID }}">
                                                <td class="text-center">{{ $dem }}</td>
                                                <td class="text-center">{{ $item->HoTen }}</td>
                                                <td class="text-center">{{ $item->NgaySinh }}</td>
                                                <td class="text-center">{{ $item->DanToc }}</td>
                                                <td class="text-center">{{ $item->GioiTinh }}</td>
                                                <td class="text-center">{{ $item->QueQuan }}</td>
                                                <td class="text-center">{{ $item->CapBac }}, {{ $item->ChucVu }}</td>

                                                {{-- @foreach($trinh_do as $jtem)
                                                    @if($jtem->CanBo_ID === $item->ID)
                                                        <td class="text-center">{{ $jtem->NghiepVu_CA }}</td>
                                                        <td class="text-center">{{ $jtem->TN_NganhNgoai }}</td>
                                                        <td class="text-center">{{ $jtem->LyLuan_CT }}</td>
                                                        <td class="text-center">{{ $jtem->NgoaiNgu }}</td>
                                                        <td class="text-center">{{ $jtem->TinHoc }}</td>
                                                    @endif
                                                @endforeach

                                                <td class="text-center">{{ $item->QuyHoach }}</td>
                                                <td class="text-center">{{ $item->CongTac_CAH }}</td>
                                                <td class="text-center">{{ $item->GhiChu }}</td> --}}
                                            </tr>
                                        @php  $dem++;  @endphp
                                        @endforeach

                                        @php  $stt++;  @endphp
                                        @foreach($doi as $ktem)
                                            
                                            <tr>
                                                <td class="text-uppercase" style="font-weight: bold;"  colspan="15">
                                                    {{ $stt }}. {{ $ktem->Ten }}
                                                </td>
                                            </tr>
                                            @php $dem = 1;  @endphp
                                            @foreach ($lstcan_bo as $item)
                                                @if($item->Doi_ID == $ktem->ID)
                                                    <tr class="ToolEdit" data-name="{{ $item->HoTen }}" data-id="{{ $item->ID }}">
                                                        <td class="text-center">{{ $dem }}</td>
                                                        <td class="text-center">{{ $item->HoTen }}</td>
                                                        <td class="text-center">{{ $item->NgaySinh }}</td>
                                                        <td class="text-center">{{ $item->DanToc }}</td>
                                                        <td class="text-center">{{ $item->GioiTinh }}</td>
                                                        <td class="text-center">{{ $item->QueQuan }}</td>
                                                        <td class="text-center">{{ $item->CapBac }}, {{ $item->ChucVu }}</td>

                                                        {{-- @foreach($trinh_do as $jtem)
                                                            @if($jtem->CanBo_ID === $item->ID)
                                                                <td class="text-center">{{ $jtem->NghiepVu_CA }}</td>
                                                                <td class="text-center">{{ $jtem->TN_NganhNgoai }}</td>
                                                                <td class="text-center">{{ $jtem->LyLuan_CT }}</td>
                                                                <td class="text-center">{{ $jtem->NgoaiNgu }}</td>
                                                                <td class="text-center">{{ $jtem->TinHoc }}</td>
                                                            @endif
                                                        @endforeach 

                                                        <td class="text-center">{{ $item->QuyHoach }}</td>
                                                        <td class="text-center">{{ $item->CongTac_CAH }}</td>
                                                        <td class="text-center">{{ $item->GhiChu }}</td>--}}

                                                   </tr>
                                                   @php  $dem++;  @endphp
                                                @endif
                                                
                                            @endforeach
                                            @php  $stt++ @endphp
                                        @endforeach
                                    </tbody>
                                 </table>
                                </div><!-- /.tab-pane -->
                              <div class="tab-pane" id="Doi">
                                 <table class="table table-bordered table-hover">
                                   <thead>
                                          <tr>
                                            <th rowspan="2" class="text-center">TT</th>
                                            <th rowspan="2" class="text-center" width="15%">Họ và tên</th>
                                            <th rowspan="2" class="text-center">Ngày tháng năm sinh</th>
                                            <th rowspan="2" class="text-center">Dân tộc</th>
                                            <th rowspan="2" class="text-center">Nam / Nữ</th>
                                            <th rowspan="2" class="text-center" width="10%">Quê quán</th>
                                            <th rowspan="2" class="text-center">Cập bậc / chức vụ</th>
                                           {{--  <th colspan="5" class="text-center">Trình độ</th>
                                            <th rowspan="2" class="text-center">Chức danh quy hoạch</th>
                                            <th rowspan="2" class="text-center">Thời gian công tác tại CAH</th>
                                            <th rowspan="2" class="text-center">Ghi chú</th> --}}
                                        </tr>
                                        {{-- <tr>
                                            <th class="text-center">Nghiệp vụ công an</th>
                                            <th class="text-center">Tốt nghiệp ngành ngoài</th>
                                            <th class="text-center">Lý luận chính trị</th>
                                            <th class="text-center">Ngoại ngữ</th>
                                            <th class="text-center">Tin học</th>
                                        </tr> --}}
                                    </thead>
                                <tbody>
                                        @php  $stt = 1 @endphp
                                        @foreach($doi as $ktem)
                                            <tr>
                                                <td class="text-uppercase" style="font-weight: bold;"  colspan="15">
                                                    {{ $stt }}. {{ $ktem->Ten }} 
                                                </td>
                                            </tr>
                                            @php $dem = 1;  @endphp
                                            @foreach ($lstcan_bo as $item)
                                                @if($item->Doi_ID == $ktem->ID)
                                                    <tr class="ToolEdit" data-name="{{ $item->HoTen }}" data-id="{{ $item->ID }}">
                                                        <td class="text-center">{{ $dem }}</td>
                                                        <td class="text-center">{{ $item->HoTen }}</td>
                                                        <td class="text-center">{{ $item->NgaySinh }}</td>
                                                        <td class="text-center">{{ $item->DanToc }}</td>
                                                        <td class="text-center">{{ $item->GioiTinh }}</td>
                                                        <td class="text-center">{{ $item->QueQuan }}</td>
                                                        <td class="text-center">{{ $item->CapBac }}, {{ $item->ChucVu }}</td>

                                                        {{-- @foreach($trinh_do as $jtem)
                                                            @if($jtem->CanBo_ID === $item->ID)
                                                                <td class="text-center">{{ $jtem->NghiepVu_CA }}</td>
                                                                <td class="text-center">{{ $jtem->TN_NganhNgoai }}</td>
                                                                <td class="text-center">{{ $jtem->LyLuan_CT }}</td>
                                                                <td class="text-center">{{ $jtem->NgoaiNgu }}</td>
                                                                <td class="text-center">{{ $jtem->TinHoc }}</td>
                                                            @endif
                                                        @endforeach

                                                        <td class="text-center">{{ $item->QuyHoach }}</td>
                                                        <td class="text-center">{{ $item->CongTac_CAH }}</td>
                                                        <td class="text-center">{{ $item->GhiChu }}</td> --}}
                                                   </tr>
                                                   @php  $dem++;  @endphp
                                                @endif
                                                
                                            @endforeach
                                            @php  $stt++;  @endphp
                                        @endforeach
                                    </tbody>
                                 </table>  
                              </div><!-- /.tab-pane -->
                          </div><!-- /.tab-content -->
                        </div>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade toolEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Chọn thao tác với cán bộ: <b id="HoTen"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group col-md-4">
                        <a class="btn btn-success btnInfo"><i class="fa fa-info fa-fw"></i> Xem thông tin</a>
                    </div>

                    <div class="form-group col-md-4">
                        <a class="btn btn-primary btnEdit"><i class="fa fa-edit fa-fw"></i> Cập nhật thông tin</a>
                   </div>
                   <div class="form-group col-md-4">
                        <button type="button" class="btn btn-danger btnDelete"><i class="fa fa-remove fa-fw"></i>Xóa cán bộ</button>
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

            $("#tblData").DataTable();

            $('.btnDelete').off('click').on('click', function () {
                $('#toolEdit').modal('hide');
                var ID = $(this).data('id');
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
                        url: '/can-bo/xoa/' + ID,
                        dataType: 'Json',
                        type: 'GET',
                        success: function () {
                        	PNotify.success({
                        		title: 'THÔNG BÁO!!',
                        		text: 'Xóa cán bộ thành công.'
                        	});
                        	setTimeout(function(){ window.location.href = "/can-bo/danh-sach.html"; }, 3000);
                        	
                        }
                    })
                )
            });

            $('.ToolEdit').click(function(event) {
                $('.toolEdit').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                var Name = $(this).data('name');
                
                $('#HoTen').text(Name);

                $('.btnInfo').attr('href', '/can-bo/thong-tin/' + ID);
                $('.btnEdit').attr('href', '/can-bo/cap-nhat/' + ID);
                $('.btnDelete').attr('data-id', ID);
            });
        });
    </script>
@endsection
