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
                    The standard Lorem Ipsum passage, used since the 1500s

                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

                    Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

                    "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"

                    1914 translation by H. Rackham

                    "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"

                    Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."

                    1914 translation by H. Rackham

                    "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."
                </div>
            </div>
        </div>
    </div>

    <div class="row sub-content">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Các tour trong tháng</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/tam-coc.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">Tam Cốc - Bích Động</div>
                            <div class="sub-desc-tour">20/3/2016 - 22/3/2016</div>
                            <div class="desc-tour">Tam Cốc - Bích Động được ví như “Hạ Long trên cạn" của Ninh Bình. Tam Cốc có nghĩa là ba hang. Đó là hang Cả, hang Hai và hang Ba. Cả ba hang đều được tạo thành bởi dòng sông Ngô Đồng đâm xuyên qua núi.</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/dau-go.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">Hang Đầu Gỗ</div>
                            <div class="sub-desc-tour">24/3/2016 - 26/3/2016</div>
                            <div class="desc-tour">Hang Đầu Gỗ nằm trên đảo Đầu Gỗ thuộc vịnh Hạ Long, tỉnh Quảng Ninh. Cuốn Kỳ quan thế giới của Pháp xuất bản năm 1938 đã gọi hang Đầu Gỗ là Grotte des merveilles (động của các kỳ quan).</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/thien-cung.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">Động Thiên Cung</div>
                            <div class="sub-desc-tour">26/3/2016 - 28/3/2016</div>
                            <div class="desc-tour">Động Thiên Cung ở phía bắc đảo Đầu Gỗ. Cổng động hẹp, nhưng khi bước vào trong, bạn sẽ ngỡ ngàng với độ rộng của lòng hang.</div>
                        </div>
                        <div class="col-md-3">
                            <div class="image-tour"><img src="{{ url('/') }}/images/thach-dong.jpg" width="100%" class="thumbnail"></div>
                            <div class="name-tour">Thạch Động</div>
                            <div class="sub-desc-tour">28/3/2016 - 30/3/2016</div>
                            <div class="desc-tour">Thạch Động có hai cửa hang chính. Một cửa hướng thị xã Hà Tiên, cửa còn lại hướng về phía cánh đồng Mỹ Đức. Trong hang có chùa Tiên Sơn xây dựng bằng gỗ từ năm 1790. Năm 2003, chùa đã được tu sửa lại.</div>
                        </div>
                    </div>
                    <hr />
                    <div class="row text-center">
                        <button class="btn btn-primary" id="xem-them-tour-trong-thang">Xem thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
