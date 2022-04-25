<?php

namespace App\Http\Controllers;

use App\Models\SalesReturn;
use App\Models\SaleItem;

use App\Models\SalesReturnItems;
use App\Models\Stock;
use App\Models\Sale;

use Illuminate\Http\Request;
use App\Http\Requests\SalesReturnRequest;
use App\Http\Requests\SalesReturnItemRequest;
use Illuminate\Support\Facades\Storage;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Config;



class SalesReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('salesReturn.index');
    }

    public function ajaxIndex(){
         $data =DB::table('sales_returns')
         ->where('sales_returns.deleted_by',NULL)
         ->join('accounts','sales_returns.account_id','=','accounts.id')
         ->select(['sales_returns.id','sales_returns.invoice_number','sales_returns.transaction_date',
         'sales_returns.sales_return_date','sales_returns.net_amount','accounts.name','sales_returns.status'])
         ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn='';

                if ($row->status == 'RUNNING') {
                $actionBtn.=
                ' 
                    <a class="btnEdit" href="'.route('salesReturn.returnItem',["id"=>$row->id]).'" >
                    <i class="fa-solid fa-money-check-pen fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                else if ($row->status == 'COMPLETED') {
                $actionBtn.=
                ' 
                    <a class="btnComplete" href="'.route('purchase.invoice1',["id"=>$row->id]).'" >
                   <i class="fa-solid fa-file-invoice fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                
                $actionBtn.=' 
                    <a data-toggle="modal" class="viewSaleReturn" id="'.$row->id.'"  data-target="#modal">
                        <i class="fa-solid fa-eye fa-xl"></i>
                    </a>
                    &#160
                    <a  class="deleteSaleReturn" id="'.$row->id.'">
                        <i class="fa-solid fa-trash-can-list fa-xl"></i>
                    </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            
            ->make(true);
    }

    public function trashIndex()
    {
        
        return view('salesReturn.trash');
    }

    public function trashAjaxIndex(){
         $data =DB::table('sales_returns')
         ->whereNotNull('sales_returns.deleted_by')
         ->join('accounts','sales_returns.account_id','=','accounts.id')
         ->select(['sales_returns.id','sales_returns.invoice_number',
         'sales_returns.transaction_date','sales_returns.sales_return_date',
         'sales_returns.net_amount','accounts.name','sales_returns.status'])
         ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $actionBtn='';

                if ($row->status == 'RUNNING') {
                $actionBtn.=
                ' 
                    <a class="btnEdit" href="'.route('salesReturn.returnItem',["id"=>$row->id]).'" >
                    <i class="fa-solid fa-money-check-pen fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                else if ($row->status == 'COMPLETED') {
                $actionBtn.=
                ' 
                    <a class="btnComplete" href="'.route('purchase.invoice1',["id"=>$row->id]).'" >
                   <i class="fa-solid fa-file-invoice fa-xl"></i>
                    </a>
                    &#160
                ';
                }
                
                $actionBtn.=' 
                    <a data-toggle="modal" class="viewSaleReturn" id="'.$row->id.'"  data-target="#modal">
                        <i class="fa-solid fa-eye fa-xl"></i>
                    </a>
                    &#160
                    <a  class="deleteSaleReturn" id="'.$row->id.'">
                        <i class="fa-solid fa-trash-can-list fa-xl"></i>
                    </a>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            
            ->make(true);
    }



    

    

    public function moduleView($id)
    {
        return DB::table('sales_returns')
        ->where('sales_returns.id',$id)
         ->join('accounts','sales_returns.account_id','=','accounts.id')
         ->select([
         'sales_returns.invoice_number',
         'sales_returns.transaction_date',
         'sales_returns.sales_return_date',
         'sales_returns.invoice_number',
         'sales_returns.total_amount',
         'sales_returns.net_amount',
         'accounts.name',
         'sales_returns.status',
         ])
         ->get()->first(); 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale = DB::table('sales')
        ->where('sales.status','COMPLETED')
        ->join('accounts','accounts.id','=','sales.account_id')
        ->get(['sales.id','sales.sales_date','sales.invoice_number','accounts.id as account_id','accounts.name']);
        
        $invoice = getSalesReturnInvoice();
         return view('salesReturn.create',compact('invoice','sale'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesReturnRequest $request)
    {
        $fiscal=getFiscalYear();
        $salesReturn = new SalesReturn();

        $accountId = DB::table('sales')
        ->where('id',$request->salesId)
        ->get('account_id')->first();

        \DB::transaction(function()use($request,$fiscal,$salesReturn,$accountId){
        $salesReturn->fiscal_year = '0'.$fiscal[0].'/'.'0'.$fiscal[1];
        $salesReturn->invoice_number =getSalesReturnInvoice();   
        $salesReturn->storeSaleReturn($salesReturn,$request,$accountId);
        $config = Config::get()->first();
        $config->sales_return_bill_number = $config->sales_return_bill_number + 1;
        $config->save();
        });
        return redirect()->route('salesReturn.returnItem',[$salesReturn->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesReturn  $salesReturnsReturn
     * @return \Illuminate\Http\Response
     */ 
    //TODO: Value sending into the sale return item 
    public function returnItem($id)
    {
        //salesReturn details top 
        $salesReturn = DB::table('sales_returns')
        ->where('sales_returns.id',$id)
        ->join('accounts', 'accounts.id','=','sales_returns.account_id')
        ->select(['sales_returns.id','accounts.name','sales_returns.sales_id','accounts.home_address','accounts.shop_address','sales_returns.transaction_date','sales_returns.sales_return_date','sales_returns.invoice_number'])
        ->get()->first();

        //Select Data from Sale Items of particular sales_id
        $saleItem = DB::table('sale_items')
        ->join('products','products.id','=','sale_items.product_id')
        ->where('sale_items.sales_id',$salesReturn->sales_id)
        ->whereNull('sale_items.sales_return_id')
        ->select(['products.name','products.unit','sale_items.id','sale_items.quantity','sale_items.rate'])
        ->get();


        $saleReturnItem = DB::table('sales_return_items')
        ->where('sales_return_items.sales_returns_id',$id)
        ->join('products','products.id','=','sales_return_items.product_id')
        ->join('stocks','stocks.id','=','sales_return_items.stock_id')
        ->get(['sales_return_items.id','sales_return_items.quantity','products.unit','sales_return_items.rate','sales_return_items.amount','products.name','stocks.batch_number']);

        return view('salesReturn.saleReturnItem',compact('salesReturn','saleItem','saleReturnItem'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesReturn  $salesReturnsReturn
     * @return \Illuminate\Http\Response
     */
    public function returnItemSave(SalesReturnItemRequest $request,$id)
    {
       SalesReturn::storeSaleItem($request,$id);
        return back();
    }

    public function returnItemDelete($id){
        SalesReturn::deleteOperation($id);
    }

    public function returnItemComplete($sales_return_id){
        $return_item = DB::table('sales_return_items')
        ->where('sales_returns_id',$sales_return_id)
        ->get(['amount']);
        
        $sumAmount = $return_item->sum('amount');  
        $roundedAmount =ceil($sumAmount);
        \DB::transaction(function()use($sales_return_id,$return_item, $sumAmount,$roundedAmount){
        $saleReturn = SalesReturn::where('id',$sales_return_id)->get()->first();
        $saleReturn->total_amount = $sumAmount;
        $saleReturn->rounding =round($roundedAmount-($sumAmount),2);
        $saleReturn->net_amount = $roundedAmount;
        $saleReturn->status = 'COMPLETED';
        $saleReturn->save();

        $sale = Sale::where('id',$saleReturn->sales_id)->get()->first();
        $sale->status = "RETURN";
        $sale->save();
        });

        return redirect()->route('salesReturn.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesReturn  $salesReturnsReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesReturn $salesReturnsReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesReturn  $salesReturnsReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         try {
            $salesReturn = SalesReturn::find($id)->get();
            $salesReturn->delete();
            return "DeleteSuccess";
         }
        catch (\Exception $e) 
        {
             //! Not returning back with error message 
            //  return redirect()->back()->withFail(['Code Match with other product','Please use default code']);// can add multiple value on error
        }
    }
}
