@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                     <div class="card-header">
                        <h4 style="text-align: center;">Products Barcode</h4>
                    </div>
                        <div class="card-body">
                            <div id="print">
                                <div class="row">
                                    @forelse($productsBarcode as $barcode)
                                        <div class="col-lg-3 col-md-4 col-sm-12 mt-3 text-center">
                                            <div class="card">
                                                <div class="card-body">
                                                    {!! $barcode ->barcode!!}
                                                    <h4 class="text-center" style="padding: 1em; margin-top: 2em">{{$barcode ->product_code}} </h4>
                                                </div>
                                            </div>
                                        </div>   
                                    @empty
                                    <h2 align="center"> No Data!! </h2>
                                    @endforelse
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>

                    

@endsection
