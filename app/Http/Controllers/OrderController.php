<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Student;
use App\Models\Dummy;
use App\Models\OrderDetail;
use Illuminate\Support\Collection;
use App\Models\Product;
use Auth;
use Datatables;


class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_order_list(Request $request)
    {
        
        // $user=Auth::user()->id;
        // $order=Order::with('user')->where('user_id',Auth::user()->id)->sortable();
        // dd($order);
          // $order=Order::sortable()->paginate(5);

        $order=Order::select('*')->sortable();
        if($request->searchByDate && $request->searchByDate != ''){
            $order= $order->whereDate('created_at','like','%'.$request->searchByDate.'%');
        }

        if($request->searchByUserName && $request->searchByUserName != ''){
            $order=$order->whereHas('user',function($query) use ($request){
                $query->where('name','like','%'.$request->searchByUserName.'%');
           });
        }
        
      

        $order = $order->paginate(3);
        // dd($order);
        // return view('user.dummy_datatable',compact('dummy'));
        // $html=view('admin.listOfOrder',compact('order'))->render();
            return view('admin.listOfOrder',compact('order'));
        //  return response()->json(['html'=>$html]);
    
    }

    public function getOrder()
    {
       
        // $products=Product::select('*');
        $ordersData=[];
        
        $orders=Order::with('getProducts')->get();

        foreach($orders as $order)
        {
            $ordersData[] = array(
                'id' => $order->id,
                'name'=>$order->user->name,
                'total'=>$order->total,
                'created_at'=>$order->created_at
            );
        }
        // dd($productsData);
    
        //search for id
        //   if ($request->has('searchId') && $request->searchId!=null) {             
        //       $categoryies=$categoryies->where('id',$request->searchId);
        //   }
  
        //   //search for category_name
        //   if($request->has('searchName') && $request->searchName!=null){
        //       $categoryies = $categoryies->where('category_name','like','%'.$request->searchName.'%');
        //   }
  
        //   //search for description
        //   if($request->has('searchDescription') && $request->searchDescription!=null){
        //       $categoryies=$categoryies->where('description','like','%'.$request->searchDescription.'%');
        //   }

        // //search for date
        // if($request->has('searchByDate') && $request->searchByDate!=null){   
        //     $categoryies=$categoryies->whereDate('created_at',$request->searchByDate);
        // }
        // $categoryies = Category::sortable()->paginate(3);

        // $products=$products->paginate(3);
        $count = $ordersData;
        $ordersObj = $ordersData;
       
        $dataArr = [
            'data' => $ordersObj,

            
        ];
        return response()->json($dataArr);
        // return view('category.listOfCategories'); 
    }

    public function perticular_order_show($id)
    {

        
        $orders=Order::find($id)->load('order_details.user');
        // ->load('order_details')->get();
        // dd($orders);
       

        return view('admin.showOrder',compact('orders'));
        // $order=Order::where('id',$id)->first();
        // $orderDetails=OrderDetail::with('order')->where('order_id',,$order)->get();
        // dd($orderDetails);
    }


    // public function index()
    // {
        
    //     return view('user.datatable');
    // }

    // public function getStudents(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Student::get();
    //         dd($data);
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    // public function index(Request $request)

    // {

    //     if ($request->ajax()) {

    //         $data = Dummy::select('*');

    //         return Datatables::of($data)

    //                 ->addIndexColumn()

    //                 ->addColumn('action', function($row){

     

    //                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

    

    //                         return $btn;

    //                 })

    //                 ->rawColumns(['action'])

    //                 ->make(true);

    //     }

        

    //     return view('user.datatable2');

    // }


    //jquery datatable
    public function datatable()
    {
        $dummy=Student::all();
        
        return view('user.dummy_datatable',compact('dummy'));
    }


    //ajax datatable
    public function ajax()
    {
        return view('user.ajax');
    }

}

