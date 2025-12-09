<?php

namespace App\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
         //Vou deixar o padrao como true para o teste
        //Mas é possivel implementar uma lógica de autorização aqui ao inves de ser nos routes/middlewares
        //ex: return $this->user()->can('create', User::class);
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|string|unique:users,cpf',
            'phone' => 'nullable|string',
            'password' => 'required|min:6'
        ];
    }
}
