<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Mail;

class SalesEmailController extends Controller
{
    public function index(Request $request,$id){
        $request->validate(
            [
                'email_id'=>'required|regex:/(.+)@(.+)\.(.+)/i'
            ]
        );
        //Making PDF
        $config = getConfig();    
        $saleDetails = Sale::saleInvoiceData($id);
        $sale= $saleDetails[0];
        $saleItem = $saleDetails[1];
        $pdf = PDF::loadView('salesInvoice.pdf', compact('sale','config','saleItem'));
        $pdf->setPaper('A3', 'landscape'); 
        //  return $pdf->stream();
       $path= Storage::put('public/storage/uploads/'.'-'.rand().'_'.time().'.'.'pdf', $pdf->output());
        Storage::put($path,$pdf->output());
        $sale =DB::table('sales')->where('sales.id',$id)
        ->join('accounts','accounts.id','=','sales.account_id')
        ->get(['sales.invoice_number','accounts.name','sales.net_amount','sales.sales_date'])
        ->first();
        $data['name'] = $sale->name;
        $data['invoice_number'] = $sale->invoice_number;
        $data['content'] = $request->content;
        $data['net_amount'] = $sale->net_amount;
        $data['sales_date'] =$sale->sales_date;


        $mail=Mail::send('Mail.salesMails',$data,function($message) use ($sale,$request,$pdf,$path){
            $message->from('pujafancystore1@gmail.com');
            $message->to($request->email_id);//Receiver Email Address
            $message->subject($request->subject);
            $message->attachData($pdf->output(),$path,[
                'mime'=>'application/pdf', 
                'as'=>$sale->name.'.'.'pdf'
            ]);
        });
        return redirect()->route('sales.invoiceView',['id'=>$id]);
    }

    
}
