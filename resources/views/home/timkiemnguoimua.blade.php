@extends('layouts.app_nguoi_mua')

@section('content')

<h1 class="text-center">Danh sách người mua</h1>
<hr>

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
@if ($yeucaunhas->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="10%">Ngày đăng</th>
                <th width="90%">Thông tin chi tiết</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($yeucaunhas as $yeucaunha)
                <tr>
                    <td>
                      <?php 
                        $date = new DateTime($yeucaunha->create_at);
                        echo $date->format('Y-m-d') . "<br>";  // UTC time
                      ?>
                    <td>
                        <div class="big-field">
                          <h4> 
                          <?php if($yeucaunha->ten_duong != null) echo $yeucaunha->ten_duong . ', '; ?> 
                          <?php if($yeucaunha->ten_pho != null) echo $yeucaunha->ten_pho . ', '; ?> 
                          <?php if($yeucaunha->ten_huyen != null) echo $yeucaunha->ten_huyen . ', '; ?>
                          <?php if($yeucaunha->ten_tinh != null) echo $yeucaunha->ten_tinh; ?>
                          </h4>
                        </div>
                        <div class="big-field">Người đăng: {{ $yeucaunha->name }} <span class="alert alert-danger">Mua gấp</span></div>
                        <div class="big-field">Điện thoại: {{ $yeucaunha->phone }}</div>
                        <div class="big-field">Tầm tiền: <span class="price-format"> {{ $yeucaunha->tam_tien / 1000000000 }}</span> tỷ VNĐ</div>

                        <div class="big-field">Loại nhà: {{ $yeucaunha->loai_bds }}</div>

                        <div class="big-field">Diện tích: {{ $yeucaunha->dien_tich }} m <sup>2</sup></div>
                        <div class="big-field">Mặt tiền: {{ $yeucaunha->mat_tien }} m</div>
                        <div class="big-field">Đường vào: {{ $yeucaunha->duong_vao }} m</div>
                        <div class="big-field">Số tầng: {{ $yeucaunha->tang }} tầng</div>

                        <div class="big-field">Hướng nhà: {{ $yeucaunha->ten_huong }}</div>
                        <div class="big-field">Số phòng ngủ: {{ $yeucaunha->phong_ngu }} phòng</div>
                        <div class="big-field">Số phòng khách: {{ $yeucaunha->phong_khach }} phòng</div>
                        <div class="big-field">Số phòng vệ sinh: {{ $yeucaunha->wc }} phòng</div>
                        <div class="big-field">Mua để:
                        <?php 
                          $kinh_doanh = $yeucaunha->kinh_doanh;
                          $dau_tu = $yeucaunha->dau_tu;
                          $de_o = $yeucaunha->de_o;
                          if($kinh_doanh +  $dau_tu + $de_o == 3){
                            echo 'Kinh doanh, đầu tư và để ở';
                          }
                          else if($kinh_doanh +  $dau_tu + $de_o == 2){
                            if($kinh_doanh + $dau_tu > 1)
                              echo 'Kinh doanh và đầu tư';
                            if($kinh_doanh + $de_o > 1)
                              echo 'Kinh doanh và để ở';
                            if($dau_tu + $de_o > 1)
                              echo 'Đầu tư và để ở';
                          }
                          else if($kinh_doanh +  $dau_tu + $de_o == 1){
                          if($kinh_doanh) echo 'Kinh doanh';
                            if($dau_tu) echo 'Đầu tư';
                            if($de_o) echo 'Để ở';
                          }
                          ?>
                        </div>
                        <div class="clear-fix"></div>
                    </td>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>

    <div class="row text-center">
        {{ $yeucaunhas->links() }}
    </div>
@else
    Chưa có yêu cầu nhà nào!
@endif
</div>
@stop