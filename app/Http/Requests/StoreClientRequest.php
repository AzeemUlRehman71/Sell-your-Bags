<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
           // 'id_card_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,|max:2048',
            'id_card_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
            'productImage' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
            'payment_method' =>'required',
            'payment_full_name' => 'required_if:payment_method,direct',
            'payment_email' => 'sometimes|nullable|required_if:payment_method,direct|email',
            // 'payment_direct_phone_number' => 'sometimes|nullable|required_if:payment_method,direct',
            // 'payment_direct_account_number' => 'sometimes|nullable|required_if:payment_method,direct',
            // 'payment_direct_routing_number' => 'sometimes|nullable|required_if:payment_method,direct',
            // 'payment_direct_account_type' => 'sometimes|nullable|required_if:payment_method,direct',
            // 'payment_direct_bank_name' => 'sometimes|nullable|required_if:payment_method,direct',   
            'payment_name_paypal' => 'required_if:payment_method,paypal',
            'payment_email_paypal' => 'sometimes|nullable|required_if:payment_method,paypal|email',
            'payment_full_name_cheque' => 'required_if:payment_method,cheque',
            'payment_email_cheque' => 'sometimes|nullable|required_if:payment_method,cheque|email',

            'payment_full_name_echeck' => 'required_if:payment_method,echeck',
            'payment_email_echeck' => 'sometimes|nullable|required_if:payment_method,echeck|email',

            'disclaimer' =>'required',
            'signature64' => 'required',
           
        ];

        
    }
    public function messages()
        {
            return [
                'name.required' => 'A name is required',
                'email.required' =>'We need to know your email address!',
                'phone.required' =>'We need to know your phone number!',
                //'phone.digits' =>'We need to know your phone number!',
                'payment_full_name.required_if' =>'Please provide your full name!',
                'payment_email.required_if' =>'We need to know your email address!',
                'payment_name_paypal.required_if' =>'Please provide your full name!',
                'payment_email_paypal.required_if' =>'We need to know your email address!',
                'payment_full_name_cheque.required_if' =>'Please provide your full name!',
                'payment_email_cheque.required_if' =>'We need to know your email address!',
                'disclaimer.required' =>'You must agree to the terms and conditons!',
                'signature64.required' =>'We want to see you signatures please!',
                'payment_direct_phone_number.required_if' =>'Please provide your phone number!',
                'payment_direct_account_number.required_if' =>'Please provide your account number!',
                'payment_direct_routing_number.required_if' =>'Please provide your routing number!',
                'payment_direct_account_type.required_if' =>'Please provide your account type!',
                'payment_direct_bank_name.required_if' =>'Please provide your bank name!',
                
            ];
        }


}
