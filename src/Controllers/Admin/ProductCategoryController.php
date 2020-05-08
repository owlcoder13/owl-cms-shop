<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Owlcoder\CmsShop\Forms\ProductCategoryForm;
use Owlcoder\CmsShop\Models\ProductCategory;

class ProductCategoryController extends BaseController
{
    public $baseName = 'product-category';
    public $modelClass = ProductCategory::class;
    public $formClass = ProductCategoryForm::class;
}
