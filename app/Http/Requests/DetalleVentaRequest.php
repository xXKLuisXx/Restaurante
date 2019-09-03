<?php

namespace libreria\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleVentaRequest extends FormRequest
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
            'id_venta'=>'required',
            'id_producto'=>'required',
            'cantidad'=>'required'
        ];
    }
}
