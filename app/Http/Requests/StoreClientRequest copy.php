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
            'phone' => 'required|numeric|digits:11',
            'id_card_image' => 'sometimes|image|mimes:jpg,jpeg,png,|max:2048',
            'payment_method' =>'required',
            'payment_full_name' => 'required_if:payment_method,direct',
            'payment_email' => 'required_if:payment_method,direct|email',
            'payment_name_paypal' => 'required_if:payment_method,paypal',
            'payment_email_paypal' => 'required_if:payment_method,paypal||email',
            'payment_full_name_cheque' => 'required_if:payment_method,cheque',
            'payment_email_cheque' => 'required_if:payment_method,cheque||email',
            'disclaimer' =>'accepted',
            
           
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


                'disclaimer.accepted' =>'You must agree to the terms and conditons!',
                'signature64.required' =>'We want to see you signatures please!',
                
                
            ];
        }


}
