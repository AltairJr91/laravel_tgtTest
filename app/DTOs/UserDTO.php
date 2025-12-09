<?php

namespace App\DTOs;

class UserDTO {
    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public string $cpf,
        public ?string $password
    ) {}
}