<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Filter;
use Auth;
use DataTables;


class CategoryController extends Controller
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

    public function index(Category $categoryies,Request $request)
    {
        return view('category.listOfCategories');
        //get all list of category  
        // $categoryies=Category::with('user')->where('user_id',Auth::user()->id)->sortable()->paginate(3);
        // $user=Auth::user()->id;

        // $user=Auth::user()->id;
     
       
        // $category=Category::with('user')->where('user_id',Auth::user()->id)->get();
 
        // if(request()->ajax())
        // {
        //     if($request->filter_category_name!=null)
        //     {
        //         $categoryies = $categoryies->where('category_name','like','%'.$request->filter_category_name.'%');
        //     }
        //     if(!empty($request->filter_date))
        //     {

        //     }
        // }
     
       
            // $categoryies=Category::select('*')->get();
            // dump($categoryies);
    }

    public function getData(Request $request)
    {
        // dd($request->all());
        $columns = array( 
            0 =>'id', 
            1 =>'category_name',
            2=> 'description',
            3=> 'created_at',
            
        );

        $totalData=Category::with('user')->count();   

        
        $totalFiltered = $totalData; 
        $draw = $request->get('draw');
        // dump($draw);
        $start = $request->get('start');
        // dump($start);
        $limit = $request->get('length');

       
        // dump($limit);
            // $order = $request->query('order', array(1, 'asc'));   
        
            // $sortColumnName = $columns[$order[0]['column']];
            
            // $columnIndex_arr = $request->get('order');
            // dd($columnIndex_arr);
            $columnName_arr = $request->get('columns');
            // dump($columnName_arr);
            $order_arr = $request->get('order');
            // dump($order_arr);
            $search_arr = $request->input('columns');
        
            $columnIndex = $order_arr[0]['column']; // Column index
            // dump($columnIndex);
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            // dump($columnName);
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
            // dump($columnSortOrder);
            // $searchValue = $search_arr['value']; // Search value

        
 
            ## Search 
            // $searchQuery = " ";
            // if($request['serachByName'] != ''){
            //     $totalFiltered = $totalFiltered->where('category_name','like','%'.$request['searchByName'].'%');
            // }
            // if($request['searchByDate ']!= ''){
            //     $totalFiltered=$totalFiltered->whereDate('created_at',$request['searchByDate']);
            // }

            // $conditions=$request->searchByName;
   
            $categoryies = Category::select('*');
            if($request->has('searchByName') && $request->searchByName!=null)
            {
                $categoryies = $categoryies->where('category_name','like','%'.$request->searchByName.'%');
            }
            //search for date
            if($request->has('searchByDate') && $request->searchByDate!=null)
            {   
                $categoryies=$categoryies->whereDate('created_at',$request->searchByDate);
            }
            $categoryies = $categoryies->orderBy($columnName,$columnSortOrder)
            ->skip($start)
            ->take($limit)
            ->get();

            // $categoryies = Category::where(function($totalFiltered) use ($request){
            //     $totalFiltered->where('category_name','like','%'.$request['searchByName'].'%')
            //     ->whereDate('created_at',$request['searchByDate']);
            // }) ->orderBy($columnName,$columnSortOrder)
            // ->skip($start)
            // ->take($limit)
            // ->get();
                
            //     'category_name', 'like', '%' .$request['searchByName'].'%')
            // ->orWhereDate('created_at',$request['serachByDate'])
            // ->orderBy($columnName,$columnSortOrder)
            // ->skip($start)
            // ->take($limit)
            // ->get();
            // dd($categoryies);
        // $categoryies = Category::with('user')->where('user_id',Auth::user()->id)->offset($start)
        // ->limit($limit)
        // ->orderby($order,$dir)->search(function($query){
        //     if($request()->has('categoy_name'))
        //     {
        //         $query->where('category_name','like','%'.request('category_name').'%');
        //     }
        // })
        // ->get();
    
        // $count = $categoryies->count();
        // $categoryiesObj = $categoryies->get()->toArray();

        foreach ($categoryies as $category) {
            $category->actions = ['id' => $category->id];
        }

        $dataArr = [
            'aaData' => $categoryies,
            "draw" => intval($draw),
            "iTotalRecords" => $totalData,
            "iTotalDisplayRecords" => $totalData,
        ];

        // dd($dataArr);
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
        // for going to create category page
        return view('category.createNewCategory');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $categoryies)
    {
        // dd($request);
        $request->validate([
            'category_name'=>'required',
            'description'=>'required|string|max:50',
        ]);

      
        $categoryies = Category::create([
            'user_id' => auth()->user()->id,
            'category_name' => $request->input('category_name'),
            'description'=>$request->input('description')
        ]);
       

        // dd($categoryies);
  
        // $categories->save();
        return redirect()->route('categoryies.index')->with('success','category added succefully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category=Category::find($id);
       
        return view('category.showCategory',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        //
        $category=Category::find($category);
     
        return view('category.editCategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
      

        $request->validate([
            'category_name'=>'required',
            'description'=>'required|string|max:50'
        ]);

        // dd($category->update($request->all()));
        // dd($category->save());

        $category=Category::find($id);
        $category->category_name=$request->category_name;
        $category->description=$request->description;
        $category->save();

        return redirect()->route('categoryies.index')->with('success','category updated succefully');

      
    
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $id=$request->id;
        // dd($id);
        //
        // dd($id);
        $category=Category::where('id',$id)->delete();
        
        return redirect()->route('categoryies.index')->with('message-deleted','category deleted successfully.');
    }
}
