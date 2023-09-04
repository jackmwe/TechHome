<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        
        // Last Oder Details
        $lastID=Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->get();
        return view('orders.index',['products'=> $products, 'orders'=>$orders, 'order_receipt' =>$order_receipt]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // return $request ->all();
       
        DB::transaction(function() use($request){
        //Order model
        $orders = new Order;
        $orders -> name = $request ->customer_name;
        $orders -> phone = $request ->customer_phone;
        $orders->save();
        $order_id = $orders->id;

        //Order Detail Model
        // ['order_id', 'product_id', 'unitprice', 'quantity', 'amount', 'discount']
       for ($product_id=0; $product_id < count($request->product_id); $product_id++) { 
        $order_details = new Order_Detail;
        $order_details ->order_id = $order_id;
        $order_details ->product_id = $request->product_id[$product_id];
        $order_details ->unitprice = $request->price[$product_id];
        $order_details ->quantity = $request->quantity[$product_id];
        $order_details ->discount = $request->discount[$product_id];
        $order_details ->amount = $request->total_amount[$product_id];
        $order_details ->save();

        
    }

        //Transaction Model
    // ['order_id', 'paid_amount', 'balance', 'transac_date', 'transac_amount', 'user_id', 'payment_method'];

        $transaction = new Transaction();
        $transaction ->order_id = $order_id;
        $transaction ->user_id = auth()->user()->id;
        $transaction ->balance = $request->balance;
        $transaction ->paid_amount = $request->paid_amount;
        $transaction ->payment_method = $request->payment_method;
        $transaction ->transac_amount = $order_details ->amount;  
        $transaction ->transac_date = date('Y-m-d');  
        $transaction -> save();

        DB::beginTransaction();

        Cart::where('user_id', auth()->user()->id ) ->truncate();

         // Last Order History
        $products = Product::all();
        $order_details = Order_Detail::where('order_id', $order_id)->get();

        $orderedBy = Order::where('id', $order_id)->get();


        return view('orders.index',
        [
            'products'=>$products,
            'order_details'=>$order_details,
            'customer_orders'=>$orderedBy
        ]);

        });


        return back()->with("Product orders failed to be done! Check your inputs!");
         DB::rollback();
       
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
?>
