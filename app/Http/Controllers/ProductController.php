<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       
      
        // return  Product::get_finacial_year_range();
        return view('product.index');
    }
    public function ajaxIndex(){
        $data = DB::table('products')
                ->where('products.deleted_by','=',NULL)
                ->join('categories','products.category_id','=','categories.id')
                ->select('products.id','products.name as name','categories.name as category','products.unit','products.product_code as code')
                ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="/product/'.$row->id.'/edit" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                <a data-toggle="modal" class="viewProduct" id="'.$row->id.'"  data-target="#transportModel">
                 <i class="far fa-eye fa-lg"></i>
                </a>
                &#160
                <a  class="deleteProduct" id="'.$row->id.'">
                <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code=Product::generateUniqueNumber(); // unique number
        return view('product.create',['code'=>$code]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|max:50',
        'code' => 'required|min:6|max:6',
        'unit'=> 'required',
        'category'=>'required'
        ]);
       
         //Checking if user edited code match with other product code    
        $isUnique = Product::isCodeUniqueCheck($request->code);
        if(!$isUnique){
             return redirect()->back()->withFail(['Code Match with other product','Please use default code']);// can add multiple value on error
        }
        
        $product = new Product();
        $product->name = $request->name;
        $product->item_type = $request->item_type;
        $product->product_code = $request->code;
        $product->unit = $request->unit;
        $product->category_id = $request->category;
        $product->save();
        return redirect()->route('product.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= Product::with('creator','editor','category')
        ->where('id',$id)
        ->get(['id','name','item_type','product_code','unit','category_id','created_by','updated_by'])
        ->first();  
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $product = DB::table('products')->where('id', $id)->get(['id','name','unit','category_id','item_type','product_code'])->first();
       
       return view('product.edit',['prod'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
        'name' => 'required|max:50',
        'unit'=> 'required',
        'category'=>'required'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->category_id = $request->category;
        $product->item_type = $request->item_type;
        // $product->product_code = $request->code;
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status = 'INACTIVE';
        $product->delete();
        return "DeleteSuccess";
    }
    public function productTrash(){
        return view('product.trash');
    }
    public function trashAjax(){
        $data = DB::table('products')
                ->whereNotNull('products.deleted_by')
                ->join('categories','products.category_id','=','categories.id')
                ->select('products.id','products.name as name','categories.name as category','products.unit','products.product_code as code')
                ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" href="/product/'.$row->id.'/edit" >
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                <a class="restoreTrash" id="'.$row->id.'">
                 <i class="fas fa-undo-alt fa-lg"></i>
                </a>
                &#160
                <a  class="deleteProduct" id="'.$row->id.'">
                <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function restoreProduct($id){
        $product = Product::onlyTrashed()->find($id);
        $product->status = 'ACTIVE';
        $product->restore();
        return "DataRestore";
    }

    public function forceDeleteProduct($id){
        Product::onlyTrashed()->find($id)->forceDelete();
        return "DeleteSuccess";
    }
}


