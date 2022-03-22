<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use App\Models\Pickuppoint;
use App\Models\Warehouse;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id ','subcategory_id','childcategory_id','brand_id','pickup_point_id','admin_id','name','slug','code','unit','tags','video','purchage_price','selling_price','discount_price','stock_quantity','thumbnail','images','warehouse_id','color','size','description','today_deal','featured','status','trendy','slider_product','product_view','date','month',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(Childcategory::class, 'childcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickuppoint()
    {
        return $this->belongsTo(Pickuppoint::class, 'pickup_point_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
