@extends('layout._layout')

@section('title', 'Cập nhật cán bộ')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Cập nhật cán bộ
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
			<li><a href="/can-bo/danh-sach.html">Danh sách cán bộ</a></li>
            <li class="active">Cập nhật thông tin</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		@if (Session::get('message') != null)
			<div class="row">
				<div class="alert alert-danger text-center" id="AlertBox">
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
						<h3 class="box-title">Cập nhật cán bộ</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="/can-bo/edit.html" method="post" id="frmValidate" enctype="multipart/form-data">
						 {{ csrf_field() }}
                         <input type="hidden" value="{{ $canbo->ID }}" name="ID">
						<div class="box-body">
							<div class="form-group col-md-3">
								<label for="HoTen">Họ và tên</label>
								<input type="text" class="form-control" value="{{ $canbo->HoTen }}" name="HoTen" placeholder="Nhập họ và tên..." required>
							</div>
							<div class="form-group col-md-3">
								<label for="NgaySinh">Ngày sinh</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text"  value="{{ $canbo->NgaySinh }}" class="form-control datepicker" name="NgaySinh" required/>
                                </div>
							</div>
							<div class="form-group col-md-3">
								<label for="GioiTinh">Giới tính</label>
                                <select name="GioiTinh" class="form-control">
                                    <option value="Nam" {{ $canbo->GioiTinh == "Nam" ? "selected" : ""}}>Nam</option>
                                    <option value="Nữ" {{ $canbo->GioiTinh == "Nữ" ? "selected" : ""}}>Nữ</option>
                                </select>
							</div>
							<div class="form-group col-md-3">
                                <label for="DanToc">Dân tộc</label>
                                <input type="text" class="form-control"  value="{{ $canbo->DanToc }}" name="DanToc" placeholder="Nhập dân tộc..." required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" name="DiaChi" value="{{ $canbo->DiaChi }}" placeholder="Nhập địa chỉ..." >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="Sdt">Số điện thoại</label>
                                <input type="text" class="form-control" name="Sdt" value="{{ $canbo->Sdt }}" placeholder="Nhập số điện thoại...">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="SoHieu_CAND">Số hiệu CAND</label>
                                <input type="text" class="form-control"  value="{{ $canbo->SoHieu_CAND }}" name="SoHieu_CAND" placeholder="Nhập số hiệu CAND..." >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="QueQuan">Quê quán</label>
                                <input type="text" class="form-control"  value="{{ $canbo->QueQuan }}" name="QueQuan" placeholder="Nhập quên quán..." required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="CapBac">Cấp bậc</label>
                                <input type="text" class="form-control"  value="{{ $canbo->CapBac }}" name="CapBac" placeholder="Nhập cấp bậc..." required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ChucVu">Chức vụ</label>
                                <select name="ChucVu" class="form-control">
                                    <option value="">---Chọn chức vụ---</option>
                                    <option value="Cán bộ"  {{ $canbo->ChucVu == "Cán bộ" ? "selected" : ""}}>Cán bộ</option>
                                    <option value="Đội Trưởng" {{ $canbo->ChucVu == "Đội Trưởng" ? "selected" : ""}}>Đội Trưởng</option>
                                    <option value="Phó Đội Trưởng" {{ $canbo->ChucVu == "Phó Đội Trưởng" ? "selected" : ""}}>Phó Đội Trưởng</option>
                                    <option value="Phó Trưởng Phòng" {{ $canbo->ChucVu == "Phó Trưởng Phòng" ? "selected" : ""}}>Phó Trưởng Phòng</option>
                                    <option value="Trưởng Phòng" {{ $canbo->ChucVu == "Trưởng Phòng" ? "selected" : ""}}>Trưởng Phòng</option>
                                </select>
                                {{-- <input type="text" class="form-control"  value="{{ $canbo->ChucVu }}" name="ChucVu" placeholder="Nhập chức vụ..." required> --}}
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ChucDanh">Chức danh</label>
                                <select name="ChucDanh" class="form-control">
                                    <option value="GĐV" {{ $canbo->ChucDanh == "GĐV" ? "selected" : ""}}>Giám định viên</option>
                                    <option value="TLGĐV" {{ $canbo->ChucDanh == "TLGĐV" ? "selected" : ""}}>Trợ lý giám định</option>
                                    <option value="KTV" {{ $canbo->ChucDanh == "KTV" ? "selected" : ""}}>Kỹ thuật viên</option>
                                    <option value="KNHT" {{ $canbo->ChucDanh == "KNHT" ? "selected" : ""}}>Khám nghiệm hiện trường</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="LanhDao">Lãnh đạo</label>
                                <select name="LanhDao" class="form-control">
                                    <option value="Không" {{ $canbo->LanhDao == "Không" ? "selected" : "" }}>Không</option>
                                    <option value="Phòng" {{ $canbo->LanhDao == "Phòng" ? "selected" : "" }}>Phòng</option>
                                    <option value="Đội" {{ $canbo->LanhDao == "Đội" ? "selected" : "" }}>Đội</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Doi_ID">Thuộc đội</label>
                                <select name="Doi_ID" class="form-control">
                                    <option value="">---Chọn đội---</option>
                                    @if($canbo->LanhDao != "Phòng")
                                        @foreach($doi as $item)
                                            <option value="{{ $item->ID }}" {{ $canbo->Doi_ID == $item->ID ? "selected" : "" }}>{{ $item->Ten }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="QuyHoach">Quy hoạch</label>
                                <input type="text" class="form-control"  value="{{ $canbo->QuyHoach }}" name="QuyHoach" placeholder="Nhập quy hoạch chức danh...">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="TrinhDo_VH">Trình độ văn hóa</label>
                                <input type="text" class="form-control"  value="{{ $canbo->TrinhDo_VH }}" name="TrinhDo_VH" placeholder="Nhập trình độ văn hóa..." >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="NgayVao_CA">Ngày vào Công an</label>
                                <input type="text" class="form-control datepicker"  value="{{ $canbo->NgayVao_CA }}" name="NgayVao_CA" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="NgayVao_Dang">Ngày vào đảng</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker"  value="{{ $canbo->NgayVao_Dang }}" name="NgayVao_Dang" />
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ChinhThuc_Dang">Ngày chính thức (đảng)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker"  value="{{ $canbo->ChinhThuc_Dang }}" name="ChinhThuc_Dang" />
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="NgayNhan_CT">Ngày nhận công tác</label>
                                <input type="text" class="form-control datepicker"  value="{{ $canbo->NgayNhan_CT }}" name="NgayNhan_CT" />
                            </div>

                            <div class="form-group col-md-12">
                                <label for="GhiChu">Ghi chú</label>
                                <textarea class="form-control" rows="4" name="GhiChu">{{ $canbo->GhiChu }}</textarea>
                            </div>
                            
						</div><!-- /.box-body -->
                        <div class="box-body">
                            <h3 class="box-title">Trình độ</h3>
                            <div class="form-group col-md-4">
                                <label for="NghiepVu_CA">Nghiệp vụ Công an</label>
                                <input type="text" class="form-control"  value="{{ $trinh_do->NghiepVu_CA }}" name="NghiepVu_CA" placeholder="Nhập trình độ nghiệp vụ công an...">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="TN_NganhNgoai">Tốt nghiệp ngành ngoài</label>
                                <input type="text" class="form-control"  value="{{ $trinh_do->TN_NganhNgoai  }}" name="TN_NganhNgoai" placeholder="Nhập trình độ nghành ngoài...">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="LyLuan_CT">Lý luận chính trị</label>
                                <input type="text" class="form-control"  value="{{ $trinh_do->LyLuan_CT }}" name="LyLuan_CT" placeholder="Nhập trình độ lý luận chính trị...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="NgoaiNgu">Ngoại ngữ</label>
                                <input type="text" class="form-control"  value="{{ $trinh_do->NgoaiNgu }}" name="NgoaiNgu" placeholder="Nhập trình độ ngoại ngữ...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="TinHoc">Tin học</label>
                                <input type="text" class="form-control"  value="{{ $trinh_do->TinHoc }}" name="TinHoc" placeholder="Nhập trình độ tin học...">
                            </div>
                            
                        </div>
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
						</div>
					</form>
				</div><!-- /.box -->

			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

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
            $('#reservation').daterangepicker();
        	 //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(3000).slideUp(500);


            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");

            jQuery.validator.addMethod("validate_cand", function (value, element) {
              if (/^([0-9])+([0-9])\b/g.test(value)) {
                 return true;
             } else {
                 return false;
             };
         }, "Invalid Id police number");

            jQuery.validator.addMethod("phonenu", function (value, element) {
                if (/^(09[0-9]|07[0|6|7|8|9]|03[2-9]|08[1-5])+([0-9]{7})\b/g.test(value)) {
                    return true;
                } else {
                    return false;
                };
            }, "Invalid phone number");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmValidate").validate({
                rules: {
                    HoTen: "required",
                    NgaySinh: "required",
                    DanToc: "required",
                    GioiTinh: "required",
                    QueQuan: "required",
                    ChucVu: { select_validate: "" },
                    Sdt: { 
                        required: true,
                        phonenu: "" 
                    },
                    CapBac: "required",
                    // NgayVao_CA: "required",
                    // NgayNhan_CT: "required",
                    // SoHieu_CAND: {
                    //     validate_cand: true
                    // }
                },
                messages: {
                    HoTen: "Vui lòng nhập họ và tên",
                    NgaySinh: "Vui lòng  nhập ngày sinh",
                    DanToc: "Vui lòng nhập dân tộc",
                    GioiTinh: "Vui lòng chọn giới tính",
                    QueQuan: "Vui lòng nhập quên quán",
                    ChucVu: { select_validate: "Bạn chưa chức vụ cán bộ." },
                    // TrinhDo_VH: "Vui lòng nhập trình độ văn hóa",
                    CapBac: "Vui lòng nhập cấp bậc và chức vụ",
                    // NgayVao_CA: "Vui lòng  nhập ngày vào ngành",
                    // NgayNhan_CT: "Vui lòng chọn ngày nhận công tác",
                    Sdt: {
                         required: "Vui lòng nhập số điện thoại.",
                         phonenu: "Số điện thoại không hợp lệ."
                    }
                },
                errorClass: "is-invalid",
                validClass: "is-valid",

                errorElement: "span",

                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group, .col-sm-10, .col-sm-4").append(error);
                },

                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },

                unhighlight: function(element) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $('select[name="LanhDao"]').change(function(){
                var value = this.value;
                if(value == "Phòng"){
                    $('select[name="Doi_ID"]').empty();
                    $('select[name="Doi_ID"]').append('<option value="">---Chọn đội---</option>');
                }else{
                    $('select[name="Doi_ID"]').empty();
                    $.ajax({
                        data: {},
                        url: '/can-bo/list-doi.html',
                        dataType: 'Json',
                        type: 'GET',
                        success: function (res) {
                            $.each(res.query, function (i, item) {
                                var str = '<option value="' + item.ID +'">'+ item.Ten +'</option>';
                                $('select[name="Doi_ID"]').append(str);
                            });
                            
                        }
                    })
                }
            });
        });


    </script>
    
@endsection
