<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        $categories = Category::all();
        return view('account.account', [
            'user' => auth()->user(),
            'orders' => $orders,
            'categories' => $categories,
        ]);
    }

    public function edit(Request $request)
    {
        $categories = Category::all();
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'contact' => 'required|min:5',
            ]);
            if (auth()->user()->email !== $request->email) {
                $existingUser = User::where('email', $request->email)->where('id', '!=', auth()->user()->id)->first();
                if (!is_null($existingUser)) {
                    return redirect()->back()->withErrors('This email already exists!');
                }
            }
            User::firstWhere('id', auth()->user()->id)->update($request->all());
            return redirect()->to('/account')->with('message', 'Information updated successfully');
        } else
            return view('account.edit', [
                'user' => auth()->user(),
                'categories' => $categories,
            ]);
    }

    public function orders(Request $request, $id)
    {
        $categories = Category::all();
        $order = DB::table('orders')->where('orders.id', $id)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.id', 'user_id', 'total', 'location', 'note', 'orders.created_at', 'users.email')
            ->first();

        $products = DB::table('orders')->where('orders.id', $id)->join('ordered_products', 'orders.id', '=', 'ordered_products.order_id')
            ->join('products', 'products.id', '=', 'ordered_products.product_id')
            ->select('quantity', 'title', 'price', 'in_stock')
            ->get();
        return view('account.order-detail', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
