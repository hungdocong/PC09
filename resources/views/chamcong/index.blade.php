@extends('layout._layout')

@section('title', 'Danh sách lịch trực ban')


@section('content')

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lý chấm công
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Chấm công, lịch công tác</a></li>
            <li class="active">Quản lý chấm công</li>
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
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">Draggable Events</h4>
                </div>
                <div class="box-body">

                  <div id="external-events">
                    <div class="external-event bg-green ui-draggable ui-draggable-handle" style="position: relative;">Lunch</div>
                    <div class="external-event bg-yellow ui-draggable ui-draggable-handle" style="position: relative;">Go home</div>
                    <div class="external-event bg-aqua ui-draggable ui-draggable-handle" style="position: relative;">Do homework</div>
                    <div class="external-event bg-light-blue ui-draggable ui-draggable-handle" style="position: relative;">Work on UI design</div>
                    <div class="external-event bg-red ui-draggable ui-draggable-handle" style="position: relative;">Sleep tight</div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-9">
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


    <div id="Edit_ChamCong" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Cập nhật chấm công</h4>
            <br>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/cham-cong/update" class="form-horizontal calender" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="ID" id="ID">
                <div class="form-group">
                  <label>Cán bộ công tác</label>
                    <select name="CanBo_ID" id="CanBo_ID_Edit" class="form-control">
                            <option value="">---Chọn cán bộ---</option>
                        @foreach($ds_canbo as $item)
                            <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                        @endforeach
                    </select>
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
                <div class="form-group">
                  <label >Tiêu đề</label>
                   <input type="text" class="form-control" name="TieuDe" id="TieuDe" required/>
                </div>
                <div class="form-group">
                  <label>Nội dung</label>
                  <input type="text" class="form-control" name="NoiDung" id="NoiDung" required/>
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

     <div id="Add_ChamCong" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase" id="myModalLabel2">Thêm chấm công</h4>
            <br>
            <h5 class="modal-title text-center text-uppercase" id="date-content"></h5>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form action="/cham-cong/add" class="form-horizontal calender" method="post" id="frmAdd">
                {{ csrf_field() }}
                <input type="hidden" name="TuNgay" id="TuNgay_Add">
                <input type="hidden" name="DenNgay" id="DenNgay_Add">
                <div class="form-group">
                  <label>Cán bộ công tác</label>
                  <select name="CanBo_ID" class="form-control">
                      <option value="">---Chọn cán bộ---</option>
                    @foreach($ds_canbo as $item)
                      <option value="{{ $item->ID }}">{{ $item->HoTen }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tiêu đề</label>
                  <input type="text" class="form-control" name="TieuDe" required/>
                </div>
                <div class="form-group">
                  <label >Nội dung</label>
                  <input type="text" class="form-control" name="NoiDung" required/>
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

            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);

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
                    url: '/cham-cong/getdata.html',
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    success: function(res) {
                        var events = [];
                        var color = ["#f56954", "#f39c12", "#00c0ef", "#0073b7", "#00a65a", "#3c8dbc", "#39cccc"];
                        

                        $.each(res.lstChamCong, function (i, item) {
                            
                            const random = Math.floor(Math.random() * color.length);
                            var DenNgay_format = formatDate(item.DenNgay);
                            events[i] = {
                              id_ld: item.ID,
                              canbo_id: item.CanBo_ID,
                              title: item.HoTen + " - " + item.TieuDe,
                              start: item.TuNgay,
                              end: DenNgay_format,
                              tieude: item.TieuDe,
                              noidung: item.NoiDung,
                              backgroundColor: color[random], 
                              borderColor: color[random]
                          };

                      })
                        
                      callback(events);
                    }
                })
            },
            dayClick: function(date, jsEvent, view) {

                  $('#Add_ChamCong').modal('show');

                  // var html = "<span>Công tác ngày: <b>" + formatDate(date) + "</b></span>";
                  $('#date-content').empty();
                  $('#date-content').append("Công tác ngày: <b>" + formatDate_VN(date, 0) + "</b>");
                  
                  $('#TuNgay_Add').val(formatDate_VN(date, 0));
                  $('#DenNgay_Add').val(formatDate_VN(date, 0));
                
            },
            select: function(start, end, jsEvent, view) {
              $('#Add_ChamCong').modal('show');
              
              if(formatDate_VN(start, 0) === formatDate_VN(end, -1)){
                $('#date-content').empty();
                $('#date-content').append("Công tác ngày: <b>" + formatDate_VN(start, 0) + "</b>");
              }
              else{
                var html = "<span>Công tác từ ngày: <b>"+ formatDate_VN(start, 0) +"</b> , đến ngày <b>"+ formatDate_VN(end, -1) +"</b></span>";
                $('#date-content').empty();
                $('#date-content').append(html);
              }
              

              $('#TuNgay_Add').val(formatDate_VN(start, 0));
              $('#DenNgay_Add').val(formatDate_VN(end, -1));
              
            },
            eventRender: function(event, element, view) {
                element.find(".fc-content").prepend("<span class='closeon pull-right'><i class='fa fa-close' title='Xóa'></i></span>");
                element.find(".closeon").on('click', function() {
                    var ID = event.id_ld;
                    const notice = PNotify.notice({
                        title: 'Thông báo',
                        text: 'Bạn thật sự muốn xóa chấm công ' + event.title + ' này? ',
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
                              url: '/cham-cong/delete/' + ID,
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
                  $('#Edit_ChamCong').modal('show');
                  $('select#CanBo_ID_Edit').val(event.canbo_id);
                  $('#TieuDe').val(event.tieude);
                  $('#NoiDung').val(event.noidung);
                  $('#ID').val(event.id_ld);

                  var tungay_format = formatDate_VN(event.start, 0);
                  var dengay_format = formatDate_VN(event.end, -1);
                 
                  $('input[name="TuNgay"]').val(tungay_format);
                  $('input[name="DenNgay"]').val(dengay_format);

                  // $(".datepicker").datepicker({
                  //   format: 'dd-mm-yyyy',
                  //   todayHighlight: true,
                  //   autoclose: true,
                  //   language: 'vi'
                  // });

                });
               
            },
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