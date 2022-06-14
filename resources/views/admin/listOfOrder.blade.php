@extends('layouts.mainCss')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List Of Order</h4>
            <p class="card-description pull-right">
               <div class="row mt-40 pull-right  mt-20  ">
                   <div class="col-lg-12 margin-tb">
                        <div class="">
                            <form action="{{route('orders.list')}}" method="GET"> 
                                <input type="text" name="searchByUserName" value="{{request('searchByUserName')}}"  placeholder="Serach By User Name" />
                                <input type="date" name="searchByDate" value="{{request('searchByDate')}}"  placeholder="Serach By Date" />                        
                                <button type="submit" class="btn btn-secondary">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
             </p>
            <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                          <th>@sortablelink('id','Id')</th>
                          <th>@sortablelink('user_id','User Name')</th>
                          <th>@sortablelink('total','Total')</th>
                          <th>@sortablelink('created_at','Date')</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="display-data">       
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
                // alert('ABC'); 

                $('#datatable').DataTable({
                "processing": true,
                "lengthMenu": [ [5, 10, 15, 20], [5, 10, 15, 20, "All"] ],
                "pageLength": 2,
                "ajax": {
                    "url":"{{route('getOrder')}}",
                        "type": "GET"
                },
                    "columns": [
                        { data: "id",name:"Id" },
                        { data: "name",name:"User Name" },
                        { data: "total",name:"Total" },
                        { data: "created_at",name:"Date"},
                        {"render":function() {return '<a class="btn btn-primary" href="#;">Edit</a>  <a class="btn btn-danger" href="#">Delete</a>  <a class="btn btn-info" href="#">Show</a>';}}

                    ],
                });        
            });            
</script>
@endsection
 

