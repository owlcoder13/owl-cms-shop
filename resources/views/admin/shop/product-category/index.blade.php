@extends('cms-shop::admin.shop.base')

@section('content')
    <h1>Product category</h1>

    <div class="form-group">
        <a href="{{route('cms-shop.product-category.create')}}" class="btn btn-default">Create</a>
    </div>

    <?=
    \Owlcoder\Cms\Widgets\Grid::render([
        'model' => $model,
        'route' => 'cms-shop.product-category',
        'columns' => [
            'id',
            'name',
            'slug',
            [
                'tdAttributes' => ['class' => 'text-right'],
                'class' => \Owlcoder\Cms\Widgets\ButtonColumn::class,
                'updateUrl' => function ($item) {
                    return route('cms-shop.product-category.update', ['id' => $item->id]);
                },
                'deleteUrl' => function ($item) {
                    return route('cms-shop.product-category.delete', ['id' => $item->id]);
                }
            ]
        ],
    ]);
    ?>
@stop
