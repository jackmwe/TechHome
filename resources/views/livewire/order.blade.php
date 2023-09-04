<div class="col-lg-12">
    <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Order product</h4>
                        <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target ="#addproduct">
                        <i class="fa fa-plus"></i>Add New product</a>
                    </div>

                        <div class="card-body">

                	<div class="my-2">
                		<form wire:submit.prevent="InsertoCart">
                			<input type="" name="" wire:model="product_code" id="" class="form-control" placeholder="Enter Product Code">
                		</form>
                	</div> <br>

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session ('success')}}
                        </div>

                        @elseif(session()->has('info'))
                        <div class="alert alert-info">
                            {{ session ('info')}}
                        </div>
                        
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session ('error')}}
                        </div>
                        
                    @endif
                            <table class="table table-bordered table-left">
                                <thead> 
                                    <tr>
                                        <th> </th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Disc</th>
                                        <th colspan="6">Total </th>
                                        <!-- <th><a href="#" class="btn btn-success btn-sm add_more rounded-circle"><i class="fa fa-plus-circle"></i></a></th> -->
                                    </tr>
                                </thead>


                                <tbody class="addMoreProduct">
                                	<?php foreach ($productIncart as $key=>$cart): ?>
                                		
                             
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td width="30%">
                                                <input type="text" value="{{$cart->product->product_name}}" name="" class="form-control">
                                           <!--  @foreach ($products as $product )
                                            <option data-price = "{{$product->price}}" value="{{ $product->id}}" > {{ $product -> product_name}} </option>

                                            @endforeach -->
                                            </select>
                                            
                                        </td>
                                        <td width="15%">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <button wire:click.prevent="DecrementQnty({{ $cart->id }})" class="btn btn-sm btn-danger">-</button> 
                                                </div>

                                                <div class="col-md-1">
                                                    <label for="">{{$cart->product_qnty}}</label>
                                                </div>

                                                <div class="col-md-2">
                                                    <button wire:click.prevent="IncrementQnty({{ $cart->id }})" class="btn btn-sm btn-success">+</button> 
                                                </div>


                                            </div>

                                            <!-- <input type="number" name="quantity[]" id="quantity"  class="form-control quantity" value="{{$cart->product_qnty}}"> -->
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price" value="{{$cart->product->price}}">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount" class="form-control discount" value="">
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount" value="{{$cart->product_price}}">
                                        </td>
                                        <td>
                                        <a href="#" class="btn btn-danger btn-sm rounded-circle"><i class="fa fa-times-circle" wire:click="removeProduct({{ $cart->id}})"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>

                                </tbody>

                                    
                            </table>
                            </div>    
                        </div>
                    </div>

                    <div class="col-md-4">
                     

                        <div class="card">
                            <div class="card-header"> <h4>Total <b class=" total ">{{$productIncart ->sum('product_price')}}</b> </h4> </div>
                                <div class="card-body">
                                    <div class="btn-group">
                                        <button type="submit" onclick="PrintReceiptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i> &nbsp Print</button>
                                        <button type="submit" onclick="PrintReceiptContent('print')" class="btn btn-primary"><i class="fa fa-print"></i> &nbsp History</button>
                                        <button type="submit" onclick="PrintReceiptContent('print')" class="btn btn-danger"><i class="fa fa-print"></i> &nbsp Report</button>
                                    </div>
                        <form action="{{ route('orders.store') }} " method="post">
                        @csrf  
                        
                        <?php foreach ($productIncart as $key=>$cart): ?>
                                        
                            
                                           <input type="hidden" name="product_id[]" value="{{$cart->product->id}}" class="form-control">                                            
                                            <input type="hidden" name="quantity[]" value="{{$cart->product_qnty}}" id="">

                                            <input type="hidden" name="price[]" class="form-control price" value="{{$cart->product->price}}">

                                            <input type="hidden" name="discount[]" class="form-control discount">

                                            <input type="hidden" name="total_amount[]" class="form-control total_amount" value="{{$cart->product_price}}">

                                    <?php endforeach ?>

                                    <div class="panel">
                                        <div class="row">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td>
                                                    <label for="">Customer Name</label>
                                                    
                                                        <input type="text" name="customer_name" id="" class="form-control">
                                         
                                                    </td>
                                                    <td>
                                                        <label for="">Customer Phone</label>
                                                        <input type="number" name="customer_phone" id="" class="form-control">
                                                    </td>
                                                </tr>
                                            </table>
                                      <td>Payment Method 
                                        <div class="btn-group">
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="cash" checked="checked">
                                            <label for="payment_method"><i class="fa fa-money text-success"></i>Cash</label>
                                        </span>
                                         <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="bank transfer" >
                                            <label for="payment_method"><i class="fa fa-university text-danger"></i>Bank Transfer</label>
                                        </span>
                                         <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true" value="credit card">
                                            <label for="payment_method"><i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                        </span>
                                    </div>
                                    </td>
                                    <td>Payment 
                                        <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount" class="form-control" >
                                    </td>
                                    <td>Returning Change 
                                        <input type="number" wire:model="balance" readonly name="balance" id="balance" class="form-control" >
                                    </td>
                                    <hr>
                                    <td>
                                        <button class="btn-primary btn-block mt-5 btn-lg">Save</button>
                                    </td>
                                     <td>
                                        <button class="btn-danger btn-block mt-2 btn-lg">Calculator</button>
                                    </td>
                                     <td>
                                        <a href="#" style="text-align: center !important"> <i class="fa fa-sign-out"></i>Logout</a>
                                    </td>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

                     <!-- Modal fo adding new product -->

            <!-- Modal -->
        <div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Product</label>
                        <input type="text" name="product_name" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save product</button>
                    </div>
                </form>

              </div>
            </div>
          </div>
        </div>
    </div>
</div>