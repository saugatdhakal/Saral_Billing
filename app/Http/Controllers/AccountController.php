<?php
namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\Sale;
use App\Models\AccountLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AccountPaymentRequest;
use Illuminate\Support\Arr;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = DB::table('accounts')->where('deleted_by',NULL)->get(['id','name','account_type','shop_address','home_address','contact_number_1','vat_number','pan_number']);
        return view('account.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }

    public function  paymentView(){
        return view('account.payment');
    }

    public function searchSaleInvoice($account_id){
        return DB::table('sales')
        ->where('sales.account_id',2)
        ->where('sales.sales_type','CREDIT')
        ->get(['sales.id','sales.invoice_number','sales.sales_date']);
    }

    public function savePayment(AccountPaymentRequest $request){
        $supplier = DB::table('sales')->where('id',$request->sale_id)->get(['invoice_number'])->first();
         $old_supplierLedger = DB::table('account_ledgers')
         ->where('account_id',$request->account_id)
         ->get('balance')
         ->last();
        if ($old_supplierLedger->balance < $request->amount) {
            // return redirect()->back()->with('Error', 'Amount is Greater then Balance');
             return redirect()->back()->withFail(['Amount is Greater then Balance','Check your balance']);// can add multiple value on error
        }
        $ledger = new AccountLedger();
        $ledger->date = $request->payment_date;
        $ledger->particular = $request->pay_mode;
        $ledger->debit_amount = $request->amount;
        $ledger->credit_amount = 0;
        $ledger->balance= $old_supplierLedger->balance - $request->amount;
        $ledger->account_id = $request->account_id;
        $ledger->invoice_number = $supplier->invoice_number;
        $ledger->save();

        return redirect()->route('accountLedger.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if($request->CutomerType =="Business"){
            $request->validate([
                'companyName'=>'required',
                'shopAddress'=>'required',
                'vat'=>'required|max:8|min:0',
                'pan'=>'required|max:8|min:0',
                'shopAddress'=>'required',
                'mobile2'=>'required|min:10|max:10'   
            ]);
        }
        $request->validate([
                'homeAddress'=>'required', 
                'mobile1'=>'required|min:10|max:10',    
                'email'=>'required|regex:/(.+)@(.+)\.(.+)/',    
                'remark'=>'required'
        ]);
        
        $account = new Account;
        $account->account_type= $request->CutomerType;
        $account->name= $request->name;
        if($request->CutomerType =="Business"){
            $account->shop_name = empty($request->companyName)? null:$request->companyName;
            $account->shop_address = empty($request->shopAddress)? null:$request->shopAddress;
            $account->vat_number =  empty($request->vat)?null:$request->vat;
            $account->pan_number =  empty($request->pan)?null:$request->pan;
            $account->contact_number_2 = empty($request->mobile2)?null:$request->mobile2;
        }
        $account->home_address = empty($request->homeAddress)? null:$request->homeAddress;
        $account->contact_number_1 = empty($request->mobile1)?null:$request->mobile1;
        $account->email = empty($request->email)?null:$request->email;
        $account->remark=  empty($request->remark)?null:$request->remark;
        $account->save();
        return redirect()->route('Account.index')->with('successes','Customer Create Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        // $accountmodel = DB::table('Accounts')->find($id);
        $user = DB::table('Accounts')->select('name','account_type','shop_name','home_address','shop_address','contact_number_1','contact_number_2',
        'email','vat_number','pan_number','remark')->find($id);
         return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = DB::table('accounts')->find($id);
        // return $account;
        return view('account.update',['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         if($request->CutomerType =="Business"){
            $request->validate([
                'companyName'=>'required',
                'shopAddress'=>'required',
                'vat'=>'required|max:8|min:0',
                'pan'=>'required|max:8|min:0',
                'shopAddress'=>'required',
                'mobile2'=>'required|min:10|max:10'   
            ]);
        }
        $request->validate([
                'homeAddress'=>'required', 
                'mobile1'=>'required|min:10|max:10',    
                'email'=>'required|regex:/(.+)@(.+)\.(.+)/',    
                'remark'=>'required'
        ]);
        $flag=true;
        $account = Account::find($id);
        $account->account_type= $request->CutomerType;
        $account->name= $request->name;
        if($request->CutomerType == "Business"){
            $account->shop_name = empty($request->companyName)? null:$request->companyName;
            $account->shop_address = empty($request->shopAddress)? null:$request->shopAddress;
            $account->contact_number_2 = empty($request->mobile2)?null:$request->mobile2;
            $account->vat_number =  empty($request->vat)?null:$request->vat;
            $account->pan_number =  empty($request->pan)?null:$request->pan;
        }
        $account->home_address = empty($request->homeAddress)? null:$request->homeAddress;
        $account->contact_number_1 = empty($request->mobile1)?null:$request->mobile1;
        $account->email = empty($request->email)?null:$request->email;
        $account->remark= empty($request->remark)?null:$request->remark;
        $account->save();
        return redirect()->route('Account.index')->with('success','Customer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $account = Account::find($id);
        $account->status = 'INACTIVE';
        $account->delete();
        return "DeleteSuccess";
    }
    public function trashDelete($id)
    {
        Account::onlyTrashed()->find($id)->forceDelete();
        return "DeleteSuccess";
    }
    public function trashRestore($id)
    {
        $account = Account::withTrashed()->find($id);
        $account->status = 'ACTIVE';
        $account->restore();
        return "DataRestore";
    }
    public function trash(){
        $trash=Account::onlyTrashed()->get(['id','name','account_type','contact_number_1','shop_address','home_address','vat_number','pan_number']);
        return view('account.trash',['trash'=>$trash]);
    }
}
