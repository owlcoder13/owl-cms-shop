<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Models\ProductCategory;
use Owlcoder\CmsShop\Models\ProductType;
use Owlcoder\Forms\Fields\DivField;
use Owlcoder\Forms\Fields\EditorField;
use Owlcoder\Forms\Fields\SelectField;
use Owlcoder\Forms\Form;

class ProductForm extends Form
{
    public function getFields()
    {
        return [
            'name',
            'description' => ['class' => EditorField::class],
            'code',
            'category_id' => [
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductCategory::all()->pluck('name', 'id')->toArray(),
            ],
            'product_type_id' => [
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductType::all()->pluck('name', 'id')->toArray(),
            ],
            'skus' => [
                'class' => DivField::class,
                'func' => 'productAdminSkus'
            ],
        ];
    }
}
