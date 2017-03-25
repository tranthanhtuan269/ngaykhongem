@extends('layouts.app')

@section('content')
<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Giới thiệu</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Về chúng tôi</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row end-row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                {{$abc['gioi_thieu']}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tầm nhìn và xứ mệnh</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row end-row">
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                {{$abc['xu_menh']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
