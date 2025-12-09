<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user');
        return [
            'name' => 'required|string',
            'email' => ["required","email","unique:users,email,{$id},id"],
            'cpf' => ["required","string","unique:users,cpf,{$id},id"],
            'phone' => 'required|string',
            'password' => 'nullable|string|min:6'
        ];
    }
} 
