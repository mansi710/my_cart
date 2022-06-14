<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Collection;

use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Product $products,Request $request)
    {
      
  
        return view('product.listOfProducts');

        //
        // $user=Auth::user()->id;
        // $products=Product::select('*');
    
    //     // $products=Product::with('getCategories')->select('*')->sortable();
    //     // dd($products);
    //     // $products=Product::with('categories')->where('user_id',Auth::user()->id)->sortable();
        
        
    //     //search for id
    //     if($request->has('searchId') && $request->searchId!=null){
    //         $products=$products->where('id',$request->searchId);
    //     }

    //       //search for category_name
    //       if($request->has('searchCategoryName') && $request->searchCategoryName!=null){
    //            $products=$products->whereHas('getCategories',function($query) use ($request){
    //                 $query->where('category_name','like','%'.$request->searchCategoryName.'%');
    //            });
    //       }
        
         

    //     //search for product_name
    //     if($request->has('searchName') && $request->searchName!=null){
    //         $products=$products->where('product_name','like','%'.$request->searchName);
    //     }

    //      //search for product_price
    //      if($request->has('searchPrice') && $request->searchPrice!=null){
    //          $products=$products->where('product_price',$request->searchPrice);
    //      }

       

    //   //search for date
    //   if($request->has('searchByDate') && $request->searchByDate!=null){
    //       $products=$products->whereDate('created_at','=',$request->searchByDate);
    //   }
    
    //   $products=$products->paginate(3);
    }

    public function getProduct(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'category_id',
            2 =>'product_name',
            3 =>'product_price',
            4 =>'product_quantity',
            5 =>'product_description',
            6 =>'created_at',
            
        );
        // $products=Product::select('*');
        $productsData=[];
        
        $products=Product::with('getCategories')->get();

        foreach($products as $product)
        {
            $productsData[] = array(
                'id' => $product->id,
                'name'=>$product->user->name,
                'category_name' => $product->getCategories->category_name,
                'product_name'=>$product->product_name,
                'product_price'=>$product->product_price,
                'product_quantity'=>$product->product_quantity,
                'product_description'=>$product->product_description,
                'created_at'=>$product->created_at
            );
        }
        // dd($productsData);
    
        // // count total data 
        $totalData=Product::with('getCategories')->count();  
             dump($totalData);
        $totalFiltered = $totalData; 
        dump($totalFiltered);

        $draw = $request->get('draw');
           dump($draw);
        $start = $request->get('start');
           dump($start);
        $limit = $request->get('length');
            dump($limit);
        $columnName_arr = $request->get('columns');
          dump($columnName_arr);
        $order_arr = $request->get('order');
           dump($order_arr);
        $search_arr = $request->input('columns');
            dump($search_arr);
        $columnIndex = $order_arr[0]['column']; // Column index
           dump($columnIndex);
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            dump($columnName);
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
          dump($columnSortOrder);
        // for counting records
                  $count = $productsData;
                        dump($count);
        //for select all data  of product
        // $productsData = Product::with('getCategories')->select('*');
        // if($request->has('searchByName') && $request->searchByName!=null)
        // {
        //     $productsData = $productsData->where('product_name','like','%'.$request->searchByName.'%');
        // }
        // //search for date
        // if($request->has('searchByDate') && $request->searchByDate!=null)
        // {   
        //     $productsData=$productsData->whereDate('created_at',$request->searchByDate);
        // }
        // $productsData = $productsData->orderBy($columnName,$columnSortOrder)
        // ->skip($start)
        // ->take($limit)
        // ->get();


                $productsObj = $productsData;
       
                // dd($productsObj);
        // foreach ($products as $product) {
           
        //     $product->actions = ['id' => $product->id];
        // }

        $dataArr = [
            'data' => $productsObj,
            // 'aaData' => $productsData,
            // "draw" => intval($draw),
            // "iTotalRecords" => $totalData,
            // "iTotalDisplayRecords" => $totalData,
            
        ];
        return response()->json($dataArr);
        // return view('category.listOfCategories'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //when to create product admin can go here

            //fetfch all category from category model and pass with create product
        $data=Category::all();

        return view('product.createNewProduct',compact('data'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        // $imageName=time().'.'.$request->file('product_image')->getClientOriginalExtension();
        $request->validate([
            'product_name'=>'required',
            'product_price'=>'required',
            'product_quantity'=>'required',
            'product_description'=>'required|string|max:300',
            'product_image'=>'required'
        ]);
      
        $image=$request->product_image;
        $destinationPath='product_image/';
        $profileImage=date('YmdHis').".".$image->getClientOriginalExtension();
         $image->move($destinationPath,$profileImage);

        $products = Product::create([
            'category_id'=>$request->get('category_id'),
            'user_id' => auth()->user()->id,
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'product_quantity' => $request->input('product_quantity'),
            'product_image'=>$profileImage,
            'product_description' => $request->input('product_description')
           
        ]);

        //     $products=new Product();
        //    dd( $products->category_id=$request->category_id);
        //     $products->product_name=$request->product_name;
        //     $products->product_price=$request->product_price;
        //     $products->product_quantity=$request->product_quantity;
        //     $products->product_description=$request->product_description;
        //     $products->save();

            // dd($products);

        return redirect()->route('products.index')->with('success','product added succefully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // $product=Product::find($id);
        // $product=Product::find($id);
        // $products=Product::with('product_images')->get();
        $product=Product::find($id)->load('product_images')->get();

        return view('product.showProduct',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //
        
    // $product = Product::where('id', '=' , $product)->find($product);
    
    // $categories = Category::get();
    // dd($categories);

        // $category=Category::all();
        // // dd($category);
        // $product=DB::table('products')->where('id',$product)->first();
        $product=Product::with('product_images')->where('id',$product)->first();
        // dd($product);
        $category=Category::all();
        // DB::table('categories')->get();
        
        // $product=Product::with('getCategories')->where('id',$product)->get();
        return view('product.editProduct',compact('product','category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        //

        // $imageName=time().'.'.$request->file('product_image')->getClientOriginalExtension();
        // dd($imageName);
        // $request->validate([
        //     'product_name'=>'required',
        //     'product_price'=>'required',
        //     'product_quantity'=>'required',
        //     'product_description'=>'required|string|max:300',
        //     'product_image'=>'required'
        // ]);

        // $img = $request->file('product_image');
        // // dd($img);
        // if ($file = $request->product_image) {
        //     $destinationPath='product_image/';
           
        //     $profileImage=date('YmdHis').".".$file->getClientOriginalExtension();
        //     $file->move($destinationPath,$profileImage);
        //     }


         
           

        $productNew=Product::find($id);
        $productNew->category_id=$request->category_id;
        $productNew->product_name=$request->product_name;
        $productNew->product_price=$request->product_price;
        $productNew->product_quantity=$request->product_quantity;
        // $productNew->product_image=$profileImage;
        // 1 $productNew->product_image=$request->file('product_image')->storeAs(public_path('product_image'),$imageName);
        $productNew->product_description=$request->product_description;
        $productNew->save();

  
        foreach($request->product_image as $k => $value)
        {
            $new_name=$k.time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('product_image'),$new_name);

            $img=new ProductImage;
      
            $img->product_id=$id;
            $data=$img->product_image=$new_name;
            $img->save();


        }
        $dataArr = [
            'productNew' => $productNew,
            "img" => $img,
        ];

        return redirect()->back();
        // return response()->json(['success'=>true]);
        // return response()->json($dataArr);
            // $productNew,$img);
        // return redirect()->route('products.index')->with('success','product updated succefully');
    }

    //new Method for POST
    // public function updateProduct(Request $request,$id)
    // {
        
    //     // dump($request->all());
    //     $productNew=Product::find($id);
    //     dd($productNew);
    //     $productNew->category_id=$request->category_id;
    //     $productNew->product_name=$request->product_name;
    //     $productNew->product_price=$request->product_price;
    //     $productNew->product_quantity=$request->product_quantity;
    //     // $productNew->product_image=$profileImage;
    //     // 1 $productNew->product_image=$request->file('product_image')->storeAs(public_path('product_image'),$imageName);
    //     $productNew->product_description=$request->product_description;
    //     $productNew->save();

       
    //     if(count($request->product_image) >= 0)
    //     {
         
    //         foreach($request->product_image as $k => $value)
    //         {
    //             $new_name=$k.time().'.'.$value->getClientOriginalExtension();
    //             $value->move(public_path('product_image'),$new_name);

    //             $img=new ProductImage;
    //             $img->product_id=$id;
    //             $data=$img->product_image=$new_name;
    //             $img->save();


    //         }
    //     }
    //     $dataArr = [
    //         'productNew' => $productNew,
    //         "img" => $img,
    //     ];

    //     return response()->json(["true"=>true]);
    //     return redirect()->back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete perticular product
        $products=Product::where('id',$id)->delete();
        
        return redirect()->route('products.index')->with('message-deleted','product deleted successfully.');
    }


    // Upload Multile Image
    // public function uploadImageMultiple()
    // {
    //     dd('xyz');
    // }


    //delete Image
    public function deleteImg($id)
    {
        
        $products=ProductImage::where('id',$id)->delete();
        
        return redirect()->back()->with('success','image deleted succefully');
    }
}
