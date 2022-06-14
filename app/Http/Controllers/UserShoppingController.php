<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetail;
use Auth;

class UserShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::get();
      
        return view('user.shoppingCartList',compact('product'));
    }


    public function store_cart(Request $request)
    {
        // dd($request);
        $id=$request->id;
        $product=Product::where('id',$id)->first();
        
        if($product && $product->product_quantity > 0)
        {
            // dump($product);
            $upd=Product::find($id);
            $upd->product_quantity=intval($product->product_quantity)-1;
            $upd->save();

            $checkCart=cart::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
            if($checkCart === null)
            {
                $addCart=new Cart;
                $addCart->user_id=auth()->user()->id;
                $addCart->product_id=$id;
                $addCart->qty=1;
                $addCart->price=$product->product_price;
                $addCart->total=$product->product_price*1;
                $addCart->save();
            }
            else
            {
                $addCart=Cart::find($checkCart->id);
                $addCart->user_id=auth()->user()->id;
                $addCart->product_id=$id;
                $addCart->qty=$checkCart->qty+1;
                $addCart->price=$product->product_price;
                $addCart->total=$product->product_price*($checkCart->qty+1);
                $addCart->save();
            }
        }

        return response()->json(['success'=>true]);
    }

    public function show_carts()
    {
        $carts=Cart::with('product')->where('user_id',auth()->user()->id)->get();
        // $html=view('user.dyanamic',compact('carts'))->render();
        // return response()->json(['html'=>$html]);


        
        return view('user.dyanamic',compact('carts'));


    }

    public function show_products(Request $request)
    {

        $product=Product::with('product_images')->get();
        // $productImage=ProductImage::all();
        
        $html=view('user.dynamicProduct',compact('product'))->render();
        return response()->json(['html'=>$html]);
    }

    public function cartCounter()
    {

        $cartCounter=Cart::where('user_id',auth()->user()->id)->sum('qty');
        return response()->json(['count'=>$cartCounter]);
    }

    public function checkout()
    {

        $cartTotal=Cart::where('user_id',auth()->user()->id)->sum('total');
        $order=new Order;
        $order->user_id=auth()->user()->id;
        $order->total=$cartTotal;
        $order->save();

        $carts=Cart::where('user_id',auth()->user()->id)->get();
        if(count($carts)>0)
        {
            foreach($carts as $cart)
            {
                $addorderDetail=new OrderDetail;
                $addorderDetail->user_id=auth()->user()->id;
                $addorderDetail->product_id=$cart->product_id;
                $addorderDetail->order_id=$order->id;
                $addorderDetail->qty=$cart->qty;
                $addorderDetail->price=$cart->price;
                $addorderDetail->save();
                $cartDelete=Cart::where('id',$cart->id)->delete();
            }
        }

        return redirect()->back();
    }


    public function deleteCart(Request $request)
    {
        
        $id=$request->id;
        dump($id);

        $cart=Cart::where('id',$id)->first();
        if($cart)
        {
            $qty=$cart->qty;

            $productData=Product::where('id',$cart->product_id)->first();
            if($productData)
            {
                $product=Product::find($cart->product_id);
                $product->product_quantity=$productData->product_quantity+$qty;
                $product->save();
            }
            $cartDelete=Cart::where('id',$id)->delete();
        }

        return response()->json(['success'=>true]);
        
    }

     public function show($id)
    {
        $product=Product::find($id);

        // $product=Product::with('product_images')->where('id','=',17)->get();
        // dd($product);
        return view('user.detailPage',compact('product'));
    }

    // public function remove_cart(Request $request)
    // {
     
    //     $id=$request->id;
    //     $cartDelete=Cart::where('id',$id)->delete();
      
    // }

 
    // public function addToCart($id,Request $request)
    // {

    //     $product = Product::findOrFail($id);

    //     $cart = session()->get('cart', []);
    //     if(isset($cart[$id])) {

    //         $cart[$id]['quantity']++;

    //     } else {

    //         $cart[$id] = [

    //             "name" => $product->product_name,

    //             "quantity" => 1,

    //             "price" => $product->product_price

          

    //         ];

    //     }
    
       

    //     session()->put('cart', $cart);
    //     // dump($cart);
    //    return redirect()->route('cartListing');
    // }
    
    // public function remove(Request $request)

    // {
    //     dd($request);
    //     if($request->id) {

    //         $cart = session()->get('cart');

    //         if(isset($cart[$request->id])) {

    //             unset($cart[$request->id]);

    //             session()->put('cart', $cart);

    //         }

    //         session()->flash('success', 'Product removed successfully');

    //     }

    // }

    // //show detail Page
  

    // public function cartListing()
    // {
    //     return view('user.dyanamic');
    // }
    // public function checkout(Request $request)
    // {

    //     $subtotal=0;

    //     $cart = session()->get('cart', []);
        
    //     if($cart)
    //     {
    //         foreach($cart as $id=>$details)
    //         {
    //             $subtotal =$details['quantity'] * $details['price'];
    //             $pro_name=$details['name'];
    //             $pro_quantity=$details['quantity'];
    //             $pro_price=$details['price'];
    //             $pro_id=$id;
                
    //             // $orders = Order::create([
    //             //     'user_id' => Auth::user()->id,
    //             //     'product_id'=>$request->get('product_id'),
    //             //     'product_name' => $request->input('product_name'),
    //             //     'product_price' => $request->input('product_price'),
    //             //     'product_quantity' => $request->input('product_quantity'),
    //             //     'total'=>$request->input('subtotal')


    //             // ]);
    //             $orders=new Order();
    //             $orders->user_id=Auth::user()->id;
    //             $orders->product_id = $pro_id;
    //             $orders->product_name=$pro_name;
    //             $orders->product_price=$pro_price;
    //             $orders->product_quantity=$pro_quantity;
    //             $orders->total=$subtotal;

                
    //             $orders->save();
        

               

    //             // dd($orders);

    //         }
    //     }
        

      
       
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
