<?php

namespace App\DTOs;

class AddressDTO {
    public function __construct(
        public string $street,
        public string $number,
        public ?string $neighborhood,
        public ?string $complement,
        public string $zipCode,
        public ?int $userId
    ) {}
}