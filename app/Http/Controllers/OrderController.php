<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $cart = $request->session()->get('cart', []);

        return view('cart', [
            'categories' => $categories,
            'cart' => $cart,
            'total' => $this->getTotal($cart)
        ]);
    }

    public function checkout(Request $request)
    {
        $categories = Category::all();

        return view('checkout', [
            'categories' => $categories,
            'total' => $this->getTotal($request->session()->get('cart', []))
        ]);
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        $cart = $request->session()->get('cart', []);
        foreach ($cart as $product) {
            OrderedProduct::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'quantity' => $product->quantity
            ]);
        }

        $request->session()->forget('cart');
        return redirect()->to("/")->with('message', 'Order placed successfully');
    }

    public function add(Request $request, $id)
    {
        $added = false;
        $cart = $request->session()->get('cart', []);
        foreach ($cart as $item) {
            if ($item->id == $id) {
                $item->quantity++;
                $added = true;
            }
        }

        if (!$added) {
            $item = Product::find($id);
            $item->quantity = 1;
            array_push($cart, $item);
        }

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function remove(Request $request, $id, $remove_all)
    {
        $cart = $request->session()->get('cart', []);
        if ($remove_all == 0) {
            foreach ($cart as $i => $item) {
                if ($item->id == $id) {
                    $item->quantity--;
                    if ($item->quantity == 0) {
                        unset($cart[$i]);
                    }
                    break;
                }
            }
        } else if ($remove_all == 1) {
            foreach ($cart as $i => $item) {
                if ($item->id == $id) {
                    unset($cart[$i]);
                    break;
                }
            }
        }

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    private function getTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item)
            $total += ($item->price * $item->quantity);
        return $total;
    }
}
