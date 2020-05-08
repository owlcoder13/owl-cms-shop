<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Models\ProductCategory;
use Owlcoder\Forms\Fields\SelectField;
use Owlcoder\Forms\Form;

class ProductForm extends Form
{
    public function getFields()
    {
        return [
            'name',
            'description',
            'code',
            'category_id' => [
                'class' => SelectField::class,
                'options'=>ProductCategory::all()->pluck('name', 'id'),
            ],
            'product_type_id',
        ];
    }
}
