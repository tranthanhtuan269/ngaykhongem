@extends('layouts.app')

@section('content')

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách nhật ký</h3>
    </div>
    <div class="panel-body">
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
        @if ($diadanhs->count())
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10%">Ảnh đại diện</th>
                        <th width="90%">Thông tin chi tiết</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($diadanhs as $diadanh)
                        <tr>
                            <td>
                            <?php 
                                $images = explode( ';', $diadanh->images ); 
                            ?>
                            <img src="{{ URL::to('/') }}/images/{{ $images[0] }}" alt="" width="200px" /></td>
                            <td>
                                <div class="big-field"><h4>{{ $diadanh->ten_diadanh }}</h4></div>
                                <div class="big-field"><?php echo $diadanh->sub_mo_ta; ?></div>

                                <a class="btn btn-primary btn-xed" href="{{URL::to('/')}}/nhatkyhanhtrinh/{{ $diadanh->id }}">Xem</a>
                                <?php if(Auth::user()->id == 11262 || Auth::user()->id == 11264 || Auth::user()->id == 11265 || Auth::user()->id == 1 ){ ?>
                                <div>
                                {{ link_to_route('nhatkyhanhtrinh.edit', 'Sửa', array($diadanh->id), array('class' => 'btn btn-info btn-xed')) }}
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('nhatkyhanhtrinh.destroy', $diadanh->id), 'class'=>'delete_btn'))}}                       
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xed')) }}
                                {{ Form::close() }}
                                </div>
                                <?php } ?>
                                <div class="clear-fix"></div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="text-center">
                {{ $diadanhs->links() }}
            </div>
        @else
            Chưa có địa danh nào!
        @endif
        </div>
    </div>
</div>
@stop