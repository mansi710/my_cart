<div class="container">
    @if(count($product)>0)
        @foreach($product as $addProduct)
            <div class="card mp-50" style="width:30rem; text-align:center;display:inline-block;">
                <a href="{{route('detailPage',$addProduct->id)}}" id="detailPage">
             
                   
                        <img class="card-img-top" src="{{ asset('product_image/'.$addProduct->product_image) }}" height="200" width="400" style="border-radius:.60rem;">
                        <img>
              
                </a>
                <div class="card-body">
                    <h3 class="card-title">Product Name:-{{$addProduct->product_name}}</h3>
                        <h5 class="card-text">Product Price:-{{$addProduct->product_price}}</h5>
                        <h5 class="card-text">Product Quantity:-{{$addProduct->product_quantity}}</h5>
                        @if($addProduct->product_quantity === 0)
                            <a href="#" class="btn btn-danger" id="#"  disabled="disabled">OUT OF STOCK</a>
                        @else
                            <a href="#" class="btn btn-primary addtoCart" data-id="{{$addProduct->id}}" id="addTocart">
                            Add To Cart</a>
                         @endif
                    </div>
                </div>
        @endforeach
    @endif
</div>


