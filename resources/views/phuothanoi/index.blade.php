@extends('layouts.app')

@section('content')

<h1 class="text-center">Danh sách tin</h1>
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
@if ($tinbdss->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="10%">Ảnh đại diện</th>
                <th width="90%">Thông tin chi tiết</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tinbdss as $tinbds)
                <tr>
                    <td>
                    <?php 
                        $images = explode( ';', $tinbds->images ); 
                    ?>
                    <img src="{{ URL::to('/') }}/images/{{ $images[0] }}" alt="" width="120px" /></td>
                    <td>
                        <div class="big-field"><h4>{{ $tinbds->tieu_de }}</h4></div>
                        <div class="big-field">Mô tả: {{ $tinbds->mo_ta }}</div>
                        
                        <div>
                        <a class="btn btn-primary btn-xed" href="{{URL::to('/')}}/{{ $tinbds->id }}">Xem</a>
                        {{ link_to_route('tinbds.edit', 'Sửa', array($tinbds->id), array('class' => 'btn btn-info btn-xed')) }}
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tinbds.destroy', $tinbds->id)))}}                       
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xed')) }}
                        {{ Form::close() }}
                        </div>
                        <div class="clear-fix"></div>
                    </td>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>

    <div class="row text-center">
        {{ $tinbdss->links() }}
    </div>
@else
    Chưa có tinbds nào!
@endif
</div>
@stop