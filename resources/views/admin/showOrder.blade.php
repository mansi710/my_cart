@extends('layouts.app1')
@section('content')
<div class="contianer">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 ml-10">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-50">
                      <div class="p-3 mb-2 bg-dark text-white"><h4>Detail Page<h4></div>
                        
                    </div>
                        <div class="grid">
                                <div class="g-col-12"><h1>{{$orders->user->name}}<h1></div>  
                                <div class="g-col-12"><h4 class="text-danger">Order Number:- {{$orders->id}}<h3></div>
                         </div>
                        <table class="table">
                            <thead class="thead-light">
                                <tr class="table-primary">
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Quantity</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                  <!-- fetch all data through foreach if order detail table have > 0 record then only display -->
                                  @if(count($orders->order_details)>0)
                                    @foreach($orders->order_details as $detail)
                                        <tr>
                                            <td width="100">
                                                <img class="card-img-top" src="{{ asset('product_image/'.$detail->products->product_image) }}" height="100" width="50" >
                                            </td>
                                            <td>
                                                {{$detail->products->product_name}}
                                            </td>
                                            <td>
                                                {{$detail->qty}}
                                            </td>
                                            <td>
                                                {{$detail->price}}
                                            </td>
                                            <td>
                                                {{$detail->price*$detail->qty}}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                        <tr style="text-align:right">
                                                <td colspan="5">Payment Summry:- {{$orders->total}}</td>
                                        </tr>
                                  @endif
                            </tbody>
                        </table>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>
@endsection