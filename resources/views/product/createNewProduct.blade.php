@extends('layouts.mainCss')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Product</h4>
            <p class="card-description">
                    @if($message=Session::get('success'))
                        <div class="alert alert-success">
                             <p>{{$message}}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>There were some problem with your input<br><br>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                @endforeach
                                </ul>
                        </div>
                    @endif
                  </p>
                <form class="forms-sample"  action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="formGroupExampleInput">Select Category</label>
                
                        <select class="form-control category_id" name="category_id">
                            @foreach($data as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Name</label>
                         <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}"id="formGroupExampleInput" placeholder="Enter Product">
                    </div>
                    <div class="form-group">
                         <label for="formGroupExampleInput">Enter Product Price</label>
                         <input type="text" class="form-control" name="product_price" value="{{old('product_price')}}"id="formGroupExampleInput" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Quanitity</label>
                        <input type="text" class="form-control" name="product_quantity" value="{{old('product_quantity')}}"id="formGroupExampleInput" placeholder="Enter Product Quantity">
                    </div>
                 
                    <div class="form-group">
                        <label for="formFile" class="form-label">Enter Product Image</label>
                    
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                        <!-- <button type="file" class="file-upload-browse btn btn-primary" name="product_image"  type="button">Upload</button> -->
                          <!-- <button type="file" class="file-upload-browse btn btn-primary" name="product_image" type="button">Upload</button> -->
                          <input class="form-control" name="product_image" type="file" id="formFile">
                        </span>
                      </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Description</label>
                        <textarea class="form-control" name="product_description" id="textAreaExample1" rows="4" placeholder="enter product description">{{old('product_description')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Create Product</button>
                  </form>
            </div>
        </div>
</div>
@endsection