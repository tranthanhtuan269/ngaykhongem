@extends('layouts.app')

@section('content')
<?php var_dump($arrayfollow); ?>
<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách nhật ký</h3>
    </div>
    <div class="panel-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="table-responsive">
        @if ($diadanhs->count())
            @foreach ($diadanhs as $diadanh)
            <div class="row diadanh-item">
                <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                <?php 
                    $images = explode( ';', $diadanh->images ); 
                ?>
                    <a href="{{URL::to('/')}}/xem-dia-danh/{{ $diadanh->id }}"><img src="{{ URL::to('/') }}/images/{{ $images[0] }}" alt="" width="200px" height="133px" /></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="big-field"><h4>{{ $diadanh->ten_diadanh }}</h4></div>
                    <div class="big-field"><?php echo $diadanh->sub_mo_ta; ?></div>

                    <div>
                    <a class="btn btn-primary btn-xed" href="{{URL::to('/')}}/xem-dia-danh/{{ $diadanh->id }}">Xem</a>
                    @if(!in_array($diadanh->id, $arrayfollow))<button class="btn btn-primary btn-xed follow-tour" data-accept-id="{{ $diadanh->id }}">Đặt tour</button>
                    @endif
                    </div>
                    <div class="clear-fix"></div>
                </div>
            </div>
            @endforeach

            <div class="row text-center">
                {{ $diadanhs->links() }}
            </div>
        @else
            Chưa có nhật ký nào!
        @endif
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".follow-tour").click(function(){
        var _sefl = $(this);
        
        var id = $(this).attr('data-accept-id');
        
        var request = $.ajax({
            url: "{{ URL::to('/') }}/follow-dia-danh/" + id,
            method: "POST",
            data: { 
                "id" : id, 
                "_token" : "{!! csrf_token() !!}",
            },
            dataType: "json"
        });

        request.done(function( msg ) {
            if(msg.code==1){
                $.toast({
                    text: 'Bạn đã đăng kí thành công! <br />Email thông báo sẽ được gửi cho bạn khi có tour mới! Xin cám ơn!', // Text that is to be shown in the toast
                    heading: 'Đăng kí thành công', // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
                _sefl.hide();
            }else if(msg.code==0){
                $.toast({
                    text: 'Hệ thống không tìm thấy Địa danh bạn muốn đăng kí. <br />Xin hãy liên hệ ban quản trị!', // Text that is to be shown in the toast
                    heading: 'Đăng kí không thành công', // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
            }else if(msg.code==3){
                $.toast({
                    text: 'Bạn phải đăng nhập để sử dụng dịch vụ này! Xin cám ơn!', // Text that is to be shown in the toast
                    heading: 'Đăng kí không thành công', // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'mid-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
                
                window.setTimeout(function() {
                    window.location.href = "{{ URL::to('/') }}/login";
                }, 5000);
            }
        });

        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    });
});
</script>
@stop