@extends('layouts.mainCss')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">List Of Product</h1>
            <p class="card-description">
                @if($message=Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif

                @if($message=Session::get('message-deleted'))
                    <div class="alert alert-danger">
                        <p>{{$message}}</p>
                    </div>
                @endif

                <div>
                    <div class="row  mt-20 " style="float:right">
                            <div class="col-lg-12 margin-tb">
                                <a class="btn btn-success" href="{{route('products.create')}}">Add New Product</a>  
                            </div>
                        </div>
                        <br>
                </div>
            </p>
            <p>
               <div class="row mt-50  " style="align:center"> 
              
                   <div class="col-lg-12 margin-tb">
                        <div class="">
                          
                                <input type="text" id="categoryName" name="searchCategoryName" value="{{request('searchCategoryName')}}"  placeholder="Serach By Catgory Name" />
                                <input type="text" id="productName" name="searchName" value="{{request('searchName')}}"  placeholder="Serach By Product Name" />
                                <input type="text" id="productPrice" name="searchPrice" value="{{request('searchPrice')}}"  placeholder="Serach By Product Price" />
                                <input type="date" id="createdDate" name="searchByDate" value="{{request('searchByDate')}}"  placeholder="Serach By Date" />                        
                                <button type="submit" class="btn btn-secondary" id="filter" >Search</button>
                       
                        </div>
                    </div>
                </div>
             </p>
            <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">@sortablelink('user_id','user name')</th>
                            <th scope="col">@sortablelink('category_id', 'category name')</th>
                            <th scope="col">@sortablelink('product_name', 'product name')</th>
                            <th scope="col">@sortablelink('product_price', 'price')</th>
                            <th scope="col">@sortablelink('product_quantity', 'quantity')</th>
                            <th scope="col">@sortablelink('product_description', 'description')</th>
                            <th scope="col">@sortablelink('created_at','date')</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>       
                        <!-- fetch all data through foreach if category table have > 0 record then only display -->
                      
                    </tbody>
                 </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
            $(document).ready(function(){
                
                // $('#datatable').DataTable();
                // alert('abc');

                var datatable=$('#datatable').DataTable({
                    "paging":true,
                    "processing": true,
                    "serverSide": true,
                    "deferRender": true,
                    "lengthMenu": [ [5, 10], [5, 10] ], 
                      "pageLength":5,
               
                "ajax": {
                    "url":"{{route('getProduct')}}",
                        "type": "GET",
                        'data':function(data)
                        {
                             // Read values

                            var date = $('#createdDate').val();
                            var name = $('#categoryName').val();
                            var pname = $('#productName').val();
                            var pprice = $('#productPrice').val();

                            // Append to data
                            data.searchByDate = date;
                            data.searchByName = name;
                            data.searhByPname=pname;
                            data.searhByPprice=pprice;
                            
                        }
                },
                    "columns": [
                        { data: "id"},
                        { data: "name"},
                        { data: "category_name"},
                        { data: "product_name"},
                        { data: "product_price"},
                        { data: "product_quantity"},
                        { data: "product_description"},
                        { data: "created_at"},
                        {
                            data:"actions",
                            render: function(data, type, full, meta ) {
                           
                                var showUrl = '{{route("products.show",":id")}}';

                                showUrl = showUrl.replace(':id',full.id)
                                var detailsLink = '<a class="btn btn-primary" href='+showUrl+'>Show</a>'

                                var editUrl = '{{ route("products.edit", ":id") }}';
                                editUrl = editUrl.replace(':id', full.id)
                                // alert(showUrl);
                                var editLink = '<a class="btn btn-success" href='+editUrl+'>Edit</a>'

                                var deleteUrl = '{{ route("products.destroy", ":id") }}';
                                deleteUrl = deleteUrl.replace(':id', full.id);
                                 var deleteLink=`<form action="${deleteUrl}" method="post">@csrf @method('DELETE')<input type="submit" class="btn btn-danger" value="delete"></form>`

                            return detailsLink + editLink + deleteLink;
                        }
                    }

                    ],
                });  
                
                     $('#filter').click(function() {
                        dataTable.draw();
                    });
            });
</script>
@endsection