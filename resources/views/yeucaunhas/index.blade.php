@extends('layouts.app_nha_ban')

@section('content')
<script type="text/javascript">
    function QuanTam($id){
        var request = $.ajax({
          url: "yeucaunha/follow",
          method: "POST",
          data: { id : $id, _token : "{{ csrf_token() }}" },
          dataType: "json"
        });
         
        request.done(function( msg ) {
            if(msg.success == 1){
                $("#add-product" + $id).css("display", 'none');
                $("#remove-product" + $id).css("display", 'block');
            }else{
                alert("Có vấn đề xảy ra trong quá trình xóa, xin hãy báo cho người quản trị \nEmail: tran.thanh.tuan269@gmail.com \nXin chân thành cảm ơn Quý khách!");
                window.setTimeout('location.reload()', 1000);
            }

          //$( "#log" ).html( msg );
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    }

    function BoQuanTam($id){
        var request = $.ajax({
          url: "yeucaunha/remove_follow",
          method: "POST",
          data: { id : $id, _token : "{{ csrf_token() }}" },
          dataType: "json"
        });
         
        request.done(function( msg ) {
            if(msg.success == 1){
                $("#remove-product" + $id).css("display", 'none');
                $("#add-product" + $id).css("display", 'block');
                window.setTimeout('location.reload()', 1000);
            }else{
                alert("Có vấn đề xảy ra trong quá trình xóa, xin hãy báo cho người quản trị \nEmail: tran.thanh.tuan269@gmail.com \nXin chân thành cảm ơn Quý khách!");
                window.setTimeout('location.reload()', 1000);
            }

          //$( "#log" ).html( msg );
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Kết quả tìm kiếm</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
        <?php 
            if(count($tinbdss) <= 0) echo '<div class="text-center">Hiện tại, không tìm thấy bất động sản nào phù hợp! <br />Chúng tôi sẽ thông báo tới bạn ngay khi có nhà phù hợp! <br />Xin cảm ơn!</div>';
            foreach ($tinbdss as $tinbds) {
                $temp = substr($tinbds->images,0,-1);
                $images = explode( ';', $temp ); 
                //var_dump($tinbds);
                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 image-product">
                <div class="col-xs-4 col-md-4 col-sm-12 image-prod">
                    <a href="{{URL::to('/')}}/{{ $tinbds->tin_id }}"><img src="{{ URL::to('/') }}/images/{{ $images[0] }}" class="img-thumbnail" alt="Responsive image"></a>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-12 price-prod">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <span class="price-product">{{ $tinbds->gia / 1000000000 }} tỷ </span> - <span class="size-product">{{ $tinbds->dien_tich }} m<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12 address-product">
                            {{$tinbds->ten_huyen}} - {{$tinbds->ten_tinh}}.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h4 class="title-product">
                                {{ $tinbds->tieu_de }}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div id="add-product-{{ $tinbds->tin_id }}" class="btn btn-primary btn-block" onclick="QuanTam({{ $tinbds->tin_id }})" style="display:none;">Quan tâm</div>
                            <div id="remove-product-{{ $tinbds->tin_id }}" class="btn btn-danger btn-block" onclick="BoQuanTam({{ $tinbds->tin_id }})" style="display:none;">Bỏ quan tâm</div>
                        </div>
                    </div>
                </div>
                
            </div>
        <?php 
        }
        ?>
        </div>
        <div class="row text-center">
            {{ $tinbdss->links() }}
        </div>
        <div class="row text-center">
            <?php 
                if(count($tinbdss) <= 0){
                    ?>
                    <a class="btn btn-default">Trở về trang chủ</a>
            <?php
                }else{
                ?>
            <div class="btn btn-primary" data-toggle="modal" data-target="#myModal">Gửi Email cho tôi</div>
            <a class="btn btn-default">Trở về trang chủ</a>
            <?php 
                }
                ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Gửi Email cho tôi</h4>
      </div>
      <div class="modal-body">
        Một email bao gồm tất cả thông tin về những căn nhà mà Quý khách quan tâm sẽ được gửi tới Quý khách. Đồng thời với mỗi căn nhà, chủ nhà cũng nhận được email thông tin của Quý khách khi Quý khách thích căn nhà của họ. Hy vọng việc này sẽ giúp Quý khách và chủ nhà có những tương tác sớm, giúp Quý khách mua được căn nhà ưng ý. <br/>
        Với mỗi căn nhà, website sẽ thu 10.000 vnđ phí duy trì dịch vụ. Số tiền này sẽ được dùng để liên hệ kiểm tra nhà đã được bán chưa trước khi giới thiệu đến Quý khách. Cám ơn Quý khách đã sử dụng dịch vụ của <span class="chodatso">chodatso.com</span>.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Thanh toán và gửi email</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
      </div>
    </div>
  </div>
</div>
        
@endsection
