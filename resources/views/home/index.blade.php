@extends('layout._layout')

@section('title', 'Thống kê & báo cáo')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1 style="display: flex;">
      @php
        $month =  Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('m-Y');
        $year =  Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
        $date = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y')
      @endphp
      Thống kê & báo cáo năm {{ $year }}
    </h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
			<li class="active">Thống kê & báo cáo</li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{ $hoanthanh_vv }}</h3>
                  <p>Hoàn thành & trả kết luận Tháng {{ $month }}</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $tiepnhan_now }}</h3>
                  <p>Tiếp nhận hôm nay: {{ $date }}</p>
                  {{-- <p>Tiếp nhận hôm nay</p> --}}
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{ $da_tiep_nhan }}</h3>
                  <p>Đã tiếp nhận</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{ $tong_vv }}</h3>
                  <p>Tổng số vụ</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <script> let arr_year = [] </script>
                  @foreach($arryear as $key=>$value)
                      <script> arr_year[{{ $key }}] = {{ $value }} </script>
                      @if($value != $year)
                          <li><a href="#Chart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @else
                          <li class="active"><a href="#Chart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @endif
                  @endforeach
                  <li class="pull-left header"><i class="fa fa-bar-chart-o fa-fw"></i> Thống kê giám định</li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  @foreach($arryear as $item)
                      @if($item != $year)
                          <div class="chart tab-pane" id="Chart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @else
                          <div class="chart tab-pane active" id="Chart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @endif
                  @endforeach
                </div>
              </div>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  @foreach($arryear as $key=>$value)
                      @if($value != $year)
                          <li><a href="#CateChart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @else
                          <li class="active"><a href="#CateChart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @endif
                  @endforeach
                  <li class="pull-left header"><i class="fa fa-chart-o fa-fw"></i>Vụ việc theo ĐVTC</li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  @foreach($arryear as $item)
                      @if($item != $year)
                          <div class="chart tab-pane" id="CateChart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @else
                          <div class="chart tab-pane active" id="CateChart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @endif
                  @endforeach
                </div>
              </div>
            </section><!-- right col -->

            <section class="col-lg-12 connectedSortable">
              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  @foreach($arryear as $key=>$value)
                      @if($value != $year)
                          <li><a href="#LinhVucChart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @else
                          <li class="active"><a href="#LinhVucChart_{{ $value }}" data-toggle="tab">{{ $value }}</a></li>
                      @endif
                  @endforeach
                  <li class="pull-left header"><i class="fa fa-chart-o fa-fw"></i>Vụ việc theo lĩnh vực giám định</li>
                </ul>
                <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  @foreach($arryear as $item)
                      @if($item != $year)
                          <div class="chart tab-pane" id="LinhVucChart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @else
                          <div class="chart tab-pane active" id="LinhVucChart_{{ $item }}" style="position: relative; height: 300px;"></div>
                      @endif
                  @endforeach
                </div>
              </div>
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection


@section('jsAdmin')

    <script>
         $(document).ready(function () {
            for(let i = 0; i < arr_year.length; i++) {
              $.ajax({
                  type: 'GET',
                  url: '/chart-' + arr_year[i],
                  data: {},
                  contentType: "application/json;charset=utf-8",
                  dataType: 'json',
                  success: function (res) {
                      successFunc(res, arr_year[i]);
                      // console.log(res);
                  },
                  error: function (errormessage) {
                      alert("error");
                      console.log(errormessage.responseText);
                  }
                });

              $.ajax({
                type: 'GET',
                url: '/chartcategory-' + arr_year[i],
                data: {},
                contentType: "application/json;charset=utf-8",
                dataType: 'json',
                success: function (res) {
                    getCategory_ToView(res, arr_year[i]);
                    // console.log(res);
                },
                error: function (errormessage) {
                    alert("error");
                    console.log(errormessage.responseText);
                }
              });


              $.ajax({
                type: 'GET',
                url: '/chartlinhvuc-' + arr_year[i],
                data: {},
                contentType: "application/json;charset=utf-8",
                dataType: 'json',
                success: function (res) {
                    getLinhVuc_ToView(res, arr_year[i]);
                    // console.log(res);
                },
                error: function (errormessage) {
                    alert("error");
                    console.log(errormessage.responseText);
                }
              });
            }


        });

        function successFunc(jsondata, year) {

            var month = ['x', 'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10','Tháng 11', 'Tháng 12'];
            var Total = ['total'];

            var month = ['x'];
            var tiepnhan = ['TiepNhan'];
            var ketthuc = ['KetThuc'];
            $.each(jsondata.lstTotal, function (i, item) {
                // console.log(item);
                Total.push(item);

                month.push("Tháng " + i);
                tiepnhan.push(item.TiepNhan);
                ketthuc.push(item.KetThuc);
            });

                var chart = c3.generate({
                    bindto: '#Chart_' + year,
                    data: {
                        x: 'x',
                        columns: [
                                month,
                                tiepnhan,
                                ketthuc
                        ],
                        type: 'bar',
                    },
                    axis: {
                        x: {
                            type: 'category', // this needed to load string x value
                            label: {
                                position: 'outer-center'
                            }
                        },
                        y : {
                            tick: {
                                format: d3.format(",")
                            }
                        }
                    },
                    color: {
                        TiepNhan: '#ff0000',
                        KetThuc: '#00ff00'
                    },
                    labels: true
                });

                chart.data.names({
                                      TiepNhan: 'Tiếp nhận (vụ)',
                                      KetThuc: 'Hoàn thành (vụ)',
                                  });
        }

        function getCategory_ToView(jsondata, year) {

            var category = [];

            // console.log(jsondata.lstCate);
            $.each(jsondata.lstTotal, function (i, item) {
                // console.log(item.Name);
                // console.log(item.View);
                category[i] = new Array(item.DonVi, item.Total);
                // view.push(item.View);
            });

            console.log(category);

            var chart = c3.generate({
                bindto: '#CateChart_' + year,
                data: {
                    columns: category,
                    type: 'pie',
                  },
                  pie: {
                    label: {
                      format: function (value, ratio, id) {
                        return d3.format('')(value);
                      }
                    }
                  }
            });
        }

        function getLinhVuc_ToView(jsondata, year) {

            var category = [];

            // console.log(jsondata.lstCate);
            $.each(jsondata.lstTotal, function (i, item) {
                // console.log(item.Name);
                // console.log(item.View);
                category[i] = new Array(item.LinhVuc, item.Total);
                // view.push(item.View);
            });

            console.log(category);

            var chart = c3.generate({
                bindto: '#LinhVucChart_' + year,
                data: {
                    columns: category,
                    type: 'pie',
                  },
                  pie: {
                    label: {
                      format: function (value, ratio, id) {
                        return d3.format('')(value);
                      }
                    }
                  }
            });
        }

        
    </script>

@endsection
