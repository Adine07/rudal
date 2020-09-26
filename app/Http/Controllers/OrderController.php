<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function __construct()
    {
        $this->model = new Order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->model->all();

        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.order.form', compact('menus'));
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'customer_name' => $request->customer_name,
            'total' => $request->total,
        ]);

        // dd($request);

        for ($i = 0; $i < count($request->item_id); $i++) {
            $order->order_details()->create([
                'item_id' => $request->item_id[$i],
                'qty' => $request->qty[$i],
                'price' => $request->price[$i],
                'subtotal' => $request->subtotal[$i],
            ]);
        }

        return redirect(route('admin.orders.index'));
    }

    public function edit($id)
    {
        $order = Order::with('order_details')->find($id);
        $menus = Menu::all();

        return view('admin.order.form', compact('order', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_details()->delete();

        $order->update([
            'customer_name' => $request->customer_name,
            'total' => $request->total,
        ]);

        for ($i = 0; $i < count($request->item_id); $i++) {
            $order->order_details()->create([
                'item_id' => $request->item_id[$i],
                'qty' => $request->qty[$i],
                'price' => $request->price[$i],
                'subtotal' => $request->subtotal[$i],
            ]);
        }

        return redirect(route('admin.orders.index'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->order_details()->delete();
        $order->delete();

        return redirect(route('admin.orders.index'));
    }
}
