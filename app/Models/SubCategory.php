<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_name_en',
        'subcategory_name_id',
        'subcategory_slug_en',
        'subcategory_slug_id',
        'category_id',
        'last_updated_by'
    ];

    public function admin(){
        return $this->hasOne(Admin::class, 'id', 'last_updated_by');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
