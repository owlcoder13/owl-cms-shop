@extends(config('cms.adminBaseView'))

@section('content')
    <h1>Product type</h1>

    <div class="form-group">
        <a href="{{route('cms-shop.product-type.create')}}" class="btn btn-default">Create</a>
    </div>

    <?=
    \Owlcoder\Cms\Widgets\Grid::render([
        'model' => $model,
        'route' => 'cms-shop.product-type',
        'columns' => [
            'id',
            'name',
            'slug',
        ],
    ]);
    ?>
@stop
