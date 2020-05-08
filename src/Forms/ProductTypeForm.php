<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Models\Attribute;
use Owlcoder\CmsShop\Models\ProductTypeParam;
use Owlcoder\Forms\Fields\CheckBoxField;
use Owlcoder\Forms\Fields\ManyToOneModelsField;
use Owlcoder\Forms\Fields\SelectField;
use Owlcoder\Forms\Form;

class ProductTypeForm extends Form
{
    public function getFields()
    {
        return [
            'name',
            'description',
            'slug',
            'productTypeParams' => [
                'class' => ManyToOneModelsField::class,
                'modelClassName' => ProductTypeParam::class,
                'fkField' => 'product_type_id',
                'nestedConfig' => [
                    'fields' => [
                        'name',
                        'slug',
                        'attribute_id' => [
                            'class' => SelectField::class,
                            'options' => Attribute::all()->pluck('name', 'id'),
                        ],
                        'type' => [
                            'class' => SelectField::class,
                            'options' => ProductTypeParam::ProductTypeParamTypeNames(),
                        ],
                        'multiple' => ['class' => CheckBoxField::class],
                        'max_qty',
                    ],

                ],
            ],
        ];
    }
}
