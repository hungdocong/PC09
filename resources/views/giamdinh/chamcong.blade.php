@extends('layout._layout')

@section('title', 'Chấm công')


@section('content')

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Chấm công
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Giám định KTSĐT</a></li>
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
                  <h4 class="box-title">Chú thích</h4>
                </div>
                <div class="box-body">

                  <div id="external-events">
                    <div class="external-event bg-yellow ui-draggable ui-draggable-handle text-center" style="position: relative;">Tiếp nhận giám định</div>
                    <div class="external-event bg-light-blue ui-draggable ui-draggable-handle text-center" style="position: relative;">Đã kêt thúc</div>
                  </div>
                </div>

              </div>
              <!-- <div class="box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">Bồi dưỡng giám định</h4>
                </div>
                <div class="box-body">
                  <div id='external-events'>
                    <div class='external-event bg-green'>Lunch</div>
                    <div class='external-event bg-yellow'>Go home</div>
                    <div class='external-event bg-aqua'>Do homework</div>
                    <div class='external-event bg-light-blue'>Work on UI design</div>
                    <div class='external-event bg-red'>Sleep tight</div>
                    <div class="checkbox">
                      <label for='drop-remove'>
                        <input type='checkbox' id='drop-remove' />
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Tạo sự kiện</h3>
                </div>
                <div class="box-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                  </div><!-- /btn-group -->
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">
                    <div class="input-group-btn">
                      <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Thêm</button>
                    </div><!-- /btn-group -->
                  </div><!-- /input-group -->
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
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-center text-uppercase">Bồi dưỡng giám định</h4><br>
            <h4 class="modal-title text-center text-uppercase"><b id="tblVuViec"></b></h4><br>
          </div>
          <div class="modal-body">
            <div class="col mb-3">
              <h5>Ngày giám định: <b id="NgayGD"></b></h5>
            </div>
            <div class="col mb-3">
              <h5>Ngày kết thúc: <b id="NgayKT"></b></h5>
            </div>
            <div id="testmodal2" style="padding: 5px 20px;">
               <table class="table table-striped" id="tblDate">
                <thead>
                  <tr>
                    <th class="text-center"></th>
                    <th class="text-center">24/7/2024</th>
                    <th class="text-center">25/7/2024</th>
                    <th class="text-center">26/7/2024</th>
                    <th class="text-center">27/7/2024</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Đỗ Công Hưng</th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                  </tr>
                  <tr>
                    <th>Đỗ Lê Hải Dương</th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                    <th class="text-center"><label><input type="checkbox" class="minimal"/></label></th>
                  </tr>
                </tbody>
              </table>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Họ và tên</th>
                    <th class="text-center">Chức danh</th>
                    <th class="text-center">Ngày công</th>
                    <th class="text-center">Mức BD/ngày</th>
                    <th class="text-center">Tổng</th>
                  </tr>
                </thead>
                <tbody id="tblUpdate">
                </tbody>
              </table>

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
                    url: '/giam-dinh/getdata.html',
                    type: 'GET',
                    dataType: 'json',
                    data: {},
                    success: function(res) {
                      var events = [];
                      $.each(res.lstChamCong, function (i, item) {

                            var NgayTiepNhan = formatDate(item.NgayTiepNhan);
                            var calen = {
                              id_ld: item.ID,
                              title: item.DonVi_TC,
                              start: NgayTiepNhan,
                              end: NgayTiepNhan,
                              // tieude: item.DonVi_TC + " - " + formatDate_VN(item.NgayTiepNhan, 0),
                              backgroundColor: "#f39c12",
                              borderColor: "#f39c12",
                              check: false
                            };
                            events.push(calen);

                            if(item.NgayGD != null){
                              var NgayGD = formatDate(item.NgayGD);
                              var NgayKT = formatDate_End(item.NgayKT);
                              if(item.ID == 8){
                                console.log("ID: " + item.ID);
                                console.log("NgayGD: " + item.NgayGD);
                                console.log("Ngay KT: " + item.NgayKT);
                                console.log("Ngay KT End: " + formatDate_End(item.NgayKT));
                              }

                              var calen = {
                                id_ld: item.ID,
                                title: item.DonVi_TC + " - " + item.SoHoSo,
                                start: formatDate(item.NgayGD),
                                end: formatDate_End(item.NgayKT),
                                // tieude: item.DonVi_TC + " - " + item.SoHoSo,
                                backgroundColor: "#3c8dbc",
                                borderColor: "#3c8dbc",
                                check: true
                              };
                              events.push(calen);
                            }

                            if(item.GiamDinh != null){
                              var arr_str = item.GiamDinh.split(',');
                              console.log(arr_str);
                              var calen = {};
                              for(var i = 0; i < arr_str.length ; i++){

                                calen = {
                                  id_ld: item.ID,
                                  title: item.DonVi_TC + " - " + item.SoHoSo,
                                  start: arr_str[i],
                                  end: arr_str[i],
                                  backgroundColor: "#3c8dbc",
                                  borderColor: "#3c8dbc",
                                  check: true
                                };
                                events.push(calen);
                              }
                            }
                      })
                      callback(events);
                    }
                })
            },

            eventRender: function(event, element, view) {

                element.find(".fc-content").on('click', function() {
                  if(event.check == false)
                    return;
                  $('#Edit_ChamCong').modal('show');
                  $('#ID').val(event.id_ld);

                  var tungay_format = formatDate_VN(event.start, 0);
                  var dengay_format = formatDate_VN(event.end, -1);
                  console.log(event.end)
                  $('#tblVuViec').text(event.title);
                  $('#NgayGD').text(tungay_format);
                  // $('#NgayKT').text(dengay_format);

                  $.ajax({
                    url: "/giam-dinh/getChamCongByID/" + event.id_ld,
                    type: 'GET',
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function (res) {
                      const result = Sub_date(dengay_format) -  Sub_date(tungay_format);
                      var days = result / (1000 * 60 * 60 * 24) + 1;
                      // days = days + 1;
                      var htm = '<thead>'+
                                    '<tr>'+
                                      '<th class="text-center"></th>';
                      $.each(res.ngay_arr, function (i, item) {
                        htm += '<th class="text-center">'+ item +'</th>';
                      });
                      htm +=    '</tr>'+
                             '</thead>'+
                              '<tbody>';
                      $.each(res.phutrach, function (i, item) {
                        htm += '<tr>'+
                                    '<td>'+ item.HoTen +'</td>';
                                   $.each(res.ngay_arr, function (j, jtem) {
                                      htm += '<td class="text-center"><label><input type="checkbox" class="minimal" checked/></label></td>';
                                   });
                        htm += '</tr>';
                      });
                        htm += '</tbody>'
                      $('#tblDate').empty();
                      $('#tblDate').append(htm);

                      var html = '';
                      $.each(res.phutrach, function (i, item) {
                        html += '<tr>'+
                                    '<td>'+ item.HoTen +'</td>'+
                                    '<td>'+ (i == 0 ? "Giám định viên" : "Trợ lý giám định" )+'</td>'+
                                    '<td class="text-center">'+ days +'</td>'+
                                    '<td class="text-center">'+ (i == 0 ? "300.000" : "210.000") +'</td>'+
                                    '<td class="text-center">'+
                                        new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(days * (i == 0 ? 300000 : 210000)) +
                                    '</td>'+
                                   '</tr>';
                      });
                      html += '<tr>'+
                                '<td colspan="4" class="text-center">Tổng cộng</td>'+
                                '<td class="text-center">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(days * 300000 + days * 210000) +'</td>'+
                              '</tr>'+
                              '<tr>'+
                                  '<td colspan="5" class="text-center text-uppercase" >Bằng chữ: <b id="lbl_isWord">'+ inWords(days * 300000 + days * 210000) +
                                  '</b></td>'+
                              '</tr>';
                      $('#tblUpdate').empty();
                      $('#tblUpdate').append(html);

                      $('#NgayKT').text(formatDate_VN(formatDate_End(res.query.NgayKT), 0));
                    }
                  });

                });
            },
          editable: false,
          droppable: true,
          selectable: false, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped
            var originalEventObject = $(this).data('eventObject');
            var copiedEventObject = $.extend({}, originalEventObject);
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");
            var noidung = originalEventObject.title;
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                if ($('#drop-remove').is(':checked')) {
                  $(this).remove();
                }
            }
        });

        $(".fc-button").on('click', function() {
         var date = $("#calendar").fullCalendar('getDate');
         var month_int = date._d.getMonth() + 1;
             jQuery.ajax({
              url: '/giam-dinh/change-month/' + month_int,
              type: 'GET',
              dataType: 'json',
              data: {},
              success: function(res) {

                $('#box-BDGD').empty();
                var htm = '';
                const arr_bg = new Array("bg-green","bg-yellow","bg-red","bg-aqua");
                const arr_fa = new Array("fa-bookmark-o","fa-flag-o","fa-files-o","fa-star-o");
                $.each(res.arr_donvi, function (i, item) {
                    if(i >= arr_bg.length || arr_fa.length <= i) {i = Math.floor(Math.random() * (arr_bg.length - 0));}
                    htm += '<div class="info-box">'+
                              '<span class="info-box-icon '+ arr_bg[i] +'"><i class="fa '+ arr_fa[i] +' fa-sm"></i></span>'+
                              '<div class="info-box-content">'+
                                '<span class="info-box-text">'+ item.DonVi +'</span>'+
                                '<span class="info-box-number">Tổng: '+ item.Tong +' ₫ </span>'+
                                '<span class="info-box-number">Thanh toán: '+ item.ThanhToan +' ₫ </span>'+
                              '</div>'+
                            '</div>';
                });
                $('#box-BDGD').append(htm);
              }
            })
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
              e.preventDefault();
              //Get value and make sure it is not null
              var val = $("#new-event").val();
              if (val.length == 0) {
                return;
              }

              //Create events
              var event = $("<div />");
              event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
              event.html(val);
              $('#external-events').prepend(event);

              //Add draggable funtionality
              ini_events(event);

              //Remove event from text input
              $("#new-event").val("");
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

function  isCheck(year) {
  return ((year % 4 == 0 && year % 100 != 0) || year % 400 == 0);
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

    function Sub_date(date){
      let [day, month, year] = date.split('-')
      const dateObj = new Date(+year, +month - 1, +day)

      return dateObj;
    }

     var a = ['','một ','hai ','ba ','bốn ', 'năm ','sáu ','bảy ','tám ','chín ','mười ','mười một ','mười hai ','mười ba ','mười bốn ','mười năm ','mười sáu ','mười bảy ','mười tám ','mười chín '];
      var b = ['', '', 'hai mươi','ba mươi','bốn mươi','năm mươi', 'sáu mươi','bảy mươi','tám mươi','chín mươi'];
    function inWords (num) {
      if ((num = num.toString()).length > 8) return;
      var lth = num.toString().length;
      var str = '';

      if(lth == 8 || lth == 7){
        n = ('00000000' + num).substr(-8).match(/^(\d{2})(\d{1})(\d{2})(\d{1})(\d{2})$/);
        if(b[Number(n[1][0])] != 0)
          str += b[n[1][0]] + ' ' + a[n[1][1]] + 'triệu ';
        else if(a[Number(n[1])] != 0)
          str += a[Number(n[1])] + 'triệu ';

        if(a[Number(n[2])] != 0){
          str += a[Number(n[2])] + 'trăm ';
        }else if(a[Number(n[2])] == 0 && n[3][0] != 0)
        str += 'không trăm ';

        if(b[Number(n[3][0])] != 0)
          str += b[n[3][0]] + ' ' + a[n[3][1]] + 'nghìn ';
        else if(a[n[3][0]] == 0 && a[n[3][1]] != 0)
          str += 'lẻ ' + a[n[3][1]] + 'nghìn ';
        else if(a[n[3][1]] != 0)
          str += a[n[3][0]] + ' ' + a[n[3][1]] + 'nghìn ';

        if(a[Number(n[4])] != 0){
          str += a[Number(n[4])] + 'trăm ';
        }else if(a[Number(n[4])] == 0 && n[5][0] != 0)
        str += 'không trăm ';

              // str += (a[Number(n[4])] != 0) ? a[Number(n[4])] + 'trăm ' : 'không trăm ';

        if(b[n[5][0]] != 0)
          str += (n[5][1] == 1) ? b[n[5][0]] + ' mốt' : b[n[5][0]] + ' ' + a[n[5][1]];
        else if(a[n[5][0]] == 0 && a[n[5][1]] != 0)
          str += 'lẻ ' + a[n[5][1]];
        else if(a[Number(n[5])] != 0)
          str += a[n[5]];

      }else if(lth == 6 || lth == 5){
        n = ('000000' + num).substr(-6).match(/^(\d{1})(\d{2})(\d{1})(\d{2})$/);
        str += (a[Number(n[1])] != 0) ? a[Number(n[1])] + 'trăm ' : '';

        if(b[Number(n[2][0])] != 0)
          str += b[n[2][0]] + ' ' + a[n[2][1]] + 'nghìn ';
        else if(a[Number(n[2])] != 0)
          str += a[Number(n[2])] + 'nghìn ';

        str += (a[Number(n[3])] != 0) ? a[Number(n[3])] + 'trăm ' : '';

        if(b[n[4][0]] != 0)
          str += (n[4][1] == 1) ? b[n[4][0]] + ' mốt' : b[n[4][0]] + ' ' + a[n[4][1]];
        else if(a[n[4][0]] == 0 && a[n[4][1]] != 0)
          str += 'lẻ ' + a[n[4][1]];
        else if(a[Number(n[4])] != 0)
          str += a[n[4]];
      }

      return str;
    }
    </script>

@endsection
