<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserServices
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function create(UserDTO $dto)
    {

        $data = [
            'name' => $dto->name,
            'email' => $dto->email,
            'cpf' => $dto->cpf,
            'phone' => $dto->phone,
            'password' => bcrypt($dto->password),
        ];
        return $this->repo->create($data);
    }

    public function update(UserDTO $data, int $id)
    {
        $payload = [
            'name' => $data->name,
            'email' => $data->email,
            'cpf' => $data->cpf,
            'phone' => $data->phone,
        ];
        if (!empty($data->password)) {
            $payload['password'] = bcrypt($data->password);
        }

        return $this->repo->update($id, $payload);
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function find(int $id): ?User
    {
        return $this->repo->find($id);
    }

    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }

    public function findByCpf(string $cpf)
    {
        return $this->repo->findByCpf($cpf);
    }
}
