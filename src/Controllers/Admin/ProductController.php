<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Owlcoder\CmsShop\Forms\ProductForm;
use Owlcoder\CmsShop\Models\Product;

class ProductController extends BaseController
{
    public $baseName = 'product';
    public $modelClass = Product::class;
    public $formClass = ProductForm::class;
}
