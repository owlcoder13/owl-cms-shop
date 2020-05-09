@extends('cms-shop::admin.shop.base')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! $form->render() !!}

        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </form>
@stop

@section('js')

    @parent

    <script>
        {!! $form->js() !!}
    </script>

@stop
