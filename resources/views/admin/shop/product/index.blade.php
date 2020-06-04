@extends('cms-shop::admin.shop.base')

@section('content')
    <h1>Product</h1>

    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <a href="{{route('cms-shop.product.create')}}" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus-sign"></i> Create
                </a>
            </div>
        </div>
        <div class="box-body no-padding">
            <table class="table">
                <thead>
                <th></th>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Product type</th>
                <th>Slug</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($model as $item)
                    <tr>
                        <td>
                            <input name="ids[]" type="checkbox" value="{{$item->id}}">
                        </td>
                        <td>
                            {{$item->id}}
                        </td>
                        <td>
                            <img
                                style="max-width:150px;"
                                src="{{$item->image->path}}"
                                class="thumbnail" alt="">
                        </td>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->productType->name ?? ''}}
                        </td>
                        <td>
                            {{$item->slug}}
                        </td>
                        <td class="text-right">
                            <a class="btn btn-default btn-xs"
                               href="{{route('cms-shop.product.update', ['id' => $item->id])}}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a class="btn btn-default btn-xs" onclick="return confirm('Are you sure?')"
                               href="{{route('cms-shop.product.delete', ['id' => $item->id])}}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            {!! $model->links() !!}--}}
        </div>
    </div>
@stop
