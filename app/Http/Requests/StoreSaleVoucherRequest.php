<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleVoucherRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name'=>'required',
            'customer_phone'=>'required',
            'pay_amount'=>'required',
            'net_amount'=>'required',
            'payment_type'=>'required',
            'total_price'=>'required',
            'balance'=>'required',
        ];
    }
}
