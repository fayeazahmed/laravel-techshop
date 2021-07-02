<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request, $category)
    {
        $categories = Category::all();
        $category_id = $categories->firstWhere('title', ucfirst($category))->id;

        if ($request->isMethod('post')) {
            $min = $request->input('minval', 0);
            $max = $request->input('maxval', 1000000);
            $in_stock = $request->input('instock');
            if (is_null($in_stock))
                $products = Product::where('category_id', $category_id)->whereBetween('price', [$min, $max])->get();
            else
                $products = Product::where('category_id', $category_id)->where('in_stock', true)->whereBetween('price', [$min, $max])->get();
        } else {
            $products = Product::where('category_id', $category_id)->get();
        }

        $request->flash();
        return view('products', [
            'products' => $products,
            'categories' => $categories,
            'category' => ucfirst($category),
            'cart' => $this->getProductIdsInCart($request->session()->get('cart', []))
        ]);
    }

    public function search(Request $request, $query)
    {
        $products = Product::where('title', 'iLIKE', '%' . $query . '%')->get();
        $categories = Category::all();
        return view('search', [
            'products' => $products,
            'categories' => $categories,
            'cart' => $this->getProductIdsInCart($request->session()->get('cart', []))
        ]);
    }

    public function welcome(Request $request)
    {
        $categories = Category::all();
        $products = DB::table('products')->join('featureds', 'products.id', '=', 'featureds.product_id')->get();
        return view('welcome', [
            'categories' => $categories,
            'products' => $products,
            'cart' => $this->getProductIdsInCart($request->session()->get('cart', []))
        ]);
    }

    public function details(Request $request, $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);

        return view('details', [
            'categories' => $categories,
            'product' => $product,
            'cart' => $this->getProductIdsInCart($request->session()->get('cart', []))
        ]);
    }

    public function about()
    {
        $categories = Category::all();
        return view('about', ['categories' => $categories]);
    }

    private function getProductIdsInCart($cart)
    {
        $cartSimplified = [];
        foreach ($cart as $c) {
            array_push($cartSimplified, $c->id);
        }

        return $cartSimplified;
    }
}
