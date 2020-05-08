<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Owlcoder\CmsShop\Forms\AttributeForm;
use Owlcoder\CmsShop\Models\Attribute;


class AttributeController extends BaseController
{
    public $baseName = 'attribute';
    public $modelClass = Attribute::class;
    public $formClass = AttributeForm::class;
}
