<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;
use Owlcoder\Cms\Models\Image;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductImage
 * @property $product_id
 * @property $image_id
 */
class ProductImage extends BaseModel
{
    protected $table = 'product_image';

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
