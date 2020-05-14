<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Illuminate\Http\Request;
use Owlcoder\Cms\Models\Image;
use Owlcoder\CmsShop\Forms\ProductForm;
use Owlcoder\CmsShop\Models\Product;
use Owlcoder\CmsShop\Models\ProductImage;
use Owlcoder\Common\Helpers\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function qty($id)
    {
        $model = \App\Models\Product::find($id);
        return view('cms-shop::admin.shop.product.qty', ['model' => $model]);
    }

    public function uploadPhotos(Request $request)
    {
        $pid = $request->route('id');
        $out = [];

        /** @var UploadedFile $file */
        foreach ($request->files->get('file') as $file) {


            $image = Image::CreateFromUploaded($file, '/uploads/products');

            $model = new ProductImage();
            $model->image_id = $image->id;
            $model->product_id = $pid;
            $model->save();

            $out[] = array_merge($model->toArray(), ['image' => $model->image->toArray()]);
        }

        return response()->json([
            'success' => count($out) > 0,
            'data' => $out,
        ]);
    }
}
