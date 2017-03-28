@extends('layouts.app')

@section('content')
<div class="panel panel-default main-content xem-tour">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách HDV</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            
        <?php 
//            var_dump($tourdats);die;
            if(count($hdvs) <= 0) :
                echo "Không có Hướng dẫn viên nào được tìm thấy!";
            else :
            foreach ($hdvs as $hdv) {                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 product">
                <div class="col-xs-4 col-md-4 col-sm-12 image-prod">
                    <a href="{{URL::to('/')}}/tour/{{ $hdv->id }}"><img src="{{ URL::to('/') }}/images/{{ $hdv->avatar }}" class="img-thumbnail" alt="Responsive image"></a>
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
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            {{ link_to_route('hdv.show', 'Xem', array($hdv->id), array('class' => 'btn btn-primary')) }}
                            {{ link_to_route('hdv.edit', 'Sửa', array($hdv->id), array('class' => 'btn btn-info')) }}
                            
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('hdv.destroy', $hdv->id), 'class'=>'delete_btn' )) }}                       
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
        </div>
        <div class="row text-center">
            {{ $hdvs->links() }}
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
