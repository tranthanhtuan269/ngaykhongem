<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="fb:app_id" content="317838401932364" />
    <meta property="og:title" content="@yield('fb_title')" />
    <meta property="og:description" content="@yield('fb_description')" />
    <meta property="og:image" content="@yield('fb_image')" />
    <meta property="og:url" content="@yield('fb_url')" />
    
    <title>Moc backpacking</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('/') }}/images/logo.jpg">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/') }}/css/pickmeup.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/jquery.toast.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/app.css">
    <script type="text/javascript" src="{{ url('/') }}/js/pickmeup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/jquery.toast.js"></script>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style> 
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body id="app-layout">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=317838401932364";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/') }}/images/logo.jpg" alt="" width="50" class="logo-img">
                    <div class="company-name">Moc backpacking</div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right top-bar">
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tour của chúng tôi <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/tour-leo-nui') }}">Tour trải nghiệm leo núi</a></li>
                            <li><a href="{{ url('/tour-di-bo') }}">Tour đi bộ qua các bản làng</a></li>
                            <li><a href="{{ url('/tour-bien-dao') }}">Tour biển đảo</a></li>
                            <li><a href="{{ url('/tour-cam-trai') }}">Tour cắm trại</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nhật ký hành trình <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/nhatkyhanhtrinh') }}">Xem nhật ký hành trình</a></li>
                            <li><a href="{{ url('/nhatkyhanhtrinh/create') }}">Viết nhật ký</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/huong-dan-vien') }}">Hướng dẫn viên</a></li>
                        <li><a href="{{ url('/xem-dia-danh') }}">Địa danh</a></li>
                        <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
                    @elseif(Auth::user()->id == 11262 || Auth::user()->id == 11264 || Auth::user()->id == 11265 || Auth::user()->id == 1 )
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">HDV <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/hdv/') }}">Danh sách HDV</a></li>
                                <li><a href="{{ url('/hdv/create') }}">Tạo mới HDV</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tour <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/tour/') }}">Danh sách Tour</a></li>
                                <li><a href="{{ url('/tour/create') }}">Tạo mới Tour</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Địa Danh <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/diadanh/') }}">Danh sách địa danh</a></li>
                                <li><a href="{{ url('/diadanh/create') }}">Tạo mới địa danh</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trang <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/sua-gioi-thieu') }}">Sửa trang chủ</a></li>
                                <li><a href="{{ url('/edit-about') }}">Sửa giới thiệu</a></li>
                                <li><a href="{{ url('/edit-xu-menh') }}">Sửa xứ mệnh</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Đăng xuất</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Đăng xuất</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">@yield('content')</div>
        </div>
    </div>
    
    <link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
</body>
</html>
