<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $config=DB::table('configs')->get()->first();
        return view('config.index',compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(Request $request)
    {
        $config=DB::table('configs')->get()->first();
        $request->validate([
                'name'=>'required',
                'address'=>'required',
                'contact_number'=>'required||integer',
                'email'=>'required|email',
                'fiscal_year'=>'required||integer',
                'sales_bill_number'=>'required||integer',
                'sales_return_bill_number'=>'required||integer',
                'purchase_bill_number'=>'required||integer',
                'purchase_return_bill_number'=>'required||integer',
            ]);
        if(!empty($request->limite_credit)){
            $request->validate([
                'limite_credit'=>'integer',
            ]);
        }
        if(!empty($request->min_stock)){
             $request->validate([
                'min_stock'=>'integer'
            ]);
        }
        // return $request;    
        $config = Config::get()->first();
        $config->name = $request->name;
        $config->address = $request->address;
        $config->contact_number =$request->contact_number;
        $config->email = $request->email;
        $config->fiscal_year = $request->fiscal_year;
        $config->sales_bill_number= $request->sales_bill_number;
        $config->sales_return_bill_number = $request->sales_return_bill_number;
        $config->purchase_bill_number = $request->purchase_bill_number;
        $config->purchase_return_bill_number =$request->purchase_return_bill_number;
        if(!empty($request->limite_credit)){
             $config->credit_over_due_warning = $request->limite_credit;
        }else{
            $config->credit_over_due_warning =null;
        }

        if(!empty($request->min_stock)){
             $config->minimum_stock_warning = $request->min_stock;
        }else{
            $config->minimum_stock_warning =null;
        }
        
        $config->save();

        return back();
           
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
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
