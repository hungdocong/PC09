@extends('layout._layout')

@section('title', 'Thêm mới cán bộ')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thêm cán bộ
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
			<li><a href="/can-bo/them-moi.html">Danh sách cán bộ</a></li>
            <li class="active">Thêm mới</li>
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
						<h3 class="box-title">Thêm cán bộ</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="/can-bo/add.html" method="post" id="frmValidate" enctype="multipart/form-data">
						 {{ csrf_field() }}
						<div class="box-body">
							<div class="form-group col-md-3">
								<label for="HoTen">Họ và tên</label>
								<input type="text" class="form-control" name="HoTen" placeholder="Nhập họ và tên..." required>
							</div>
							<div class="form-group col-md-3">
								<label for="NgaySinh">Ngày sinh</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="NgaySinh" required/>
                                </div>
							</div>
							<div class="form-group col-md-3">
								<label for="GioiTinh">Giới tính</label>
                                <select name="GioiTinh" class="form-control">
                                    <option value="Nam" selected>Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
							</div>
							<div class="form-group col-md-3">
                                <label for="DanToc">Dân tộc</label>
                                <input type="text" class="form-control" name="DanToc" placeholder="Nhập dân tộc..." required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" name="DiaChi" placeholder="Nhập địa chỉ..." required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="Sdt">Số điện thoại</label>
                                <input type="text" class="form-control" name="Sdt" placeholder="Nhập số điện thoại..." required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="SoHieu_CAND">Số hiệu CAND</label>
                                <input type="text" class="form-control" name="SoHieu_CAND" placeholder="Nhập số hiệu CAND..." >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="QueQuan">Quê quán</label>
                                <input type="text" class="form-control" name="QueQuan" placeholder="Nhập quên quán..." required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="CapBac">Cấp bậc</label>
                                <input type="text" class="form-control" name="CapBac" placeholder="Nhập cấp bậc..." required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="ChucVu">Chức vụ</label>
                                <select name="ChucVu" class="form-control">
                                    <option value="">---Chọn chức vụ---</option>
                                    <option value="Cán bộ" selected>Cán bộ</option>
                                    <option value="Đội Trưởng">Đội Trưởng</option>
                                    <option value="Phó Đội Trưởng">Phó Đội Trưởng</option>
                                    <option value="Phó Trưởng Phòng">Phó Trưởng Phòng</option>
                                    <option value="Trưởng Phòng">Trưởng Phòng</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ChucDanh">Chức danh</label>
                                <select name="ChucDanh" class="form-control">
                                    <option value="GĐV" selected>Giám định viên</option>
                                    <option value="TLGĐV">Trợ lý giám định</option>
                                    <option value="KTV">Kỹ thuật viên</option>
                                    <option value="KNHT">Khám nghiệm hiện trường</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="LanhDao">Lãnh đạo</label>
                                <select name="LanhDao" id="Lanh_Dao" class="form-control">
                                    <option value="Không" selected>Không</option>
                                    <option value="Phòng">Phòng</option>
                                    <option value="Đội">Đội</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Doi_ID">Thuộc đội</label>
                                <select name="Doi_ID" class="form-control">
                                    <option value="">---Chọn đội---</option>
                                    @foreach($doi as $item)
                                        <option value="{{ $item->ID }}">{{ $item->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="QuyHoach">Quy hoạch</label>
                                <input type="text" class="form-control" name="QuyHoach" placeholder="Nhập quy hoạch chức danh...">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="TrinhDo_VH">Trình độ văn hóa</label>
                                <input type="text" class="form-control" name="TrinhDo_VH" placeholder="Nhập trình độ văn hóa..." >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="NgayVao_CA">Ngày vào Công an</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="NgayVao_CA" />
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="NgayVao_Dang">Ngày vào đảng</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="NgayVao_Dang" />
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ChinhThuc_Dang">Ngày chính thức (đảng)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="ChinhThuc_Dang" />
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="NgayNhan_CT">Ngày nhận công tác</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="NgayNhan_CT" />
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="GhiChu">Ghi chú</label>
                                <textarea class="form-control" rows="4" name="GhiChu"></textarea>
                            </div>
						</div><!-- /.box-body -->
                        <div class="box-body">
                            <h3 class="box-title">Trình độ</h3>
                            <div class="form-group col-md-4">
                                <label for="NghiepVu_CA">Nghiệp vụ Công an</label>
                                <input type="text" class="form-control" name="NghiepVu_CA" placeholder="Nhập trình độ nghiệp vụ công an...">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="TN_NganhNgoai">Tốt nghiệp ngành ngoài</label>
                                <input type="text" class="form-control" name="TN_NganhNgoai" placeholder="Nhập trình độ nghành ngoài...">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="LyLuan_CT">Lý luận chính trị</label>
                                <input type="text" class="form-control" name="LyLuan_CT" placeholder="Nhập trình độ lý luận chính trị...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="NgoaiNgu">Ngoại ngữ</label>
                                <input type="text" class="form-control" name="NgoaiNgu" placeholder="Nhập trình độ ngoại ngữ...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="TinHoc">Tin học</label>
                                <input type="text" class="form-control" name="TinHoc" placeholder="Nhập trình độ tin học...">
                            </div>
                            
                        </div>
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary btn-lg">Thêm mới</button>
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
                console.log(this.value);
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
                                var str = '<option value="' + item.ID +'">'+ item.Ten +'</option>'
                                $('select[name="Doi_ID"]').append(str);
                            });
                            
                        }
                    })
                }
            });
        });


    </script>
    
@endsection
