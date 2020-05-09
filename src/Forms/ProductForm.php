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
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductCategory::all()->pluck('name', 'id')->toArray(),
            ],
            'product_type_id',
        ];
    }
}
