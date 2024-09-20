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
            'email' => 'required',
            'phone' => 'required',
            'id_card_image' => 'required|image|mimes:jpg,jpeg,png,|max:2048',
            'payment_method' =>'required',
            'payment_full_name' => 'required_if:payment_method,direct',
            'payment_email' => 'required_if:payment_method,direct',
            'payment_name_paypal' => 'required_if:payment_method,paypal',
            'payment_email_paypal' => 'required_if:payment_method,paypal',
            'payment_full_name_cheque' => 'required_if:payment_method,cheque',
            'payment_email_cheque' => 'required_if:payment_method,cheque',
            
           
            'signature64' => 'required',
           
        ];

        
    }
    public function messages()
        {
            return [
                'name.required' => 'A name is required',
                
            ];
        }


}
