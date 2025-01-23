<?php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;


class UserDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'O campo nome é obrigatório!')]
        #[Assert\Length(min: 3, max: 255,
            minMessage: 'O campo nome deve ter no mínimo {{ limit }} caracteres',
            maxMessage: 'O campo nome deve ter no máximo {{ limit }} caracteres')]
        public string $nome,

        #[Assert\NotBlank(message: 'O campo email é obrigatório')]
        #[Assert\Email(message: 'O campo email deve ser um email válido')]
        public string $email,

        #[Assert\NotBlank(message: 'O campo senha é obrigatório')]
        #[Assert\Length(min: 6, max: 255,
            minMessage: 'O campo senha deve ter no mínimo {{ limit }} caracteres',
            maxMessage: 'O campo senha deve ter no máximo {{ limit }} caracteres')]
        public string $senha,
    ) {}

}