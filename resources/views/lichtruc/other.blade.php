@extends('layout._layout')

@section('title', 'Lịch trực khác')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Danh sách lịch trực lễ, tết
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-folder"></i> Quản lý lịch trực </a></li>
            <li class="active">Lịch trực khác</li>
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
                      Cán bộ trực
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
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thay đổi, cập nhật lịch trực</h4>
            <br>
            <h5 class="modal-title text-center text-uppercase" >Ngày trực: <b id="NgayTruc"></b></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/update_other" class="form-horizontal calender" method="post">
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
            <h5 class="modal-title text-center text-uppercase" >Trực ngày: <b id="TuNgay"></b></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/update_lichtruc_other" class="form-horizontal calender" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ID" id="ID_LanhDao">
                <input type="hidden" class="form-control datepicker" name="TuNgay" required/>
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

     <div id="Add_XepLichTruc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Xếp lịch trực</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/lich-truc/add_other" class="form-horizontal calender" method="post" id="frmAdd">
                {{ csrf_field() }}
                <input type="hidden" name="NgayTruc" id="NgayTruc_Add">
                <div class="form-group">
                  
                  <div class="col-sm-8">
                    <label>Thời gian</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="DateRange" id="reservation" />
                    </div>
                  </div>
                 

                  <div class="col-sm-4">
                     <label>Số cán bộ trực / ngày</label>
                    <input type="number" class="form-control" name="SoLuong" min="1" required/>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <label class="col-sm-4">
                      Loại lịch trực
                    </label>
                    <label class="col-sm-4">
                      <input type="radio" class="flat-red" name="LoaiTruc" value="Trực lễ" checked/>
                      Trực ngày lễ
                    </label>
                    <label class="col-sm-4">
                      <input type="radio" class="flat-red" name="LoaiTruc" value="Trực tết" />
                      Trực ngày tết
                    </label>
                  </div>
                </div>
                
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary antosubmit2">Xếp lịch trực</button>
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
     <script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>

     <script type="text/javascript">


        $(function () {
            $('.datepicker-days').css('display', 'none');

            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
            $('#reservation').daterangepicker({
              format: 'DD/MM/YYYY',
              todayHighlight: true,
              autoclose: true,
              minDate: new Date(),
              locale: {
                applyLabel: 'Chọn',
                fromLabel: 'Từ ngày',
                toLabel: 'Đến ngày',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['CN', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6','Th7'],
                monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                firstDay: 1
              }
            });
            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmAdd").validate({
                rules: {
                    CanBo_ID: { select_validate: "" },
                    Truc_LD: { select_validate: "" }
                },
                messages: {
                    CanBo_ID: { select_validate: "Bạn chưa chọn cán bộ trực!" },
                    Truc_LD: { select_validate: "Bạn chưa chọn lãnh đạo trực!" }
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
             customButtons: {
              addButton: {
                text: 'Xếp lịch trực',
                click: function() {
                  $('#Add_XepLichTruc').modal('show');
                }
              }
            },
            header: {
                left: 'prev,next today addButton',
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
            eventOrderStrict: true,

            events: function(start, end, timezone, callback) {
                jQuery.ajax({
                    url: '/lich-truc/get-lich-truc-khac.html',
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
                            
                            var obj = {
                              id_ld: item.ID,
                              canbo_id: item.Truc_LD,
                              title: item.HoTen,
                              start: item.TuNgay,
                              end: DenNgay_format,
                              backgroundColor: "#f56954", //red
                              borderColor: "#f56954", //red
                              type: "boss",
                              present: check
                          };
                          events.push(obj);
                      })

                        $.each(res.canbo_truc, function (i, item) {
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
                              start: item.NgayTruc,
                              backgroundColor: "#0073b7", //Blue
                              borderColor: "#0073b7", //Blue
                              present: check
                          };
                          events.push(obj);
                      })
                        callback(events);
                    }
                })
            },
            eventOrder: "type",
            // dayClick: function(date, jsEvent, view) {

            //     var datenow = new Date();
            //     var date_choose = new Date(date);
            //     var check = true;

            //     if(datenow.getTime() >= date_choose.getTime()){
            //         check = false;
            //     }

            //     if(check){
            //         // alert('Clicked on: ' + date.format());
            //         $('#Add_XepLichTruc').modal('show');
            //         $('#ID').val(event.id);

            //         var date_format = formatDate_VN(date, 0);
            //         $('#date_tb').text(date_format);
            //         $('#NgayTruc_Add').val(date.format());
            //     }
                
            // },
            eventRender: function(event, element, view) {
                // if(event.present == true){
                //     element.find(".fc-content").prepend("<span class='closeon pull-right'><i class='fa fa-close' title='Xóa'></i></span>");
                // }
                // element.find(".closeon").on('click', function() {

                //     const notice = PNotify.notice({
                //         title: 'Thông báo',
                //         text: 'Bạn thật sự muốn xóa cán bộ ' + event.title + ' ra khỏi lịch trực? ',
                //         icon: 'fa fa-question-circle',
                //         width: '360px',
                //         minHeight: '110px',
                //         hide: false,
                //         closer: false,
                //         sticker: false,
                //         destroy: true,
                //         stack: new PNotify.Stack({
                //           dir1: 'down',
                //           modal: true,
                //           firstpos1: 25,
                //           overlayClose: false
                //       }),
                //         modules: new Map([
                //           ...PNotify.defaultModules,
                //           [PNotifyConfirm, {
                //             confirm: true
                //         }]
                //         ])
                //     });

                //     notice.on('pnotify:confirm', () =>
                //         $.ajax({
                //               type: 'GET',
                //               url: '/lich-truc/delete/' + event.id,
                //               data: {},
                //               success: function () {
                //                 PNotify.success({
                //                     title: 'THÔNG BÁO!!',
                //                     text: 'Xóa thành công.'
                //                 });
                //                 $('#calendar').fullCalendar('removeEvents',event._id);
                //                 // console.log(event.id);
                //             }
                //         })
                //     );
                // });

                element.find(".fc-title").on('click', function() {
                    if(event.type != 'boss' && event.present == true){
                        $('#CalenderModalEdit').modal('show');
                        $('select#CanBo_ID').val(event.canbo_id);
                        $('#ID').val(event.id);

                        var date_format = formatDate_VN(event.start, 1);
                        $('#NgayTruc').text(date_format);
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
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
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