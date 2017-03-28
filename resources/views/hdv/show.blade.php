@extends('layouts.app')

@section('content')
<div class="panel panel-default main-content xem-tour">
    <div class="panel-heading">
        <h3 class="panel-title">Xem HDV</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            
        <?php 
            if(count($hdv) <= 0) :
                echo "Không có tour nào được tìm thấy!";
            else :
                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 product">
                <div class="col-xs-4 col-md-4 col-sm-12 image-prod">
                    <a href="{{URL::to('/')}}/xem-tour/{{ $hdv->id }}"><img src="{{ URL::to('/') }}/images/{{ $hdv->avatar }}" class="img-thumbnail" alt="Responsive image"></a>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-12 detail-prod">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <span class="name-tour"> {{ $hdv->name }} </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h4 class="title-product">
                                <?php echo $hdv->tieu_su; ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            endif
        ?>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        
    });
</script>
@endsection
