@extends('layout._layout')

@section('title', 'Thông tin cán bộ')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Thông tin cán bộ
		</h1>
		<ol class="breadcrumb">
			<li><a href="/can-bo/danh-sach.html"><i class="fa fa-users"></i>Danh sách cán bộ</a></li>
            <li class="active">Thông tin chi tiết cán bộ</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                            <div class="text-center">
                                @php
                                    $anh = '';
                                    if(!empty($canbo->Anh))
                                        $anh = $canbo->Anh;
                                    else
                                        $anh = 'default-avatar.png';
                                @endphp
                                <img  id="avatarPreview" class="profile-user-img img-fluid img-circle" src="{{asset('assets/img/canbo/' . $anh )}}" style="width: 150px; height: 150px; object-fit: cover;" >
                            </div>
                            <h3 class="profile-username text-center">{{ $canbo->HoTen }}</h3>
                            <p class="text-muted text-center">{{ $canbo->ChucVu }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Ngày sinh: </b> <a class="float-right">{{ $canbo->NgaySinh }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Cấp bậc: </b> <a class="float-right">{{ $canbo->CapBac }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Số hiệu CAND: </b> <a class="float-right">{{ $canbo->SoHieu_CAND }}</a>
                                </li>
                                
                            </ul>

                            <form id="uploadForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                  <input type="file" id="avatarInput" name="anh" accept="image/*" class="form-control" style="display: none;">
                                  <input type="hidden" name="CanBo_ID" value="{{ $canbo->ID }}">
                              </div>

                              <button class="btn btn-primary btn-block" type="submit" style="display: none;">
                                  <b>Cập nhật ảnh</b>
                              </button>

                              <button class="btn btn-primary btn-block" id="btn_avatar" type="button">
                                  <b>Chọn ảnh</b>
                              </button>
                            </form>
                        </div>
                    </div>
                      <!-- About Me Box -->
                      <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Thông Tin Cá Nhân</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fa fa-book fa-fw" style="margin-right: 10px;"></i> Trình độ</strong>
                            <p class="text-muted">{{ $canbo->TrinhDo_VH }}</p>
                            <hr>

                            <strong><i class="fa fa-location-arrow fa-fw" style="margin-right: 10px;"></i> Quê quán</strong>
                            <p class="text-muted">{{ $canbo->QueQuan }}</p>
                            <hr>

                            <strong><i class="fa fa-phone fa-fw" style="margin-right: 10px;"></i> Điện thoại</strong>
                            <p class="text-muted">0901 234 567</p>
                            <hr>
                            @php 
                                $chuc_danh = '';
                                if($canbo->ChucDanh == "GĐV")
                                    $chuc_danh = "Giám định viên";
                                else if($canbo->ChucDanh == "KTV")
                                    $chuc_danh = "Kỹ thuật viên";
                                else if($canbo->ChucDanh == "KNHT")
                                    $chuc_danh = "Khám nghiệm hiện trường";
                                else 
                                    $chuc_danh = "Trợ lý giám định";
                            @endphp
                            <strong><i class="fa fa-envelope fa-fw" style="margin-right: 10px;"></i> Chức danh</strong>
                            <p class="text-muted">{{ $chuc_danh }}</p>
                            <hr>

                            <strong><i class="fa fa-calendar fa-fw" style="margin-right: 10px;"></i> Ngày vào Ngành</strong>
                            <p class="text-muted">{{ $canbo->NgayVao_CA }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Họ và tên</label>
                                     <div class="col-sm-10">
                                        <input type="text" class="form-control" name="full_name" value="{{ $canbo->HoTen }}" readonly>
                                     </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ngày sinh</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="birth_date" value="{{ $canbo->NgaySinh }}" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Giới tính</label>
                                    <div class="col-sm-4">
                                         <input type="text" class="form-control" name="GioiTinh" value="{{ $canbo->GioiTinh }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Quê quán</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hometown" value="{{ $canbo->QueQuan }}" readonly>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="address" value="{{ $canbo->DiaChi }}" readonly>
                                  </div>
                                </div>

                              <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Điện thoại</label>
                                    <div class="col-sm-4">
                                      <input type="text" class="form-control" name="phone" value="{{ $canbo->Sdt }}" readonly>
                                  </div>

                                  <label class="col-sm-2 col-form-label">Dân tộc</label>
                                  <div class="col-sm-4">
                                      <input type="email" class="form-control" name="email" value="{{ $canbo->DanToc }}" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Chức vụ</label>
                                   <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ChucVu" value="{{ $canbo->ChucVu }}" readonly>
                                  </div>
                                  <label class="col-sm-2 col-form-label">Chức danh</label>
                                  <div class="col-sm-4">
                                        <input type="text" class="form-control" name="ChucVu" value="{{ $chuc_danh }}" readonly>
                                  </div>
                              </div>

                              
                                <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Lãnh đạo</label>
                                       <div class="col-sm-4">
                                            <input type="text" class="form-control" name="education" value="{{ $canbo->LanhDao }}" readonly>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Thuộc đội</label>
                                      <div class="col-sm-4">
                                          <select name="Doi_ID" class="form-control" readonly>
                                            @if($canbo->LanhDao != "Phòng")
                                                @foreach($doi as $item)
                                                    <option value="{{ $item->ID }}" {{ $canbo->Doi_ID == $item->ID ? "selected" : "" }}>{{ $item->Ten }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Không</option>
                                            @endif
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Quy hoạch</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $canbo->QuyHoach }}" readonly>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Ngày nhận công tác</label>
                                      <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $canbo->NgayNhan_CT }}" readonly/>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Ngày vào đảng</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $canbo->NgayVao_Dang }}" readonly/>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Ngày chính thức</label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control"  value="{{ $canbo->ChinhThuc_Dang }}" readonly/>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                        <h3 class="box-title">Trình độ</h3>
                                      <label class="col-sm-2 col-form-label">Nghiệp vụ Công an</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $trinh_do->NghiepVu_CA }}" readonly/>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Tốt nghiệp ngành ngoài</label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control"  value="{{ $trinh_do->TN_NganhNgoai }}" readonly/>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Lý luận chính trị</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $trinh_do->LyLuan_CT }}" readonly/>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Ngoại ngữ</label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control"  value="{{ $trinh_do->NgoaiNgu }}" readonly/>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Tin học</label>
                                       <div class="col-sm-4">
                                          <input type="text" class="form-control"  value="{{ $trinh_do->TinHoc }}" readonly/>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Trình độ văn hóa</label>
                                      <div class="col-sm-4">
                                          <input type="text" class="form-control" name="education" value="{{ $canbo->TrinhDo_VH }}" readonly>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Ghi chú</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" rows="4" name="note" readonly>{{ $canbo->GhiChu }}</textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row text-center">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="/can-bo/cap-nhat/{{ $canbo->ID }}" class="btn btn-primary btn-lg">Cập nhật thông tin cán bộ</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
           </div><!--/.col (left) -->
        </div>   <!-- /.row -->
        </div>
		
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('jsAdmin')

    <script type="text/javascript">

        $(function () {

            $('#btn_avatar').on('click', function (e) {
                $('#avatarInput').click();
                $('#avatarInput').off('click').on('change', function (event) {
                    const avatarPreview = document.getElementById('avatarPreview');
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                });

                $('button[type="submit"]').removeAttr('style');
                $(this).css('display', 'none');
            });
            $('#uploadForm').on('submit', function (e) {
                 e.preventDefault();
                formData = new FormData(this);
                console.log($('#avatarInput').val());
                $.ajax({
                    url: "/can-bo/upload/anh",
                    type: "POST",
                    data: formData,
                    processData: false,   // bắt buộc
                    contentType: false,   // bắt buộc
                    cache: false,
                    success: function (res) {
                        if(res.status == true){
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật ảnh thành công.'
                            });
                        }else{
                            PNotify.error({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật ảnh KHÔNG thành công.'
                            });
                        }
                    },

                    error: function (xhr) {
                        console.log(xhr.responseJSON);
                    }
                });

            });

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
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmValidate").validate({
                rules: {
                    HoTen: "readonly",
                    NgaySinh: "readonly",
                    DanToc: "readonly",
                    GioiTinh: "readonly",
                    QueQuan: "readonly",
                    ChucVu: { select_validate: "" },
                    // TrinhDo_VH: "readonly",
                    CapBac_ChucVu: "readonly",
                    // NgayVao_CA: "readonly",
                    // NgayNhan_CT: "readonly",
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
                    CapBac_ChucVu: "Vui lòng nhập cấp bậc và chức vụ",
                    // NgayVao_CA: "Vui lòng  nhập ngày vào ngành",
                    // NgayNhan_CT: "Vui lòng chọn ngày nhận công tác",
                    // SoHieu_CAND: {
                    //     validate_cand: "Số hiệu CAND không hợp lệ"
                    // }
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
