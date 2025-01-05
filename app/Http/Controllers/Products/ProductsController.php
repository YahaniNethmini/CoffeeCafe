<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $product->id)->take(4)
            ->OrderBy('id', 'desc')
            ->get();

        return view('products.product-single', compact('product', 'relatedProducts'));
    }
}
