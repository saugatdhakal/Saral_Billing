<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseItemRequest extends FormRequest
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
            'quantity'=> 'required|integer',
            'rate'=>'required|integer',
            'wholesalePrice'=> 'required|integer',
            'productId'=> 'required|integer',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->rate > $this->wholesalePrice){
                $validator->errors()->add('field', 'Wholesale Price must be greater then purchase price!');
            }
        });
    }
}
