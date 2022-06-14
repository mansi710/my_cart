@extends('layouts.mainCss')
@section('content')   
    <div class="card">
        <div class="card-body">
            <div class="text-center mt-50">
               <div class="p-3 mb-2 bg-dark text-white"><h4>Detail Page<h4></div>
            </div>
            <!-- show the detail of specific category -->
            <div class=' mt-50'>
                <div class="col-md-12 mt-60">
                    <div class="form-group row col-md-12">     
                        <div class="col-md-6">
                            <div class="card" style="width: 20rem;pull-left">
                                 <a href="{{route('userShopping')}}" id="shoppingPage">            
                                            <img class="card-img-top" id="img-responsive" src="{{ asset('product_image/'.$product->product_image) }}" height="200" width="400" style="border-radius:.60rem;">
                                            <img>
                                </a>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="display-1">Product Name:-<h2>{{$product->product_name}}</h2></h1>
                            <h2 class="display-2">Product Price:-<h3>{{$product->product_price}}</h3></h2>
                            <h3 class="display-3">Product Quantity:-<h4>{{$product->product_quantity}}</h4></h3>
                            <a href="{{route('userShopping')}}" class="btn btn-primary" id="add-to-cart-btn">ADD TO CART</a></div>
                        </div>
                    </div>
                </div>         
            </div>
            <!-- details section complete here -->
        </div>          
    </div>
    <!-- <div class="owl-carousel owl-theme mt-5">
        <div class="item"><h4>1</h4></div>
        <div class="item"><h4>2</h4></div>
        <div class="item"><h4>3</h4></div>
        <div class="item"><h4>4</h4></div>
        <div class="item"><h4>5</h4></div>
        <div class="item"><h4>6</h4></div>
        <div class="item"><h4>7</h4></div>
        <div class="item"><h4>8</h4></div>
        <div class="item"><h4>9</h4></div>
        <div class="item"><h4>10</h4></div>
        <div class="item"><h4>11</h4></div>
</div> -->

<div class="container-lg my-3">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
        </ol>
        
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <!-- <div class="carousel-item active">
                <img src="/examples/images/slide1.png" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="/examples/images/slide2.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="/examples/images/slide3.png" class="d-block w-100" alt="Slide 3">
            </div> -->

            @if(count($product->product_images)>0)
                @foreach($product->product_images as $proImages)
                    <div class="carousel-item   {{ $loop->first ? ' active' : 'inactive' }}" id="showData">
                        <img class="card-img-top" class="img-responsive" src="{{ asset('product_image/'.$proImages->product_image) }}" height="200" width="400" style="border-radius:.60rem;">
                        <img>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>


@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/> -->
<script type="text/javascript">
     $(document).ready(function(){
       
            // $('#showData').show();
            $('#shoppingPage').click(function() {
            window.location.href = this.id + '.html';
            }); 
            // $("#myCarousel").click(function(){
            //     // alert('abc');
            //     $("#slideImage").carousel();
                
            // });

            $("#myCarousel").carousel();

            // $("#myCarousel").carousel({
            //     interval: true
            // });
  
            // $("#prevBtn").click(function(){
            //     alert('perv');
            //     $("#myCarousel").show();
            // });

            $(".carousel-control-next active").click(function(){
                alert('next');
                $("#myCarousel").carousel("next");
            });
            
            // $(window).load(function() {
            //     $('#myCarousel').carousel({
            //         interval: 1000
            //     })
            // });
        });
</script>
<!-- <style>
  .owl-carousel .item {
    height: 10rem;
    background: #4DC7A0;
    padding: 1rem;
  }
  .owl-carousel .item h4 {
    color: #FFF;
    font-weight: 400;
    margin-top: 0rem;
   }
  </style> -->

<style>
/* Custom style to prevent carousel from being distorted 
   if for some reason image doesn't load */
.carousel-item{
    min-height: 280px;
}
</style>
@endsection