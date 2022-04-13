<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    use HasFactory;
}
