<?php

namespace Owlcoder\CmsShop\Forms\Fields;

use \Owlcoder\Common\Helpers\Html;
use Owlcoder\Forms\Fields\Field;

class ProductPhotosField extends Field
{
    public $canApply = false;

    public function fetchData()
    {
        $out = [];
        foreach ($this->instance->productImages as $productImage) {
            $out[] = array_merge($productImage->toArray(), ['image' => $productImage->image->toArray()]);
        }

        $this->value = json_encode($out);
    }

    public function renderInput()
    {
        $container = Html::tag('div', '', ['class' => 'container']);
        $download = Html::tag('input', '', ['type' => 'file', 'multiple' => true, 'class' => 'files']);
        return Html::tag('div', $download . $container, [
            'data-data' => $this->value,
            'id' => $this->id,
            'data-id' => $this->instance->id,
        ]);
    }

    public function js()
    {
        return file_get_contents(__DIR__ . '/../../../resources/js/product-photos-field.js');
    }
}
