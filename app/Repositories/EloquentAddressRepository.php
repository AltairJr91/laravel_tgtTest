<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;


class EloquentAddressRepository implements AddressRepositoryInterface
{
    public function all()
    {
        return Address::all();
    }

    public function find(int $id): ?Address
    {
        return Address::find($id);
    }

    public function create(array $data): Address
    {
        return Address::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $address = Address::find($id);

        if (!$address) {
            return false;
        }

        return $address->update($data);
    }

    public function delete(int $id): bool
    {
        $address = Address::find($id);

        if (!$address) {
            return false;
        }

        return $address->delete();
    }

    public function findByUserId(int $userId): Collection
    {
        return Address::where('user_id', $userId)->get();
    }
}
