@extends('layouts.app')

@section('content')

<div class="panel panel-default  main-content xem-tour">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách tour</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            
        <?php 
            if(count($users) <= 0) :
                echo "Không có hướng dẫn viên nào được tìm thấy!";
            else :
            foreach ($users as $user) {
                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 product">
                <div class="col-xs-3 col-md-3 col-sm-12 image-prod">
                    <img src="{{ URL::to('/') }}/images/{{ $user->avatar }}" class="img-thumbnail" alt="Responsive image">
                </div>
                <div class="col-xs-9 col-md-9 col-sm-12 detail-prod">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <span class="name-tour"> {{ $user->name }} </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h4 class="title-product">
                                {{ $user->tieu_su }}
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary">Theo dõi</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
        </div>
        <div class="row text-center">
            {{ $users->links() }}
        </div>
        <?php
            endif
        ?>
    </div>
</div>
@endsection
