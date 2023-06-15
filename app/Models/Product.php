<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function gallery() {
        return $this->hasMany(Gallery::class, 'product_id');
    }
}