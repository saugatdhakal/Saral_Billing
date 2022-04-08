<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class SupplierLedger extends Model
{
    use HasFactory;

    public function storeLedger($supplierLedger,$purchase,$supplier_id){
        $supLedgerAmout = DB::table('supplier_ledgers')->where('supplier_id',$supplier_id)->get('balance')->first();
        $balances = empty($supLedgerAmout->balance)? 0 : $supLedgerAmout->balance;
        $supplierLedger->date = $purchase->bill_date;
        $supplierLedger->purchase_type =$purchase->purchase_type;
        $supplierLedger->invoice_number = $purchase->invoice_number;
        $supplierLedger->credit_amount =$purchase->net_amount;
        $supplierLedger->debit_amount = 0;
        $supplierLedger->balance = (int)$purchase->net_amount + $balances;
        $supplierLedger->supplier_id = $supplier_id;
        $supplierLedger->purchase_id = $purchase->id;
        $supplierLedger->save();
    }
    public static function getSuppliers() {
      return  DB::table('suppliers')->get(['id','name']);
    }
}
