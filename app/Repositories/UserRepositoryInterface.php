<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    
    public function create(array $data);
    public function update(int $id, $data);
    public function find(int $id);
    public function delete(int $id);
    public function index();
    public function findByCpf(string $cpf);
}
