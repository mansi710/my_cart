@foreach($category as $data)
             
             <option value="{{$data->id}}"
                 @if($data->id == $product->category_id)
                 selected
                 @endif
             >
                 
             </option>
         @endforeach