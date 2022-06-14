@extends('layouts.mainCss')
@section('content')
<div class="container">


    </div>
   <div class="dynamicDivProduct">

   </div>

    <div class="dyanamicDiv mt-20">
        
    </div>

@endsection



@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https:://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    // $(document).ready(function() {
       
    // });

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
        $(document).on('click','.addtoCart',function()
        {
            // alert('nice');
            var id=$(this).data('id');
            
            $.ajax({
                url:'{{route("add.carts")}}',
                method:"get",
                data:{
                    id:id,
                },
               
                success:function(response){
                    counterData();
                    loadCart();
                    loadProduct();
                    
                }
            });
       
        });

        
        $(document).on('click','.removeCart',function()
        {
            console.log('abc');
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
                    
                }
            });
       
        });
</script>

@endsection



