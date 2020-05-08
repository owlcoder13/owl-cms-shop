<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Owlcoder\CmsShop\Forms\ProductTypeForm;
use Owlcoder\CmsShop\Models\ProductType;

class ProductTypeController extends BaseController
{
    public $baseName = 'product-type';
    public $modelClass = ProductType::class;
    public $formClass = ProductTypeForm::class;
}
