<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        if(request()->categorie){
            $products= Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->categorie);
            })->orderBy('created_at','DESC')->paginate(6);
        }
        else{
            $products = Product::with('categories')->orderBy('created_at','DESC')->paginate(6);
        }
        // $products= Product::inRandomOrder()->take(6)->get();//pour afficher 6 produits de manière hazardeuse

        return view('products.index',compact('products'));
    }
    public function show($slug){
        $product= Product::where('slug', $slug)->firstOrFail();

        return view('products.show',compact('product'));
    }

    public function search(){

        request()->validate([
            'q'=>'required|between:3,20'
        ]);

        $q =request()->input('q');

        $products =Product::where('title','like',"%$q%")
                      ->orWhere('description', 'like', "%$q%")
                      ->paginate(6);    //ou : ->get

        return view('products.search',compact('products'));
    }
}
