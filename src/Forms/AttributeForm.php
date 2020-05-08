<?php

namespace Owlcoder\CmsShop\Forms;

use Owlcoder\CmsShop\Models\AttributeItem;

use Owlcoder\Forms\Fields\ManyToOneModelsField;
use Owlcoder\Forms\Fields\TextAreaField;
use Owlcoder\Forms\Form;

class AttributeForm extends Form
{
    public function getFields()
    {
        return [
            'name',
            'slug',
            'description' => ['class' => TextAreaField::class],
            'items' => [
                'class' => ManyToOneModelsField::class,
                'modelClassName' => AttributeItem::class,
                'fkField' => 'attribute_id',
                'nestedConfig' => [
                    'fields' => [
                        'name',
                        'slug',
                    ],
                ],
            ],
        ];
    }
}
