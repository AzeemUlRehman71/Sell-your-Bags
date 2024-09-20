<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'required',
             'email' => 'email|required',
             'phone' => 'sometimes|nullable|numeric',
             'id_card_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,',
             'payment_method' =>'required',
             'payment_full_name' => 'required_if:payment_method,direct,paypal,cheque',
             'payment_email' => 'required_if:payment_method,direct,paypal,cheque|email',

               // 'payment_direct_phone_number' => 'sometimes|nullable|required_if:payment_method,direct',
                //'payment_direct_account_number' => 'sometimes|nullable|required_if:payment_method,direct',
                //'payment_direct_routing_number' => 'sometimes|nullable|required_if:payment_method,direct',
                //'payment_direct_account_type' => 'sometimes|nullable|required_if:payment_method,direct',
                //'payment_direct_bank_name' => 'sometimes|nullable|required_if:payment_method,direct',   


            //  'payment_name_paypal' => 'required_if:payment_method,paypal',
            //  'payment_email_paypal' => 'sometimes|nullable|required_if:payment_method,paypal|email',
            //  'payment_full_name_cheque' => 'required_if:payment_method,cheque',
            //  'payment_email_cheque' => 'sometimes|nullable|required_if:payment_method,cheque|email',


        ];
    }
}
