<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Picqer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('product_name')->paginate(10);
        return view('products.index', ['products'=>$products]);
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
        // return $request -> all();
        // Product::create($request->all());

        // Product Code Section
        $product_code = rand(10256214,202623262);

        $redColor = '255,0,0';
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);

        $products = new Product;
        // product_name, description, brand, price, quantity, product_code, barcode, alert_stock
        $products->product_name = $request->product_name;
        $products->product_code = $product_code;
        $products->brand = $request->brand;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->alert_stock = $request->alert_stock;
        $products->description = $request->description;
        $products->barcode = $barcodes;
        $products->save();
        return redirect()->back()->with('success', 'Product successfuly added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $products)
    {
        $product_code = rand(10256214,202623262);

        $redColor = '255,0,0';
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);

        $products = Product::find($products);
        $products->product_name = $request->product_name;
        $products->product_code = $product_code;
        $products->brand = $request->brand;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->alert_stock = $request->alert_stock;
        $products->description = $request->description;
        $products->barcode = $barcodes;

        $products->save();

        // $product->update($request->all());
        return redirect()->back()->with('success', 'Product updated successfuly!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfuly!');
    }
    public function GetProductBarcodes(){
        $productsBarcode = Product::select('barcode', 'product_code')->get() ;

        return view('products.barcode.index', compact('productsBarcode') );
    }
}
