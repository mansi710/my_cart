@extends('layouts.mainCss')
@section('content')
<div class="container mt-50">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>PRODUCT NAME</th>
            <th>PRODUCT QTY</th>
            <th>PRODUCT PRICE</th>
            <th>PRODUCT TOTAL</th>
            <th>Action</th>
        </tr>
        @if(count($carts)>0)
            @foreach($carts as $cart)
                <tr class="row_{{$cart->id}}">
                    <td>{{$cart->id}}</td>
                    <td>{{$cart->product->product_name}}</td>
                    <td>{{$cart->qty}}</td>
                    <td>{{$cart->price}}</td>
                    <td>{{$cart->price*$cart->qty}}</td>
                    <td>
                     <a href="javascript:;" class="btn btn-danger removeCart" data-id="{{$cart->id}}" id="removeFromCart">
                            RemoveFromCart</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
    <a href="{{route('order.checkout')}}" class="btn btn-info checkout">Checkout</a>
    <a href="{{route('userShopping')}}" class="btn btn-secondary">Countine To Shopping</a>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https:://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
 
    function loadCart()
	{
		$.ajax({
			url:'{{route("show.carts")}}',
			method:"get",
			success:function(response){
                // alert('abc');
				$('.dyanamicDiv').html(response.html);
                // console.log(response);
			}
		});
	}

    function loadProduct()
    {
        $.ajax({
			url:'{{route("show.products")}}',
			method:"get",
			success:function(response){

                // alert('abc');
				$('.dynamicDivProduct').html(response.html);
                // console.log(response);
			}
		});
    }


    function counterData()
    {
        // alert('abc');
        $.ajax({
            method:"get",
            url:"{{route('load-cart-data')}}",
            success:function(response)
            {
                // alert(response.count)
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

        $(document).ready(function(){
            $('#detailPage').click(function() {
            window.location.href = this.id + '.html';
            });
            

            counterData();
            loadCart();

            loadProduct();
        })
    

        
        $(document).on('click','.removeCart',function()
        {
            
            var id=$(this).data('id');
            
            $.ajax({
                url:'{{route("remove.carts")}}',
                method:"get",
                data:{
                    id:id,
                },
               
                success:function(response){
                    counterData();
                    loadCart();
                    loadProduct();

                    // $('.table').find('tr').hide();

                    $('.row_'+id).hide();
                }
            });
       
        });
</script>


