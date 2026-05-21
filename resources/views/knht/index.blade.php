@extends('layout._layout')

@section('title', 'Danh sách vụ việc')


@section('content')

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Khám nghiệm hiện trường
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-newspaper-o"></i> Khám nghiệm hiện trường</a></li>
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
            <div class="col-md-2">
              <div class="box box-success text-center">
                <div class="box-header with-border">
                    <h4 class="box-title">Thêm mới</h4>
                  </div>
                <div class="box-body no-padding" style="margin-top: 10px;">
                 {{--  <a class="btn btn-app" href="javascript:void(0);" data-toggle="modal" data-target="#Add_GD">
                    <i class="fa fa-file-photo-o"></i> Giám định
                  </a> --}}
                  <a class="btn btn-app" href="javascript:void(0);" data-toggle="modal" data-target="#Add_KNHT">
                    <i class="fa fa-arrows"></i> Khám nghiệm hiện trường
                  </a>
                  <a class="btn btn-app" href="javascript:void(0);" data-toggle="modal" data-target="#Add_SK">
                    <i class="fa fa-bullhorn"></i> Sự kiện
                  </a>
                </div>
              </div>

              <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <h4 class="box-title">Chú thích</h4>
                  </div>
                <div class="box-body no-padding text-center">
                    {{-- <div class="external-event bg-red ui-draggable ui-draggable-handle" style="position: relative; text-align: center;">
                      Giám định
                    </div> --}}
                    <div class="external-event bg-yellow ui-draggable ui-draggable-handle" style="position: relative; text-align: center">
                      Khám nghiệm hiện trường
                    </div>
                    <div class="external-event bg-light-blue ui-draggable ui-draggable-handle" style="position: relative; text-align: center">
                      Ngày lễ
                    </div>
                    <div class="external-event bg-aqua ui-draggable ui-draggable-handle" style="position: relative; text-align: center">
                      Sự kiện
                    </div>
                </div>
              </div>
              <div class="box box-primary text-center">
                    <div class="box-header with-border">
                      <h4 class="box-title">Nhập file EXCEL vụ việc KNHT</h4>
                    </div>
                    <div class="box-body no-padding" style="margin-top: 10px; text-emphasis: center;">
                     {{--  <button type="button" data-toggle="modal" data-target="#importFile" class="btn btn-primary">
                        <i class="fa fa-download fa-fw"></i>Nhập file
                      </button> --}}
                      <a class="btn btn-app" href="javascript:void(0);" data-toggle="modal" data-target="#importFile">
                        <i class="fa fa-download"></i> Nhập file
                      </a>
                    </div>
              </div>
            </div>
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>


    <div id="Add_KNHT" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thêm mới vụ Khám nghiệm hiện trường</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/knht/add_knht" method="post" id="frmAdd">
                {{ csrf_field() }}
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>Tên vụ việc</label>
                      <textarea class="form-control" row="3" name="TenVuViec" placeholder="Nhập Tên vụ việc..." required></textarea>
                      <p class="help-block">Tên vụ việc.</p>
                    </div>
                    <div class="form-group">
                      <label >Ngày tiếp nhận</label>
                      <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control datepicker" name="NgayTiepNhan" placeholder="Ngày tiếp nhận..."required/>
                        <p class="help-block"></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>Địa điểm xảy ra vụ việc</label>
                      <textarea row="3" class="form-control" name="DiaDiem" placeholder="Nhập Địa điểm..." required></textarea>
                      <p class="help-block">Tại...</p>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Đơn vị trưng cầu:</label>
                      <input type="text" name="DonVi" class="form-control" list="DV_ID" placeholder="Chọn Đơn vị trưng cầu..." required />
                      <datalist id="DV_ID" >
                        <option value="">---Chọn Đơn vị trưng cầu---</option>
                        @foreach($lstDonVi as $item)
                        <option value="{{ $item->Ten }}"></option>
                        @endforeach
                      </datalist>
                    </div>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Nội dung vụ việc</label>
                    <textarea class="form-control" name="NoiDung" rows="8" required placeholder="Nhập nội dung vụ việc..."></textarea>
                  </div>
                  <div class="form-group col-xs-6">
                    <label>Cán bộ KNHT</label>
                    <select name="knht[]" id="KNHT_ID" class="form-control select2" multiple="multiple" required>
                        @foreach($ds_canbo as $item)
                          <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xs-6">
                    <label>Cán bộ pháp y (nếu có)</label>
                    <select name="py[]" id="PY_ID" class="form-control select2" multiple="multiple">
                        @foreach($ds_canbo as $item)
                          <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group text-center col-xs-12" style="margin-top: 50px;">
                  <button type="submit" class="btn btn-primary btn-lg">Thêm vụ việc</button>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer" style="border: none;">
              <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
     <div id="Add_SK" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thêm mới sự kiện</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/su-kien/frmAdd" class="form-horizontal calender" method="post" id="frmAdd">
                {{ csrf_field() }}
                  <div class="form-group col-md-12">
                    <label>Nội dung sự kiện</label>
                    <input type="text" class="form-control" name="NoiDung" required/>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Ngày bắt đầu</label>
                    <div class="input-group">
                      <input type="text" class="form-control datepicker" name="TuNgay" id="TuNgay" placeholder="Từ ngày..."required/>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Ngày kết thúc</label>
                    <div class="input-group">
                      <input type="text" class="form-control datepicker" name="DenNgay" id="DenNgay" placeholder="Đến ngày..."/>
                    </div>
                  </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2 btn-lg">Thêm sự kiện</button>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <div id="Edit_KNHT" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Cập nhật vụ Khám nghiệm hiện trường</h4>
          </div>
          <div class="modal-body">
            {{-- <div id="testmodal2" style="padding: 5px 20px;"> --}}
              <form action="/knht/edit_knht" method="post" id="frmAdd">
                {{ csrf_field() }}
                  <input type="hidden" name="ID">
                  <div class="form-group col-xs-6">
                    <div class="form-group">
                      <label>Tên vụ việc</label>
                      <textarea class="form-control" row="3" name="TenVuViec" placeholder="Nhập Tên vụ việc..." required></textarea>
                      <p class="help-block">Tên vụ việc.</p>
                    </div>
                    <div class="form-group">
                      <label >Ngày tiếp nhận</label>
                      <div class="input-group" style="width: 100%;">
                        <input type="text" class="form-control datepicker" name="NgayTiepNhan" placeholder="Ngày tiếp nhận..."required/>
                        <p class="help-block"></p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-xs-6">
                    <div class="form-group">
                      <label>Địa điểm xảy ra vụ việc</label>
                      <textarea row="3" class="form-control" name="DiaDiem" placeholder="Nhập Địa điểm..." required></textarea>
                      <p class="help-block">Tại...</p>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Đơn vị trưng cầu:</label>
                      <input type="text" name="DonVi" class="form-control" list="DV_ID" placeholder="Chọn Đơn vị trưng cầu..."/>
                      <datalist id="DV_ID" >
                        <option value="">---Chọn Đơn vị trưng cầu---</option>
                        @foreach($lstDonVi as $item)
                        <option value="{{ $item->Ten }}"></option>
                        @endforeach
                      </datalist>
                    </div>
                  </div>
                  <div class="form-group col-xs-12">
                    <label>Nội dung vụ việc</label>
                    <textarea class="form-control" name="NoiDung" id="ND_edit" rows="8" placeholder="Nhập nội dung vụ việc...">
                    </textarea>
                  </div>

                  <div class="form-group col-xs-6">
                    <label>Cán bộ KNHT</label>
                    <select name="knht[]" id="KNHT_ID_edit" class="form-control select2" multiple="multiple" required style="width: 100%">
                        @foreach($ds_canbo as $item)
                          <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group col-xs-6">
                    <label>Cán bộ pháp y (nếu có)</label>
                    <select name="py[]" id="PY_ID_edit" class="form-control select2" multiple="multiple" style="width: 100%">
                        @foreach($ds_canbo as $item)
                          <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group text-center col-xs-12" style="margin-top: 50px;">
                    <button type="submit" class="btn btn-primary btn-lg">Cập nhật vụ việc</button>
                  </div>
              </form>
            {{-- </div> --}}

            {{-- <div class="text-center">
              <form action="/bao-cao/ngay" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="Ngay">
                <button type="submit" class="btn btn-info text-left">Xuất báo cáo ngày</button>
              </form>
            </div> --}}
          </div>
          <div class="modal-footer" style="border: none;">
              <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <div id="Edit_SK" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Cập nhật sự kiện</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/su-kien/frmEdit" method="post" id="frmEdit">
                <input type="hidden" name="ID">
                {{ csrf_field() }}
                  <div class="form-group col-md-12">
                    <label>Nội dung sự kiện</label>
                    <input type="text" class="form-control" name="NoiDung" required/>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Ngày bắt đầu</label>
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control datepicker" name="TuNgay" placeholder="Từ ngày..."required/>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label >Ngày kết thúc</label>
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control datepicker" name="DenNgay" placeholder="Đến ngày..."/>
                    </div>
                  </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2 btn-lg">Cập nhật sự kiện</button>
                </div>
              </form>
            </div>

            {{-- <div class="text-center">
              <form action="/bao-cao/ngay" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="Ngay">
                <button type="submit" class="btn btn-info text-left">Xuất báo cáo ngày</button>
              </form>
            </div> --}}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>

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
                    <form action="/knht/FrmImport" enctype = "multipart/form-data" method="Post" id="frmImport">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12">
                          <label for="exampleInputFile">Chọn file</label>
                          <input type="file" name="File" id="exampleInputFile" accept=".xls, .xlsx, .csv" required>
                          <p class="help-block">Chọn file excel chứa vụ việc knht: .xls, .xlsx, .csv</p>
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
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js"></script>


     <script type="text/javascript">


        $(function () {

            var original1 = $('#KNHT_ID').html();
            var original2 = $('#PY_ID').html();
            $('#KNHT_ID, #PY_ID').select2();
            function refreshOptions() {
                var val1 = $('#KNHT_ID').val();
                var val2 = $('#PY_ID').val();

                // reset lại dữ liệu gốc
                $('#KNHT_ID').html(original1);
                $('#PY_ID').html(original2);

                // remove giá trị đã chọn bên kia
                if (val2) {
                    {{-- $("#KNHT_ID option[value='" + val2 + "']").remove(); --}}
                    val2.forEach(function(v){
                        $("#KNHT_ID option[value='" + v + "']").remove();
                    });
                }
                if (val1) {
                    {{-- $("#PY_ID option[value='" + val1 + "']").remove(); --}}
                    val1.forEach(function(v){
                        $("#PY_ID option[value='" + v + "']").remove();
                    });
                }

                // set lại value
                $('#KNHT_ID').val(val1);
                $('#PY_ID').val(val2);

                // update UI
                $('#KNHT_ID, #PY_ID').trigger('change.PY_ID');
            }

            // bắt sự kiện
            $('#KNHT_ID, #PY_ID').on('change', function () {
                refreshOptions();
            });

            var original3 = $('#KNHT_ID_edit').html();
            var original4 = $('#PY_ID').html();
            $('#KNHT_ID_edit, #PY_ID_edit').select2();
            function refreshOptions_edit() {
                var val1 = $('#KNHT_ID_edit').val();
                var val2 = $('#PY_ID_edit').val();

                // reset lại dữ liệu gốc
                $('#KNHT_ID_edit').html(original3);
                $('#PY_ID_edit').html(original4);

                // remove giá trị đã chọn bên kia
                if (val2) {
                    {{-- $("#KNHT_ID_edit option[value='" + val2 + "']").remove(); --}}
                    val2.forEach(function(v){
                        $("#KNHT_ID_edit option[value='" + v + "']").remove();
                    });
                }
                if (val1) {
                    {{-- $("#PY_ID_edit option[value='" + val1 + "']").remove(); --}}
                    val1.forEach(function(v){
                        $("#PY_ID_edit option[value='" + v + "']").remove();
                    });
                }

                // set lại value
                $('#KNHT_ID_edit').val(val1);
                $('#PY_ID_edit').val(val2);

                // update UI
                $('#KNHT_ID_edit, #PY_ID_edit').trigger('change.PY_ID_edit');
            }

            // bắt sự kiện
            $('#KNHT_ID_edit, #PY_ID_edit').on('change', function () {
                refreshOptions_edit();
            });


            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = (day) + "/" + (month) + "/" + now.getFullYear();
            $('#NgayTiepNhan').val(today);
            $('#NgayTC').val(today);

            $('.datepicker').datepicker({
              format: 'dd/mm/yyyy',
              autoclose: true,
              {{-- endDate: '+d', --}}
              todayHighlight: true,
              language: 'vi'
          });

            var TuNgay = $("input[name='TuNgay']").datepicker();
            var DenNgay = $("input[name='DenNgay']").datepicker();

            TuNgay.on('show', function (e) {
                if ($("#DenNgay").datepicker("getDate") != null) {
                 $("#TuNgay").data('datepicker').setEndDate($("#DenNgay").datepicker("getDate"));
                }
            });

            DenNgay.on('show', function (e) {
                if ($("#TuNgay").datepicker("getDate") != null) {
                    $("#DenNgay").data('datepicker').setStartDate($("#TuNgay").datepicker("getDate"));
                }
            });

            $(".select2").select2();
            $("span.select2").css("width", "100%");

            $('.datepicker-days').css('display', 'none');

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);

            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmAdd").validate({
                rules: {
                    CanBo_ID: { select_validate: "" },
                    LoaiVuViec_ID: { select_validate: "" }
                },
                messages: {
                    CanBo_ID: { select_validate: "Bạn chưa chọn cán bộ trực!" },
                    LoaiVuViec_ID: { select_validate: "Bạn chưa chọn lĩnh vực giám định!" },
                }
            });

             $('.LoaiVuViec').change(function(){
                var value = this.value;
                if(value == "Giám định"){
                  $('#GD').css("display", "block");
                  $('#KNHT').css("display", "none");
                  $('.antosubmit2').removeAttr("disabled");
                }else if(value == "Khám nghiệm"){
                  $('#GD').css("display", "none");
                  $('#KNHT').css("display", "block");
                  $('.antosubmit2').removeAttr("disabled");
                }else{
                  $('.antosubmit2').attr("disabled", "disabled");
                }

             });

            $('.LoaiVuViec_Edit').change(function(){
                var value = this.value;
                if(value == "Giám định"){
                  $('#GD_Edit').css("display", "block");
                  $('#KNHT_Edit').css("display", "none");
                }else{
                  $('#GD_Edit').css("display", "none");
                  $('#KNHT_Edit').css("display", "block");
                }

             });


        /* initialize the external events
        -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
          };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
          });

        });
      }
      ini_events($('#external-events div.external-event'));

        /* initialize the calendar
        -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

        $('#calendar').fullCalendar({
            customButtons: {
              addButton: {
                text: 'Thêm mới vụ việc',
                click: function() {
                  $('#Add').modal('show');
                }
              }
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Hôm nay',
                month: 'Tháng',
                week: 'Tuần',
                day: 'Ngày'
            },
            locale: 'vi',
            events: function(start, end, timezone, callback) {
                jQuery.ajax({
                    url: '/knht/getdata.html',
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    success: function(res) {
                        var events = []; var dem = 0;
                        // var color = ["#f56954", "#f39c12", "#00c0ef", "#0073b7", "#00a65a", "#3c8dBáo cáo", "#39cccc"];

                        var event = Date_Line();
                        $.each(event, function (i, item) {
                          {{-- console.log(formatDate(item.date)) --}}
                          events[dem] = {
                              title: item.title,
                              start: formatDate(item.date),
                              //type: item.type,
                              backgroundColor: "#3c8dbc",
                              borderColor: "#3c8dbc",
                              click: false
                          };
                          dem++;
                        });


                        $.each(res.lstKNHT, function (i, item) {
                            {{-- var datenow = new Date(); --}}
                            {{-- var date_truc = new Date(item.NgayTiepNhan);
                            var check = true; --}}

                            {{-- if(datenow.getTime() <= date_truc.getTime()){
                                check = false;
                            } --}}
                            // const random = Math.floor(Math.random() * color.length);
                            {{-- console.log(formatDate(item.NgayTiepNhan)) --}}
                            events[dem] = {
                              id_ld: item.ID,
                              title: item.TenVuViec + "-" + item.DonVi_TC,
                              start: formatDate(item.NgayTiepNhan),
                              {{-- canbo_id: item.CanBo_ID, --}}
                              donvi_tc: item.DonVi_TC,
                              dia_diem: item.DiaDiem,
                              tenvuviec: item.TenVuViec,
                              noidung: item.NoiDung,
                              {{-- so_cv: item.SoCV, --}}
                              backgroundColor: "#f39c12",
                              borderColor: "#f39c12",
                              {{-- present: check, --}}
                              type: "KNHT",
                              click: true
                          };
                          dem++;
                      })

                      $.each(res.lstSuKien, function (i, item) {
                          {{-- console.log(item.TuNgay);
                          console.log(item.DenNgay); --}}
                            events[dem] = {
                              id_ld: item.ID,
                              title: item.NoiDung,
                              start: formatDate(item.TuNgay),
                              end: formatDate_End(item.DenNgay),
                              backgroundColor: "#00c0ef",
                              borderColor: "#00c0ef",
                              type: "SK",
                              click: true
                          };
                          dem++;
                      });
                      callback(events);
                    }
                })
            },
            dayClick: function(date, jsEvent, view) {

               {{--  var datenow = new Date();
                var date_choose = new Date(date);
                var check = true;

                if(datenow.getTime() <= date_choose.getTime()){
                  check = false;
                }

                if(check){
                  $('#Add').modal('show');
                  $('input[name="Ngay"]').val(date);
                  // var html = "<span>Công tác ngày: <b>" + formatDate(date) + "</b></span>";
                  $('#date-content').empty();
                  $('#date-content').text(formatDate_VN(date, 0));

                  $('input[name="NgayTiepNhan"]').val(formatDate_VN(date, 0));
                } --}}
            },
            eventRender: function(event, element, view) {
              if(event.click){
                element.find(".fc-content").prepend("<span class='closeon pull-right'><i class='fa fa-close' title='Xóa'></i></span>");
                element.find(".closeon").on('click', function() {
                  var ID = event.id_ld;
                  var type = event.type;
                  const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa ' + event.title + ' này? ',
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
                      type: 'GET',
                      url: '/knht/delete/' + ID + '/' + type,
                      data: {},
                      success: function () {
                        PNotify.success({
                          title: 'THÔNG BÁO!!',
                          text: 'Xóa thành công.'
                        });
                        $('#calendar').fullCalendar('removeEvents',event._id);
                                // console.log(event.id);
                           }
                        })
                    );
                });

                element.find(".fc-title").on('click', function() {

                  if(event.type == 'KNHT'){
                     $('#Edit_KNHT').modal('show');
                     $('#Edit_KNHT input[name="ID"]').val(event.id_ld);
                     $('#Edit_KNHT textarea[name="TenVuViec"]').val(event.tenvuviec);
                     $('#Edit_KNHT input[name="NgayTiepNhan"]').val(formatDate_TuNgay(event.start));
                     $('#Edit_KNHT textarea[name="DiaDiem"]').val(event.dia_diem);
                     $('#Edit_KNHT input[name="DonVi"]').val(event.donvi_tc);
                     $('#ND_edit').text(event.noidung);
                     $.ajax({
                      type: 'GET',
                      url: '/knht/getPhuTrach_Knht/' + event.id_ld,
                      data: {},
                      success: function (res) {
                        var knht_canbo = [];
                        var py_canbo = [];
                        $.each(res.query, function(i, item){
                          if(item.ChucDanh == "KNHT"){
                            knht_canbo.push(item.CanBo_ID);
                          }
                          else{
                            py_canbo.push(item.CanBo_ID);
                          }
                        });
                        console.log(res.query);
                        $('#KNHT_ID_edit').select2().val(knht_canbo).trigger("change");
                        $('#PY_ID_edit').select2().val(py_canbo).trigger("change");
                      }
                   });
                  }else{
                     $('#Edit_SK').modal('show');
                     $('#Edit_SK input[name="ID"]').val(event.id_ld);
                     $('#Edit_SK input[name="NoiDung"]').val(event.title);
                     $('#Edit_SK input[name="TuNgay"]').val(formatDate_TuNgay(event.start));
                     $('#Edit_SK input[name="DenNgay"]').val(formatDate_DenNgay(event.end));
                  }
                });
              }
              {{-- else{
                 element.find(".fc-title").on('click', function() {
                    $('#BaoCao').modal('show');
                    $('#Bao_Cao').text(event.title);
                    $('input[name="Date"]').val(event.start);
                    if(event.type == "tuan"){
                      $('.baocao').attr('action','/bao-cao/tuan');
                      $('.baocao_print').attr('action','/bao-cao/tuan-xuatbc');

                    }else if(event.type == "thang"){
                      $('.baocao').attr('action','/bao-cao/thang');
                      $('.baocao_print').attr('action','/bao-cao/thang-xuatbc');
                    }else if(event.type == "quy"){
                      $('.baocao').attr('action','/bao-cao/quy');
                      $('.baocao_print').attr('action','/bao-cao/quy-xuatbc');
                    }else if(event.type == "6thang_dau"){
                      $('.baocao').attr('action','/bao-cao/6thang_dau');
                      $('.baocao_print').attr('action','/bao-cao/6thang_dau-xuatbc');
                    }else if(event.type == "6thang_cuoi"){
                      $('.baocao').attr('action','/bao-cao/6thang_cuoi');
                      $('.baocao_print').attr('action','/bao-cao/6thang_cuoi-xuatbc');
                    }else if(event.type == "nam"){
                      $('.baocao').attr('action','/bao-cao/nam');
                      $('.baocao_print').attr('action','/bao-cao/nam-xuatbc');
                    }
                  });
               } --}}
            },
            select: function(start, end, jsEvent, view) {    },
          editable: true,
          droppable: true,
          selectable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                  // if so, remove the element from the "Draggable Events" list
                  $(this).remove();
                }

            }
        });


    });

function formatDate(date) {
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + (d.getDate()),
    year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatDate_End(date) {
  var d = new Date(date);
  var day = '', month = '';
  if(checkDate(d.getMonth() + 1, d.getFullYear()) < (d.getDate() + 1))
    day += d.getDate();
  else
    day += (d.getDate() + 1);
  month += (d.getMonth() + 1);

  var year = d.getFullYear();
    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    return [year, month, day].join('-');
}

function formatDate_TuNgay(date) {
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

function formatDate_DenNgay(date) {
  var d = new Date(date),
  month = '' + (d.getMonth() + 1),
  day = '' + (d.getDate() - 1),
  year = d.getFullYear();
  if (month.length < 2)
    month = '0' + month;
  if (day.length < 2)
    day = '0' + day;
  return [day, month, year].join('/');


}

function checkDate(month, year) {

  switch (month) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
       return 31;
      break;
    case 4:
    case 6:
    case 9:
    case 11:
      return 30;
      break;
    case 2:
      if (isCheck(year)){
        return 29;
        break;
      }
      else{
        return 28;
        break;
      }

  }
}

function formatDate_VN(date, boss) {
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + (d.getDate() + boss),
    year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [day, month, year].join('-');
}

function Date_Line() {
  var d = new Date()
  var year = d.getFullYear();
  var event = [
    { date: year + "-01-01", title: "Tết dương lịch" },
    { date: year + "-04-30", title: "Ngày thống nhất đất nước" },
    { date: year + "-05-01", title: "Quốc tế lao động" },
    { date: year + "-08-19", title: "Thành lập CAND VN" },
    { date: year + "-08-23", title: "Thành lập LL Kỹ thuật hình sự" },
    { date: year + "-09-02", title: "Quốc khánh nước CHXHCH VN" },
    { date: year + "-12-22", title: "Thành lập QĐND VN" }
  ];


  {{-- var d = new Date();
  var year = d.getFullYear();
  var week = 0;
  for (var i = 1; i <= 12; i++) {
    var day = get_day_of_month(year, i);
    for (var j = 1; j <= day; j++) {
      var date = new Date(year + "-" + i + "-" + j);
      if (date.getDay() == 3) {
        week ++;
        var arr = [];
        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo tuần " + week;
        arr["type"] = "tuan";
        event.push(arr);
      }

      if(i == 6 && j == 15){
        var arr = [];
        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo 6 tháng đầu năm";
        arr["type"] = "6thang_dau";
        event.push(arr);

      }

      if(i == 12 && j == 15){
        var arr = [];
        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo 6 tháng cuối năm";
        arr["type"] = "6thang_cuoi";
        event.push(arr);

        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo năm " + year;
        arr["type"] = "nam";
        event.push(arr);
      }

      if(j == 16){

        var arr = [];
        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo tháng " + i;
        arr["type"] = "thang";
        event.push(arr);
      }
      if(i % 3 == 0 && j == 16){

        var arr = [];
        arr["date"] = year + "-" + i + "-" + j;
        arr["title"] = "Báo cáo quý " + (i/3);
        arr["type"] = "quy";
        event.push(arr);
      }

    }
  } --}}
   return event;
}


const get_day_of_month = (year, month) => {
    return new Date(year, month, 0).getDate();
};
    </script>

@endsection
