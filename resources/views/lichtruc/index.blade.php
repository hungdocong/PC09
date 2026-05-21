@extends('layout._layout')

@section('title', 'Danh sách lịch trực ban')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Danh sách lịch trực ban
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-folder"></i> Quản lý lịch trực ban</a></li>
            <li class="active">Danh sách</li>
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
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <div class="col-md-3" style="margin-top: 10px;">
                    <div class="external-event bg-red ui-draggable ui-draggable-handle" style="position: relative; text-align: center;">
                      Trực lãnh đạo
                    </div>
                    <div class="external-event bg-light-blue ui-draggable ui-draggable-handle" style="position: relative; text-align: center">
                      Cán bộ trực ban
                    </div>
                    <div class="external-event bg-yellow ui-draggable ui-draggable-handle" style="position: relative; text-align: center">
                      Cán bộ trực khám nghiệm
                    </div>
                  </div>
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="Truc_CB">Thay đổi, cập nhật lịch trực ban</h4>
            <br>
            <h5 class="modal-title text-center text-uppercase" >Ngày trực: <b id="NgayTruc"></b></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/update" class="form-horizontal calender" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ID" id="ID">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Cán bộ trực</label>
                  <div class="col-sm-9">
                    <select name="CanBo_ID" id="CanBo_ID" class="form-control">
                        @foreach($ds_canbo as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2">Cập nhật</button>
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

    <div id="Edit_LichTruc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thay đổi, cập nhật lịch trực lãnh đạo</h4>
            <br>
            <h5 class="modal-title text-center text-uppercase" >Trực từ ngày: <b id="TuNgay"></b> , đến ngày <b id="DenNgay"></b></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/update_lichtruc" class="form-horizontal calender" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ID" id="ID_LanhDao">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Lãnh đạo trực</label>
                  <div class="col-sm-9">
                    <select name="Truc_LD" id="Truc_LD" class="form-control">

                        @foreach($ds_lanhdao as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Từ ngày</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" name="TuNgay" required/>
                  </div>
                  <label class="col-sm-2 control-label">Đến ngày</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control datepicker" name="DenNgay" required/>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2">Cập nhật</button>
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

     <div id="Add_CT_LichTruc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thêm cán bộ trực ban</h4>
            <br>
            <h5 class="modal-title text-center text-uppercase" >Ngày trực ban: <b id="date_tb"></b></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/add" class="form-horizontal calender" method="post" id="frmAdd">
                {{ csrf_field() }}
                <input type="hidden" name="NgayTruc" id="NgayTruc_Add">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Cán bộ trực</label>
                  <div class="col-sm-9">
                    <select name="CanBo_ID" class="form-control">
                            <option value="">---Chọn cán bộ trực ban---</option>
                        @foreach($ds_canbo as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2">Thêm mới</button>
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
@endsection

@section('jsAdmin')
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js"></script>


     <script type="text/javascript">


        $(function () {

            $('.datepicker-days').css('display', 'none');

            // var todayDate = new Date().getDate();
            // $(".datepicker").datepicker({
            //     format: 'dd-mm-yyyy',
            //     todayHighlight: true,
            //     autoclose: true,
            //     language: 'vi',
            //     startDate: new Date(),
            //     endDate: new Date(new Date().setDate(todayDate + 5))
            // });
            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmAdd").validate({
                rules: {
                    CanBo_ID: { select_validate: "" }
                },
                messages: {
                    CanBo_ID: { select_validate: "Bạn chưa chọn cán bộ trực!" }
                }
            });
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);
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
                    url: '/lich-truc/getdata.html',
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    success: function(res) {
                        var events = [];

                        $.each(res.lanhdao_truc, function (i, item) {
                            var datenow = new Date();
                            var date_end = new Date(item.DenNgay);
                            var DenNgay_format = formatDate(item.DenNgay);
                            var check = true;

                            if(datenow.getTime() >= date_end.getTime()){
                                check = false;
                            }
                            
                            events[i] = {
                              id_ld: item.ID,
                              canbo_id: item.Truc_LD,
                              title: 'Trực lãnh đạo: Đ/c ' + item.HoTen,
                              start: item.TuNgay,
                              end: DenNgay_format,
                              backgroundColor: "#f56954", //red
                              borderColor: "#f56954", //red
                              type: "boss",
                              present: check
                          };

                        })

                        $.each(res.trucban, function (i, item) {
                            var datenow = new Date();
                            var date_truc = new Date(item.NgayTruc);
                            var check = true;

                            if(datenow.getTime() >= date_truc.getTime()){
                                check = false;
                            }
                           
                            var obj = {
                              id: item.ID,
                              canbo_id: item.CanBo_ID,
                              title: item.HoTen,
                              loaitruc: item.LoaiTruc,
                              start: item.NgayTruc,
                              backgroundColor: "#0073b7", 
                              borderColor: "#0073b7", 
                              present: check
                          };
                          events.push(obj);
                        })

                        $.each(res.truc_kn, function (i, item) {
                            var datenow = new Date();
                            var date_truc = new Date(item.NgayTruc);
                            var check = true;

                            if(datenow.getTime() >= date_truc.getTime()){
                                check = false;
                            }
                            
                            var obj = {
                              id: item.ID,
                              canbo_id: item.CanBo_ID,
                              title: item.HoTen,
                              loaitruc: item.LoaiTruc,
                              start: item.NgayTruc,
                              backgroundColor: "#f39c12", 
                              borderColor: "#f39c12", 
                              present: check
                          };
                          events.push(obj);
                        })

                        callback(events.sort());
                    }
                })
            },
            dayClick: function(date, jsEvent, view) {

                var datenow = new Date();
                var date_choose = new Date(date);
                var check = true;

                if(datenow.getTime() >= date_choose.getTime()){
                    check = false;
                }

                if(check){
                    // alert('Clicked on: ' + date.format());
                    $('#Add_CT_LichTruc').modal('show');
                    $('#ID').val(event.id);

                    var date_format = formatDate_VN(date, 0);
                    $('#date_tb').text(date_format);
                    $('#NgayTruc_Add').val(date.format());
                }
                
            },
            eventRender: function(event, element, view) {
                if(event.type != 'boss' && event.present == true){
                    element.find(".fc-content").prepend("<span class='closeon pull-right'><i class='fa fa-close' title='Xóa'></i></span>");
                }
                element.find(".closeon").on('click', function() {

                    const notice = PNotify.notice({
                        title: 'Thông báo',
                        text: 'Bạn thật sự muốn xóa cán bộ ' + event.title + ' ra khỏi lịch trực? ',
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
                              url: '/lich-truc/delete/' + event.id,
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
                    if(event.type != 'boss' && event.present == true){
                        $('#CalenderModalEdit').modal('show');
                        $('select#CanBo_ID').val(event.canbo_id);
                        $('#ID').val(event.id);

                        var date_format = formatDate_VN(event.start, 1);
                        $('#NgayTruc').text(date_format);
                        if(event.loaitruc == "Trực ban"){
                          $('#Truc_CB').text('Thay đổi, cập nhật lịch trực ban');
                        }else{
                          $('#Truc_CB').text('Thay đổi, cập nhật lịch trực khám nghiệm');
                        }
                    }else if(event.type == 'boss' && event.present == true){
                        $('#Edit_LichTruc').modal('show');
                        $('select#Truc_LD').val(event.canbo_id);
                        $('#ID_LanhDao').val(event.id_ld);

                        var tungay_format = formatDate_VN(event.start, 0);
                        var dengay_format = formatDate_VN(event.end, -1);
                        $('#TuNgay').text(tungay_format);
                        $('#DenNgay').text(dengay_format);

                        $('input[name="TuNgay"]').val(tungay_format);
                        $('input[name="DenNgay"]').val(dengay_format);

                        $(".datepicker").datepicker({
                            format: 'dd-mm-yyyy',
                            todayHighlight: true,
                            autoclose: true,
                            language: 'vi',
                            startDate: new Date()
                        });
                    }
                });
               
            },
            eventOrder: "id_ld"
          
        });
        
    });

function formatDate(date) {
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + (d.getDate() + 1),
    year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
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
    </script>
    
@endsection