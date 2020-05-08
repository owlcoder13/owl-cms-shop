@extends(config('cms.adminBaseView'))

@section('content')
    <h1>Attribute</h1>

    <div class="form-group">
        <a href="{{route('cms-shop.attribute.create')}}" class="btn btn-default">Create</a>
    </div>

    <?=
    \Owlcoder\Cms\Widgets\Grid::render([
        'model' => $model,
        'route' => 'cms-shop.attribute',
        'columns' => [
            'id',
            'name',
            'slug',
        ],
    ]);
    ?>
@stop
