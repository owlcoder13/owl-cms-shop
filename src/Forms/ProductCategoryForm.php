<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Models\AttributeItem;

use Owlcoder\CmsShop\Models\ProductCategory;
use Owlcoder\Forms\Fields\SelectField;
use Owlcoder\Forms\Fields\TextAreaField;
use Owlcoder\Forms\Form;

class ProductCategoryForm extends Form
{
    public function getFields()
    {
        return [
            'name',
            'slug',
            'description' => ['class' => TextAreaField::class],
            'parent_id' => [
                'nullIfEmpty' => true,
                'class' => SelectField::class,
                'options' => [null => null] + ProductCategory::all()->pluck('name', 'id')->toArray(),
            ],
        ];
    }
}
