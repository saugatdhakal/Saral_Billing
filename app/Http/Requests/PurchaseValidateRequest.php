<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 
            'billNo' => 'required|max:10',
            'billDate'=> 'required|date_format:Y-m-d',
            'transactionDate'=>'required|date_format:Y-m-d',
            'purchaseDate'=> 'required|date_format:Y-m-d',
            'lrNo'=> 'required',
            'supplierId'=> 'required',
        ];
    }
}
