@foreach($product->product_images as $images)
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="imgDiv_{{$images->id}}">
                              <img class="card-img-top" src="{{ asset('product_image/'.$images->product_image) }}" height="200" width="30" > 

                              <a href="{{route('deleteImg',$images->id)}}" class="text-danger deleteImage" data-id="{{$images->id}}">Delete</a>
                            </div>
                        </div>
                       @endforeach