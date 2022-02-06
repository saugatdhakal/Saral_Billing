<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class CategoryController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // return DB::table('categories')
        //         ->join('users','users.id','=','categories.created_by')
        //         ->select('users.name as username','categories.name as categorynames','categories.created_at','categories.updated_at')
        //         ->where('categories.deleted_by','=',NULL)
        //         ->get();
        return view('category.index');
    }

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
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return back();
    }
    public function yajraTableIndexs(){
        // $data = DB::table('categories')->where('deleted_by',NULL)->get(['id','name','created_by','created_at','updated_at']);
                $data = DB::table('categories')
                ->join('users','users.id','=','categories.created_by')
                ->select('categories.id','users.name as username','categories.name as categorynames','categories.created_at','categories.updated_at')
                ->where('categories.deleted_by','=',NULL)
                ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="btnEdit" data-id="'.$row->id.'">
                <i class="far fa-edit fa-lg"></i> 
                </a>
                 &#160
                <a  class="deleteCategory" id="'.$row->id.'">
                <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category = DB::table('categories')->select('id','name',)->find($id);
         return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
    }
    public function categoryUpdate(Request $request){
       
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::find($id); 
       $category->delete();
       return "DeleteSuccess";
    }
    public function CategoryTrash(){
        return view('category.trash');  
    }

    public function restoreCategory($id){
        $category = Category::withTrashed()->find($id);
        $category->restore();
        return "DataRestore";
    }
    public function forceDeleteCategory($id){
        Category::onlyTrashed()->find($id)->forceDelete();
        return "DeleteSuccess";
    }

    public function trash(){
        $data = DB::table('categories')
                ->join('users','users.id','=','categories.created_by')
                ->select('categories.id','users.name as username','categories.name as categorynames','categories.created_at','categories.updated_at')
                ->whereNotNull('categories.deleted_by')
                ->get();
        return DataTables::of($data)
         ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn =' 
                <a class="restoreTrash" id="'.$row->id.'">
                 <i class="fas fa-undo-alt fa-lg"></i>
                </a>
                &#160
                <a class="deleteCategory" id="'.$row->id.'">
                    <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
