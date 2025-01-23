<?php
namespace App\Dto;
use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'O campo email é obrigatório')]
        public string $email,

        #[Assert\NotBlank(message: 'O campo senha é obrigatório')]
        public string $senha,
    ) {}

}