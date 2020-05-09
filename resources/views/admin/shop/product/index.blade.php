@extends('cms-shop::admin.shop.base')

@section('content')
    <h1>Product type</h1>

    <div class="form-group">
        <a href="{{route('cms-shop.product.create')}}" class="btn btn-default">Create</a>
    </div>

    <?=
    \Owlcoder\Cms\Widgets\Grid::render([
        'model' => $model,
        'route' => 'cms-shop.product',
        'columns' => [
            'id',
            'name',
            'slug',
        ],
    ]);
    ?>
@stop
