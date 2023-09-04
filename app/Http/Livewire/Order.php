<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Component;

class Order extends Component
{
	public $orders, $products = [], $product_code, $message='', $productIncart;
    public $pay_money , $balance;

	public function mount()
	{
    	$this->products = Product::all();
    	$this ->productIncart = Cart::all();
	}

	public function InsertoCart()
	{
    	$countProduct=Product::where('id',$this->product_code)->first();
    	
    	if (!$countProduct) {
    		return session()->flash('error', 'Product not found');
    	}
    	$countCartProduct = Cart::where('product_id', $this->product_code)->count();
    	if ($countCartProduct>0) {
    		return session()->flash('success', 'Product ' .$countProduct->product_name .' already exist in cart, Please add Quantity');
    	}
    	$add_to_cart = new Cart;
    	$add_to_cart -> product_id = $countProduct->id;
    	$add_to_cart -> product_qnty = 1;
    	$add_to_cart -> product_price = $countProduct->price;
    	$add_to_cart -> user_id = auth()->user()->id;
    	$add_to_cart -> save();

    	$this->productIncart->prepend($add_to_cart);


    	$this ->product_code = '';
    		return session()->flash('success', 'Product added to cart');
    	// dd($countProduct);
	}

    public function IncrementQnty($cartId){
         $carts = Cart::find($cartId);
        $carts-> increment('product_qnty',1);
        $updatePrice = $carts->product_qnty * $carts->product->price;

        $carts->update(['product_price'=>$updatePrice]);
        $this ->mount();
    }

    public function DecrementQnty($cartId){
        $carts = Cart::find($cartId);
        if ($carts->product_qnty==1) {
            return session()->flash('error', 'Product ' .$carts->product->product_name. ' Quantity cannot be less than 1, add quantity or remove product in cart.');
        }
        $carts-> decrement('product_qnty',1);
        $updatePrice = $carts->product_qnty * $carts->product->price;

        $carts->update(['product_price'=>$updatePrice]);
        $this ->mount();

    }

	public function removeProduct($cartId){
		$deleteCart = Cart::find($cartId);
		$deleteCart ->delete();
		$this ->productIncart = $this ->productIncart -> except($cartId);
        $this ->mount();
        return session()->flash('info', "Product removed from cart");


	}

    public function render()
    {
        if ($this->pay_money !='') {
           $totalAmount = $this ->pay_money - $this->productIncart->sum('product_price');
            $this ->balance =$totalAmount;
        }

        return view('livewire.order');
    }
}
