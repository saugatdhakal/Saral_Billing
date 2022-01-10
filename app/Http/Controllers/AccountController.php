<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // return $request;

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
        // return $account;
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
        // $account = DB::table('Accounts')->find($id);
        // DB::table('Accounts')->where('id', $id)->delete();
        
        $account = Account::find($id);
        $account->status = 'INACTIVE';
        $account->delete();
        return "DeleteSuccess";
    }
    public function trashDelete($id)
    {

        Account::onlyTrashed()->find($id)->forceDelete();
        // Account::find($id)->forceDelete();
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
