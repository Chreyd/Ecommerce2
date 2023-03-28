<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    public function getPrice(){
        $price= $this->price / 100;
        
        return number_format($price,2,'.',' ').' €';
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    use HasFactory;
}
