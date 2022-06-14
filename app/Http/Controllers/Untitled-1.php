
    <div class="dropdown-menu">

<div class="row total-header-section">

    <div class="col-lg-6 col-sm-6 col-6">

        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>

    </div>

    @php $total = 0 @endphp

    @foreach((array) session('cart') as $id => $details)

        @php $total += $details['price'] * $details['quantity'] @endphp

    @endforeach



</div>

@if(session('cart'))
    @foreach(session('cart') as $id => $details)
        <div class="row cart-detail">
            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">      
                <p>Name:{{ $details['name'] }}</p>
                <p class="price text-info">Price {{ $details['price'] }}</p> 
                <p class="count"> Quantity:{{ $details['quantity'] }}</p>
                <p>Total: <span class="text-info">{{ $total }}</span></p>
                <button class="btn btn-danger " data-id="{{ $id }}">Remove</button>
            </div>

        </div>
    @endforeach
@endif

<div class="row">

    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">

        <a href="" class="btn btn-primary btn-block">View all</a>

    </div>

</div>
</div>
<div class="container">



@if(session('success'))

    <div class="alert alert-success">

      {{ session('success') }}

    </div> 

@endif



@yield('content')

<img src="{{url('/product_image')}}" class="card-img-top"  height="200" width="200" style="border-radius:.60rem;">{{$addProduct->product_image}}</img>