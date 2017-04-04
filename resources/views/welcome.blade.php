@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row main-content">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                <li data-target="#carousel-example-generic" data-slide-to="5"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src="{{ url('/') }}/images/1.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 1</h3>
                    <p>Description</p>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ url('/') }}/images/2.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 2</h3>
                    <p>Description</p>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ url('/') }}/images/3.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 3</h3>
                    <p>Description</p>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ url('/') }}/images/4.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 4</h3>
                    <p>Description</p>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ url('/') }}/images/5.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 5</h3>
                    <p>Description</p>
                  </div>
                </div>
                <div class="item">
                  <img src="{{ url('/') }}/images/6.jpg" alt="">
                  <div class="carousel-caption">
                    <h3>Tour 6</h3>
                    <p>Description</p>
                  </div>
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
    </div>
    <div class="row sub-content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Giới thiệu</div>
                <div class="panel-body">
                    <?php 
                        echo $trangchu->textout; 
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if(sizeof($tourinmonth) > 0){ ?>
    <div class="row sub-content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Các tour trong tháng</div>
                <div class="panel-body">
                    <div class="row">
                        <?php 
//                            var_dump($tourinmonth);die;
                            if(sizeof($tourinmonth) > 0){ 
                                foreach ($tourinmonth as $tour){
                                    $temp = substr($tour->images,0,-1);
                                    $images = explode( ';', $temp );
                            ?>
                            <div class="col-md-3">
                                <div class="image-tour"><a href="{{ url('/') }}/xem-tour/{{$tour->id}}"><img src="{{ url('/') }}/images/{{$images[0]}}" width="100%" height="193" class="thumbnail"></a></div>
                                <div class="name-tour">{{$tour->ten_tour}}</div>
                                <div class="sub-desc-tour">{{substr(date_format(date_create($tour->ngay_khoi_hanh),"d/m/Y H:i:s"),0,10)}}</span> - <span class="date-start">{{substr(date_format(date_create($tour->ngay_ket_thuc),"d/m/Y H:i:s"),0,10)}}</div>
                            </div>
                        <?php 
                                }
                            }else{ ?>
                        <div class="col-md-12">
                            <div class="desc-tour">Không có tour nào được tìm thấy trong tháng này!</div>
                        </div>
                        <?php } ?>
                    </div>
                    <hr />
                    <div class="row text-center">
                        <button class="btn btn-primary" id="xem-them-tour-trong-thang">Xem thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="row sub-content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Các địa danh</div>

                <div class="panel-body">
                    <div class="row">
                        <?php
                        foreach ($diadanhs as $diadanh){
                            $temp = substr($diadanh->images,0,-1);
                            $images = explode( ';', $temp ); 
                        ?>
                        <div class="col-md-3">
                            <div class="image-tour"><a href="{{ url('/') }}/xem-dia-danh/{{$diadanh->id}}"><img src="{{ url('/') }}/images/{{$images[0]}}" width="100%" class="thumbnail"></a></div>
                            <div class="name-tour">{{$diadanh->ten_diadanh}}</div>
                            <div class="desc-tour"><?php echo $diadanh->sub_mo_ta; ?></div>
                        </div>
                        <?php } ?>
                    </div>
                    <hr />
                    <div class="row text-center">
                        <button class="btn btn-primary" id="xem-them-dia-danh">Xem thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row sub-content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách hướng dẫn viên</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/dan-truong.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">ĐAN TRƯỜNG</div>
                            <div class="sub-desc-tour">HDV được ưa thích nhất năm 2000.</div>
                            <div class="desc-tour">Đan Trường là một nam ca sĩ nổi tiếng người Việt Nam xuất hiện vào những năm cuối thập niên 90, Với ngoại hình điển trai, phong cách âm nhạc lôi cuốn, anh được mệnh danh là Hoàng tử V-Pop.</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/lam-truong.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">LAM TRƯỜNG</div>
                            <div class="sub-desc-tour">HDV được ưu thích nhất 1999.</div>
                            <div class="desc-tour">Tiêu Lam Trường là một ca sĩ, diễn viên Việt Nam. Lam Trường thường được người hâm mộ gọi thân mật là "Anh Hai" và thường viết là "A2". Anh là con út trong một gia đình người Việt gốc Hoa.</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/ung-hoang-phuc.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">ƯNG HOÀNG PHÚC</div>
                            <div class="sub-desc-tour">HDV được ưu thích nhất 2004.</div>
                            <div class="desc-tour">Ưng Hoàng Phúc, sinh ngày 18 tháng 8 năm 1981 tại An Giang, tên thật là Nguyễn Quốc Thanh, từng là ca sĩ độc quyền của công ty Thế giới Giải Trí.</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/dang-khoi.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">ĐĂNG KHÔI</div>
                            <div class="sub-desc-tour">HDV được ưu thích nhất 2005.</div>
                            <div class="desc-tour">Đăng Khôi tên đầy đủ là Nguyễn Đăng Khôi, sinh ngày 28 tháng 11 năm 1983. Là thành viên cũ của nhóm New Stars, hiện tại là ca sĩ hoạt động độc lập.</div>
                        </div>
                    </div>
                    <hr />
                    <div class="row text-center">
                        <button class="btn btn-primary" id="xem-them-hdv">Xem thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.carousel').carousel();
    $( document ).ready(function() {
        $("#xem-them-hdv").click(function(){
            window.location.href = "{{ url('/huong-dan-vien') }}";
        });
        
        $("#xem-them-tour").click(function(){
            window.location.href = "{{ url('/xem-tour') }}";
        });
        
        $("#xem-them-tour-trong-thang").click(function(){
            window.location.href = "{{ url('/xem-tour-thang') }}";
        });
        
        $('#xem-them-dia-danh').click(function(){
            window.location.href = "{{ url('/xem-dia-danh') }}";
        });
    });
</script>
@endsection
