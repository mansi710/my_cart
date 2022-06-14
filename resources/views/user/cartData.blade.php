@extends('layouts.app1')
@section('content')
<table id="cart" class="table table-hover table-condensed">

    <thead>

        <tr>

            <th style="width:50%">Product</th>

            <th style="width:10%">Price</th>

            <th style="width:8%">Quantity</th>

            <th style="width:22%" class="text-center">Subtotal</th>

            <th style="width:10%"></th>

        </tr>

    </thead>

    <tbody>

        @php $total = 0 @endphp

        @if(session('cart'))

            @foreach(session('cart') as $id => $details)

                @php $total += $details['price'] * $details['quantity'] @endphp

                <tr data-id="{{ $id }}">

                    <td data-th="Product">

                        <div class="row">

                            
                            <div class="col-sm-9">

                                <h4 class="nomargin">{{ $details['name'] }}</h4>

                            </div>

                        </div>

                    </td>

                

                    <td data-th="Price">${{ $details['price'] }}</td>

                    <td data-th="Quantity">

                    <p class="count"> Quantity:{{ $details['quantity'] }}</p>

                    </td>

                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>

                    <td class="actions" data-th="">

                    <a href="{{route('remove.from.cart')}}" class="btn btn-danger btn-sm remove-from-cart">Remove From Cart</a>

                    </td>

                </tr>

            @endforeach

        @endif

    </tbody>

    <tfoot>

        <tr>

            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>

        </tr>

        <tr>

            <td colspan="5" class="text-right">

                <a href="{{route('userShopping')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>

                <a href="{{route('checkout')}}" ><button class="btn btn-success">Checkout</button></a>

            </td>

        </tr>

    </tfoot>

</table>
@endsection
<script type="text/javascript">
    $(".remove-from-cart").click(function (e) {

        dd('abc');
        e.preventDefault();

  

        var ele = $(this);

  

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: '{{ route('remove.from.cart') }}',

                method: "GET",

                data: {

                    _token: '{{ csrf_token() }}', 

                    id: ele.parents("tr").attr("data-id")

                },

                success: function (response) {

                    window.location.reload();

                }

            });

        }

    });

  

</script>