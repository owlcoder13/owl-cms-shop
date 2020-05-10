<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Owlcoder\CmsShop\Forms\ProductForm;
use Owlcoder\CmsShop\Models\Product;

class ProductController extends BaseController
{
    public $baseName = 'product';
    public $modelClass = Product::class;
    public $formClass = ProductForm::class;

    public function productAttributes($id)
    {
        $model = Product::find($id);
        return $model->productType->attributes;
    }

    public function skus($id)
    {
        $product = Product::with(['skus', 'skus.attrs'])->where('id', $id)->first();
        print '<pre>';
        print_r($product->skus->toArray());
        exit();
    }
}
