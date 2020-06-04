@extends('cms-shop.admin.shop.base')

@section('content')
    <h1>Product quantity #{{$model->id}}</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($model->skus as $k => $sku)
            <tr>
                <td>

                </td>
                <td>
                    @foreach($sku->attrs as $key => $item)
                        {{$item}}
                    @endforeach
                </td>
                <td>зрз
                    <input name="sku[{{$k}}][id]" value="{{$sku->id}}"/>
                    <input name="sku[{{$k}}][qty]" value="{{$sky->qty}}"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
