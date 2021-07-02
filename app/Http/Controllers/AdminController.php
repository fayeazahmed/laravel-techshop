<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Featured;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $categories = Category::all();
        $category_id = $request->get('category_id', $categories->first()->id);

        $products = Product::where('category_id', $category_id)->get();
        $featureds = Featured::all();
        $orders = Order::all();
        return view('admin.index', [
            'users' => $users,
            'categories' => $categories,
            'products' => $products,
            'featureds' => $featureds,
            'orders' => $orders,
            'selected_category' => $category_id
        ]);
    }

    public function users(Request $request, $id)
    {
        $user = User::firstWhere('id', $id);
        if ($request->isMethod('delete')) {
            $user->delete();
            return redirect()->to('/admin');
        }

        $orders = Order::where('user_id', $id)->get();
        return view('admin.users', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    public function categories(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            Category::firstWhere('id', $id)->update(['title' => $request->title]);
            return redirect()->back();
        }

        if ($request->isMethod('post')) {
            Category::create($request->all());
            return redirect()->back();
        }

        if ($request->isMethod('delete')) {
            Category::firstWhere('id', $id)->delete();
            return redirect()->back();
        }
    }

    public function featureds(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Product::where('id', $request->product_id)->exists() && !Featured::where('product_id', $request->product_id)->exists()) {
                Featured::create($request->all());
            }
            return redirect()->back();
        }

        if ($request->isMethod('delete')) {
            Featured::firstWhere('product_id', $request->product_id)->delete();
            return redirect()->back();
        }
    }

    public function products(Request $request, $id)
    {
        $product = Product::firstWhere('id', $id);
        if ($request->isMethod('patch')) {
            $in_stock = isset($request->in_stock) ? true : false;
            Product::firstWhere('id', $id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $request->image,
                'in_stock' => $in_stock,
            ]);
            return redirect()->back();
        }

        if ($request->isMethod('delete')) {
            Product::firstWhere('id', $id)->delete();
            return redirect()->to('/admin');
        }

        return view('admin.products', [
            'product' => $product,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            Product::create($request->all());
            return redirect()->to('/admin');
        }
        $categories = Category::all();
        return view('admin.create', ['categories' => $categories]);
    }

    public function orders(Request $request)
    {
        $location = $request->get('location', 'Dhaka');
        $orders = Order::where('location', $location)->get();

        return view('admin.orders', [
            'orders' => $orders,
            'location' => $location
        ]);
    }

    public function orderDetails(Request $request, $id)
    {
        $order = DB::table('orders')->where('orders.id', $id)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.id', 'user_id', 'total', 'location', 'note', 'orders.created_at', 'users.email')
            ->first();

        $products = DB::table('orders')->where('orders.id', $id)->join('ordered_products', 'orders.id', '=', 'ordered_products.order_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->select('quantity', 'title', 'price', 'in_stock')
            ->get();
        return view('admin.order-detail', [
            'order' => $order,
            'products' => $products
        ]);
    }
}
