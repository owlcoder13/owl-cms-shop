<?php

namespace Owlcoder\CmsShop\Models;

use App\BaseModel;
use \Owlcoder\CmsShop\Models\Base\BaseProductAttribute;

/**
 *  Class \Owlcoder\CmsShop\Models\ProductAttribute
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $product_id
 * @property int $category_id
 * @property Product $product
 * @property ProductCategory $category
 */
class ProductCategoryBinding extends BaseModel
{
    protected $table = 'product_category_binding';

    protected $fillable = [
        'created_at',
        'updated_at',
        'product_id',
        'category_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
