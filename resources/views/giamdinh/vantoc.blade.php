@extends('layout._layout')

@section('title', 'Tính vận tốc')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Tính vận tốc
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>Giám định KTSĐT</a></li>
			<li class="active">Tính vận tốc</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Nhập thông tin</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data">
                     <div class="box-body">
                        <div class="form-group col-md-3">
                            <label>Quãng đường (đ/vị: mét)</label>
                            <input type="number" min="0" class="form-control" id="quang_duong" autofocus>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tốc độ khung hình (FPS)</label>
                            <input type="number" class="form-control" min="0" id="fps" value="25">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Số khung hình (frame) đi hết quãng đường:</label>
                            <input type="number"class="form-control" id="frame" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sai số (frame) :</label>
                            <input type="number" class="form-control" id="saiso" value="0.5" >
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                        <button type="button" class="btn btn-primary btn-lg" id="btn-measure">Tính vận tốc</button>
                    </div>
                </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
    </div>
    <div class="row">
        <div class="col-xs-6">
           <div class="box">
              <div class="box-header with-border">
                  <h3 class="box-title">Kết quả</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                  <table class="table table-bordered">
                       <tr>
                          <th></th>
                          <th>Thời gian</th>
                          <th>Vận tốc (m/s)</th>
                          <th>Vận tốc (km/h)</th>
                      </tr>
                      <tbody id="ketqua">
                      </tbody>
                   </table>
              </div><!-- /.box-body -->
            </div>
            <div class="box">
              <div class="box-body">
                  <div class="mb-3" id="v_tb">
                    <h4>Vận tốc trung bình &#8893; = 
                      <span class="frac">
                        <tuso>(v<sub>1</sub> + v<sub>2</sub> + v<sub>3</sub>)</tuso>
                        <mauso>3</mauso></span> = <b></b> (m/s)
                    </h4><br>
                    <h4>Hay &#8893; = <b></b>(km/h)</h4><br> 
                  </div> 
              </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-6">
            <div class="box">
               <div class="box-body">
                <div id="speed">
                    <div class="mb-3">
                      <h4>Sai số tuyệt đối: </h4><br>
                      <h4>&#916;v<sub>1</sub> = <b></b></h4><br>
                      <h4>&#916;v<sub>2</sub> = <b></b></h4><br>
                      <h4>&#916;v<sub>3</sub> = <b></b></h4><br>
                  </div>

                  <div class="mb-3">
                      <!-- <h4>Sai số trung bình: &#916;v = (&#916;v<sub>1</sub> + &#916;v<sub>2</sub> + &#916;v<sub>3</sub>) / 3 = <b></b></h4><br> -->
                      <h4>Sai số trung bình &#916;&#8893; = 
                          <span class="frac">
                            <tuso>(&#916;v<sub>1</sub> + &#916;v<sub>2</sub> + &#916;v<sub>3</sub>)</tuso>
                            <mauso>3</mauso></span> = <b></b>
                        </h4><br>
                    </div>

                    <div class="mb-3">
                      <h4>Vận tốc v = &#916;&#8893; &#177; &#916;v = <b></b></h4><br>
                  </div>
              </div>
              

              </div><!-- /.box-body -->
          </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('jsAdmin'){

    <script type="text/javascript">
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
              $("#btn-measure").click();
          }
      });
        $(function () {
         $("#btn-measure").click(function(){
            var quang_duong = $('#quang_duong').val();
            var fps = $('#fps').val();
            var frame = $('#frame').val();
            var sai_so = $('#saiso').val();


            var t1 = (1 / fps) * frame;
            var v1 = quang_duong / t1;
            var v1_km = v1 * 3.6;

            var t2 = (1 / fps) * (parseInt(frame) + parseFloat(sai_so));
            var v2 = quang_duong / t2;
            var v2_km = v2 * 3.6;

            var t3 = (1 / fps) * (frame - parseFloat(sai_so));
            var v3 = quang_duong / t3;
            var v3_km = v3 * 3.6;

            var html = '<tr>'+
                          '<td>frame '+ frame +'</td>'+
                          '<td>'+ t1.toFixed(2) +'</td>'+
                          '<td>'+ v1.toFixed(2) +'</td>'+
                          '<td>'+ v1_km.toFixed(2) +'</td>'+
                      '</tr>'+
                      '<tr>'+
                          '<td>frame '+ (parseFloat(frame) + parseFloat(sai_so)) +'</td>'+
                          '<td>'+ t2.toFixed(2) +'</td>'+
                          '<td>'+ v2.toFixed(2) +'</td>'+
                          '<td>'+ v2_km.toFixed(2) +'</td>'+
                      '</tr>'+
                      '<tr>'+
                          '<td>frame '+ (frame - parseFloat(sai_so)) +'</td>'+
                          '<td>'+ t3.toFixed(2) +'</td>'+
                          '<td>'+ v3.toFixed(2) +'</td>'+
                          '<td>'+ v3_km.toFixed(2) +'</td>'+
                      '</tr>';

            $('#ketqua').empty();
            $('#ketqua').append(html);

            var v_tb = (v1 + v2 + v3) / 3;
            var v_km = v_tb * 3.6;
            var htm = '<h4>Vận tốc trung bình:</h4><br>'+
                      '<h4>&#8893; = '+
                          '<span class="frac">'+
                              '<tuso>'+
                                  '(v<sub>1</sub> + v<sub>2</sub> + v<sub>3</sub>)'+
                               '</tuso>'+
                               '<mauso>3</mauso>'+
                            '</span> = '+
                            '<span class="frac">'+
                              '<tuso>('+ v1.toFixed(2) +' + '+ v2.toFixed(2) +' + '+ v3.toFixed(2) +' )</tuso>'+
                              '<mauso>3</mauso>'+
                             '</span>= <b>'+ v_tb.toFixed(2) +'</b> (m/s)'+
                      '</h4><br>'+
                      '<h4>Hay &#8893; = '+ v_tb.toFixed(2) +' x 3,6 = <b>'+ v_km.toFixed(2) +'</b>(km/h)</h4><br>';
            
            $('#v_tb').empty();
            $('#v_tb').append(htm);

            var v1_ss = v1 - v_tb;
            var v2_ss = v2 - v_tb;
            var v3_ss = v3 - v_tb;
            var vtb_ss = (Math.abs(v1_ss) + Math.abs(v2_ss) + Math.abs(v3_ss) ) / 3;
            var str =       '<div class="mb-3">'+
                              '<h4>Sai số tuyệt đối: </h4><br>'+
                              '<h4>&#916;v<sub>1</sub> = <b>|'+ v1.toFixed(2) +' - '+ v_tb.toFixed(2) +' | = '+ Math.abs(v1_ss.toFixed(3)) +'</b></h4><br>'+
                              '<h4>&#916;v<sub>2</sub> = <b>|'+ v2.toFixed(2) +' - '+ v_tb.toFixed(2) +' | = '+ Math.abs(v2_ss.toFixed(3)) +'</b></h4><br>'+
                              '<h4>&#916;v<sub>3</sub> = <b>|'+ v3.toFixed(2) +' - '+ v_tb.toFixed(2) +' | = '+ Math.abs(v3_ss.toFixed(3)) +'</b></h4><br>'+
                              '<h4>Sai số trung bình:</h4><br>'+
                              '<h4>&#916;&#8893; = '+
                                  '<span class="frac">'+
                                      '<tuso>'+
                                          '(&#916;v<sub>1</sub> + &#916;v<sub>2</sub> + &#916;v<sub>3</sub>)'+
                                       '</tuso>'+
                                       '<mauso>3</mauso>'+
                                    '</span> = '+
                                    '<span class="frac">'+
                                      '<tuso>('+ Math.abs(v1_ss.toFixed(3)) +' + '+ Math.abs(v2_ss.toFixed(3)) +' + '+ Math.abs(v3_ss.toFixed(3)) +' )</tuso>'+
                                      '<mauso>3</mauso>'+
                                     '</span>= <b>'+ vtb_ss.toFixed(2) +'</b> (m/s)'+
                              '</h4><br>'+
                              '<h4>Hay &#916;v = '+ vtb_ss.toFixed(2) +' x 3,6 = <b>'+ (vtb_ss * 3.6).toFixed(2) +'</b>(km/h)</h4><br> '+
                              '<h4>Vận tốc v = &#916;&#8893; &#177; &#916;v = <b>'+ v_km.toFixed(2) +' &#177; '+ (vtb_ss * 3.6).toFixed(2) +'</b> (km/h)</h4><br>'+
                              '<h4> <code>Kết quả</code>: <br> Vận tốc được xác định từ: <b>'+ (v_km - vtb_ss * 3.6).toFixed(2) +'</b> km/h đến <b>'+ (v_km + vtb_ss * 3.6).toFixed(2) +'</b> km/h</h4><br>'+
                            '</div>';
            $('#speed').empty();
            $('#speed').append(str);
          });
        });
    </script>
    @endsection