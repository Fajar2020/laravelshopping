<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name_en',
        'category_name_id',
        'category_slug_en',
        'category_slug_id',
        'category_icon',
        'last_updated_by'
    ];

    public function admin(){
        return $this->hasOne(Admin::class, 'id', 'last_updated_by');
    }
}
