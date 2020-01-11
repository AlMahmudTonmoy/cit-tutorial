<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormValidation extends FormRequest
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
          'category_id' => 'required',
          'product_name' => 'required',
          'product_price' => 'required|numeric',
          'product_quantity' => 'required|numeric',
          'alert_quantity' => 'required|numeric',
        ];
    }
    public function message()
    {
        return [
          'product_name.required' => 'Product Name Ken des nai re vai??',
          'product_name.alpha' => 'Emne Likhsen ken??',
          'product_price.required' => 'দাম  দাও নাই কেন ??',
        ];
    }
}
