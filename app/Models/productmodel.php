<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productmodel extends Model
{
    protected $table = 'products'; // Assuming the table is 'products'
    
    protected $fillable = [
        'product_name',
        'product_category',
        'product_qty',
        'warehouse_id',
        'category_id',
        'serial',
        'manufaktur',
        'last_inspection',
        'next_inspection',
        
    ];

    // Define the relationship to categories, assuming you have a category model
    public function category()
    {
        return $this->belongsTo(categorymodel::class, 'product_category');
    }
    
    public function warehouse()
    {
        return $this->belongsTo(warehousemodel::class);
    }
}
