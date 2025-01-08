<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Cart;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $product->id)->take(4)
            ->OrderBy('id', 'desc')
            ->get();

        $checkingInCart = Cart::where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        return view('products.product-single', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    public function addCart(Request $request, $id)
    {
        // Fetch product details from the database using the product ID
        $product = Product::findOrFail($request->product_id);

        // Add the product to the cart
        $addCart = Cart::create([
            "product_id" => $product->id,
            "name" => $product->name,
            "image" => $product->image,
            "price" => $product->price,
            "user_id" => Auth::user()->id,
        ]);

        return Redirect::route('product.single', $id)->with('success', 'Product added to cart successfully');
    }

    public function cart()
    {
        $cartProducts = Cart::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $totalPrice = Cart::where('user_id', Auth::user()->id)
            ->sum('price');

        return view('products.cart', compact('cartProducts', 'totalPrice'));
    }

    public function deleteProductCart($id)
    {
        $deleteProductCart = Cart::where('product_id', $id)
            ->where('user_id', Auth::user()->id);

        // Attempt to delete the product from the cart
        $isDeleted = $deleteProductCart->delete();

        if ($isDeleted) {
            return Redirect::route('cart')
                ->with(["delete" => "Product removed from cart successfully"]);
        } else {
            return Redirect::route('cart');
        }
    }

    public function prepareCheckout(Request $request)
    {
        $value = $request->price;

        Session::put('price', $value);

        $newPrice = Session::get('price');

        if ($newPrice) {
            return Redirect::route('checkout');
        } else {
            return Redirect::route('cart');
        }
    }

    public function checkout()
    {
        echo "Checkout page";
//        $price = Session::get('price');
//
//        return view('products.checkout', compact('price'));
    }
}
