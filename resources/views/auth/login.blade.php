@extends('layouts.app')

@section('title')
    chodatso.com | Đăng nhập
@stop

@section('description')
    Đăng nhập tài khoản chodatso.com.
@stop

@section('content')

<?php 
    require_once __DIR__ . '/Facebook/autoload.php';

    session_start();
    $fb = new Facebook\Facebook([
      'app_id' => '317838401932364', // Replace {app-id} with your app id
      'app_secret' => '2301dd0b517e64b0d340298b5ef300a1',
      'default_graph_version' => 'v2.2',
      ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl(url('/facebook/callback'), $permissions);
?>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Đăng nhập</h3>
    </div>
    <div class="panel-body">
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
                    
                    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Log in with Facebook!</a>;

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Quên mật khẩu?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection