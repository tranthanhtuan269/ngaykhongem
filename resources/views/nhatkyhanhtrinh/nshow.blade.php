@extends('layouts.app')

@section('content')

<div class="panel panel-primary main-content">
    <div class="panel-heading">{{ $diadanh->ten_diadanh }}</div>
    <div class="panel-body">            
        <div class="row">
            <div class="col-xs-12 col-md-12 show-detail"><?php echo $diadanh->mo_ta; ?></div>
        </div>
    </div>
</div>

<p>
    <a class="btn btn-primary btn-xed" href="{{URL::to('/')}}/xem-dia-danh">Danh sách nhật ký</a>
    @if (!Auth::guest())
    <button type="button" class="btn btn-primary" id="follow_diadanh" data-accept-id="{{$diadanh->id}}">
        Đăng kí tour sớm nhất
    </button
    @else
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Đăng kí tour sớm nhất
    </button
    @endif
</p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Thư điện tử</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Nhớ mật khẩu
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Đăng nhập
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Quên mật khẩu?</a>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("#follow_diadanh").click(function(){
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
                    text: 'Hệ thống không tìm thấy nhật ký bạn muốn đăng kí. <br />Xin hãy liên hệ ban quản trị!', // Text that is to be shown in the toast
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
            }
        });

        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    });
});
</script>
@stop