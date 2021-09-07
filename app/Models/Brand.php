<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name_en',
        'brand_name_id',
        'brand_slug_en',
        'brand_slug_id',
        'brand_image',
        'last_updated_by'
    ];

    public function admin(){
        //return $this->hasOne(nama model::class, field db dari model yang dituju, field db dari table yang dipakai skrg);
        return $this->hasOne(Admin::class, 'id', 'last_updated_by');
    }
}
