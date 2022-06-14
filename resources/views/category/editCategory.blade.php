@extends('layouts.mainCss')
@section('content')
<div class="col-12 grid-margin stretch-card">
   <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Category</h4>
                <p class="card-description">
                      <!-- IF CATEGORY ADDED SUCCESFULLY IT WILL RETURN SUCCESS MESSAGE TO USER ON THE FRONT VIEW --> 
                    @if($message=Session::get('success'))
                        <div class="alert alert-success">
                             <p>{{$message}}</p>
                        </div>
                    @endif
                  </p>
                  <form class="forms-sample" action="#" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="exampleInputName1">Category Name</label>
                      <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}"id="formGroupExampleInput" placeholder="Enter Category">
                      <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Enter Category Description</label>
                      <textarea class="form-control" name="description" id="textAreaExample1" rows="4" placeholder="enter category description">{{$category->description}}</textarea>
                      <small class="text-danger">{{$errors->first('category_description') }}</small>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update Category</button>
                  </form>
         </div>
     </div>
</div>
@endsection