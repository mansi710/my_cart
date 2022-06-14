@extends('layouts.mainCss')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">List Of Category</h1>
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
                                    <a class="btn btn-success" href="{{route('categoryies.create')}}">Add New Category</a>  
                            </div>
                        </div>
                        <br>
                </div>
            </p>
            <p>
               <div class="row mt-50  " style="align:center"> 
              
                   <div class="col-lg-12 margin-tb">
                        <div class="">
                                <input type="text" id="categoryName"
                                 name="category_name"value="{{request('category_name')}}" 
                                  placeholder="Serach By Category Name" />
                                <input type="date" name="created_date" 
                                value="{{request('created_date')}}"  placeholder="Serach By Date" id="createdDate" />                        
                                <button type="submit" class="btn btn-secondary" id="filter" >Search</button>
                        </div>
                    </div>
                </div>

                
             </p>

          
            <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            
                          <th>Id</th>
                          <th>Category Name</th>
                          <th>Description</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class=".dyanamicDiv">       
                        <!-- fetch all data through foreach if category table have > 0 record then only display -->
                     
                      
                        
                    </tbody>
                 </table>
                 
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var dataTable = $('#datatable').DataTable({
            "paging":true,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "lengthMenu": [ [5, 10], [5, 10] ], 
           "pageLength":5,
            "ajax": {
                "url":"{{route('get')}}",
                    "type": "GET",
                    'data': function(data){
                        // Read values
                        var date = $('#createdDate').val();
                        var name = $('#categoryName').val();

                        // Append to data
                        data.searchByDate = date;
                        data.searchByName = name;
                    }
                },
            "columns": [
                { data: "id"},
                { data: "category_name"},
                { data: "description"},
                { data: "created_at"},
                {
                    data: "actions",
                    render: function(data, type, full, meta ) {
                        var showUrl = '{{ route("categoryies.show", ":id") }}';
                        showUrl = showUrl.replace(':id', data.id);
                        var detailsLink = '<a class="btn btn-info" href='+showUrl+'>Show</a>'


                        var editUrl = '{{ route("categoryies.edit", ":id") }}';
                        editUrl = editUrl.replace(':id', data.id);
                        var editLink = '<a class="btn btn-success" href='+editUrl+'>Edit</a>'


                        // var deleteUrl='{{ route("categoryies.destroy", ":id") }}';
                        // // alert(deleteUrl);
                        // // @csrf
                        // // @method('DELETE')
                        // deleteUrl = deleteUrl.replace(':id', data.id);
                        // // alert(deleteUrl);
                        var deleteUrl = '{{ route("categoryies.destroy", ":id") }}';
                        deleteUrl = deleteUrl.replace(':id', data.id);
                        var deleteLink=`<form action="${deleteUrl}" method="post">@csrf @method('DELETE')<input type="submit" class="btn btn-danger" value="delete"></form>`
            

                    // '<form method="action">
                    //     <a href="{{route("categoryies.destroy",":id")}}">delete</a>
                    //  </form>'

                        return detailsLink + editLink + deleteLink;
                    }
                }
            ],
        });  
        $('#filter').click(function() {
            dataTable.draw();
        });

        // $('#clickDelete').click(function(){
        //     alert('delete')
        //     "ajax":{

        //     }
        // });
    });
 </script>
@endsection