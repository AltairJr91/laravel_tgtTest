<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function index(): Collection
    {
        return User::all();
    }

    public function find(int $id): ?User
    {
        return User::with(['addresses','permissions','roles'])->find($id);
    }

    public function delete(int $id): ?User
    {
        $user = User::find($id);
        if ($user) $user->delete();
        return $user;
    }

    public function findByCpf(string $cpf): ?User
    {
        return User::where('cpf', $cpf)->first();
    }
}
