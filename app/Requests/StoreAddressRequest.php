<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        //Vou deixar o padrao como true para o teste
        //Mas é possivel implementar uma lógica de autorização aqui ao inves de ser nos routes/middlewares
        //ex: return $this->user()->can('create', Address::class);
        return true;
    }

    public function rules(): array
    {
        return [
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ];
    }
}