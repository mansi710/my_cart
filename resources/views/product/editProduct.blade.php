@extends('layouts.mainCss')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
     
            <h4 class="card-title">Edit Product</h4>
            <p class="card-description">
                <!-- IF CATEGORY ADDED SUCCESFULLY IT WILL RETURN SUCCESS MESSAGE TO USER ON THE FRONT VIEW --> 
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
                <form class="forms-sample"  action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                    <div class="form-group">
                        <label for="formGroupExampleInput">Select Category</label>
                        
                        <select class="form-control category_id btn btn-secondary dropdown-toggle" name="category_id" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
                        

                            <option value=""></option>
                                    @foreach($category as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->category_id == $brand->id ? "selected" : "" }}>{{ $brand->category_name }}</option>
                                    @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Name</label>
                        <input type="hidden" class="form-control" name="editId" value="{{$product->id}}"id="formGroupExampleInput" placeholder="Enter Product">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}"id="formGroupExampleInput" placeholder="Enter Product">
                    </div>
                    <div class="form-group">
                         <label for="formGroupExampleInput">Enter Product Price</label>
                         <input type="text" class="form-control" name="product_price" value="{{$product->product_price}}"id="formGroupExampleInput" placeholder="Enter Product">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Quanitity</label>
                        <input type="text" class="form-control" name="product_quantity" value="{{$product->product_quantity}}"id="formGroupExampleInput" placeholder="Enter Product">
                    </div>
                 
                    <div class="form-group">
                        <label for="formFile" class="form-label">Enter Product Image</label>
                    
                      <div class="input-group col-xs-12">
                          <!-- <input type="file" name="product_image[]" multiple="true"> -->
                        <!-- <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"> -->
                        <!-- <span class="" style="display:inline-bock"> -->
                        <!-- {{$product->product_image}} -->
                        <!-- <img class="card-img-top" src="{{ asset('product_image/'.$product->product_image) }}" height="100" width="50" > -->

                        <!-- <input type="button" id="addImage" value="Add Image"> -->
                          <!-- <button type="file" class="file-upload-browse btn btn-primary" name="product_image" type="button">Upload</button>
                        -->

                        <!-- show multiple images -->
                       @foreach($product->product_images as $images)
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="imgDiv_{{$images->id}}">
                              <img class="card-img-top" src="{{ asset('product_image/'.$images->product_image) }}" height="200" width="30" > 

                              <a href="{{route('deleteImg',$images->id)}}" class="text-danger deleteImage" data-id="{{$images->id}}">Delete</a>
                            </div>
                        </div>
                       @endforeach
                      
                        <span id="inputAdd"></span>
                        <!-- </span> -->
                        
                      </div>
                      <input type="button" id="addImage" value="Add Image" class="btn btn-primary">
                    </div>
                   
                    <div class="form-group">
                        <label for="formGroupExampleInput">Enter Product Description</label>
                        <textarea class="form-control" name="product_description" id="textAreaExample1" rows="4" placeholder="enter product description">{{$product->product_description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update Product</button>
                  </form>
            </div>
        </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        $('#addImage').click(function(){
            $('#inputAdd').append('<input type="file" name="product_image[]" multiple="true"/>');  	
        });
 
        var id = $("input[name=editId]").val();
        // alert(id);
        // var url = "{{ route('products.update', ":id") }}";
        // url = url.replace(':id', id);
        // alert(url);
        $.ajax({
            type:'POST',
            enctype: 'multipart/form-data',
            url:"{{ route('products.update',"id") }}",
             data: formdata,
             data: new FormData(this),
        });
    });
</script>
@endsection