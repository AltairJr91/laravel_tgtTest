<?php

namespace App\Services;

use App\Repositories\AddressRepositoryInterface;
use App\DTOs\AddressDTO;

class AddressServices
{
    public function __construct(private AddressRepositoryInterface $addressRepository) {}

    public function getAllAddresses()
    {
        return $this->addressRepository->all();
    }

    public function getAddressById(int $id)
    {
        return $this->addressRepository->find($id);
    }

    public function createAddress(AddressDTO $data)
    {
        // verifica se o endereço já existe para o usuário
        $existingAddress = $this->findAddressByDTO($data);
        if ($existingAddress) {
            return response()->json(['message' => 'Address already exists.', 'address' => $existingAddress], 409);
        }
        
        $dataArray = [
            'street' => $data->street,
            'number' => $data->number,
            'complement' => $data->complement,
            'neighborhood' => $data->neighborhood,  
            'cep' => $data->zipCode,
            'user_id' => $data->userId,
        ];
        
        return $this->addressRepository->create($dataArray);
    }

    public function updateAddress(int $id, AddressDTO $data)
    {
        $data = [
            'street' => $data->street,
            'number' => $data->number,
            'complement' => $data->complement,
            'neighborhood' => $data->neighborhood,  
            'zip_code' => $data->zipCode,
            'user_id' => $data->userId,
        ];
        return $this->addressRepository->update($id, $data);
    }

    public function deleteAddress(int $id)
    {
        return $this->addressRepository->delete($id);
    }

    public function getAddressesByUserId(int $userId)
    {
        return $this->addressRepository->findByUserId($userId);
    }

    public function findAddressByDTO(AddressDTO $dto)
    {
        $addresses = $this->addressRepository->findByUserId($dto->userId);

        foreach ($addresses as $address) {
            if (
                $address->street === $dto->street &&
                $address->number === $dto->number &&
                $address->complement === $dto->complement &&
                $address->neighborhood === $dto->neighborhood &&
                $address->cep === $dto->zipCode
            ) {
                return $address;
            }
        }

        return null;
    }
}
