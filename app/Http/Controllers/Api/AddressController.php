<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Services\AddressServices;
use App\DTOs\AddressDTO;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(private AddressServices $service) {}

    public function store(Request $request, User $user)
    {
        $dto = new AddressDTO(
            street: $request->input('street'),
            number: $request->input('number'),
            complement: $request->input('complement'),
            neighborhood: $request->input('neighborhood'),
            zipCode: $request->input('zip_code'),
            userId: $user->id
        );

        $address = $this->service->createAddress($dto);

        if ($address instanceof JsonResponse) {
            return $address; // Retorna a resposta JSON se o endereço já existir
        }

        return response()->json(['message' => 'Address added successfully.', 'address' => $address], 201);
    }
}
