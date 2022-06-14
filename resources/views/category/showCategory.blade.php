@extends('layouts.mainCss')
@section('content')
<div class="contianer">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 ml-10">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-50">
                      <div class="p-3 mb-2 bg-dark text-white"><h4>Detail Page<h4></div>
                        
                    </div>
                         <!-- show the detail of specific category -->
                        <div class='text-center mt-50'>
                            <div class="col-md-12 mt-60">
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                        Category Name
                                    </label>
                                    <div class="col-md-6">
                                      {{$category->category_name}}
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="ticket_name" class="col-md-6 col-form-label text-md">
                                    category Description
                                    </label>
                                    <div class="col-md-6">
                                    {{$category->description}}
                                    </div>
                                </div>


                            </div>
                            
                        </div>
                        <!-- details section complete here -->
                </div>          
            </div>
        </div>
    </div>
</div>

@endsection