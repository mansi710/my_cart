@extends('layouts.mainCss')
@section('content')
<div class="contianer">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 ml-10">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-50">
                    <div class="p-3 mb-2 bg-dark text-white"><h4>Detail Page Of Product<h4></div>   
                    </div>
                         <!-- show the detail of specific category -->
                        <div class='text-center mt-50'>
                            <div class="col-md-12 mt-60">
                                <div class="form-group row col-md-12">
                                    <label for="product_name" class="col-md-6 col-form-label text-md">
                                        User Name
                                    </label>
                                    <div class="col-md-6">
                                        {{$product->user->name}}
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                    Product Name
                                    </label>
                                    <div class="col-md-6">
                                    {{$product->product_name}}
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                    Product Image
                                    </label>
                                    <div class="col-md-6">
                                    <!-- {{$product->product_image}} -->
                                    <img class="card-img-top" src="{{ asset('product_image/'.$product->product_image) }}" height="100" width="10" >    
                                   

                                    @if(count($product->product_images)>0)
                                        @foreach($product->product_images as $proImages)
                                        <img class="card-img-top" src="{{ asset('product_image/'.$proImages->product_image) }}" height="100" width="10" >    
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                        Product Price
                                    </label>
                                    <div class="col-md-6">
                                        {{$product->product_price}}
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                        Product Quantity
                                    </label>
                                    <div class="col-md-6">
                                        {{$product->product_quantity}}
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="product_Description" class="col-md-6 col-form-label text-md">
                                        Product Description
                                    </label>
                                    <div class="col-md-6">
                                    {{$product->product_description}}
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- details section complete here -->
                </div>          
            </div>
        </div>
    </div>
</div>

@endsection