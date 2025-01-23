<?php 

namespace App\Service;

use App\Dto\LoginDTO;
use App\Dto\UserDTO;
use App\Repository\UserRepository;
use App\Utils\PasswordHasher;
use Symfony\Component\HttpFoundation\Session\Session;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        
    }

    public function register(UserDTO $userDTO): void
    {
        try {

            if ( $this->userRepository->findOneBy(['email' => $userDTO->email]) ) {
                throw new \Exception('E-mail já cadastrado', 400);
            }

            $userDTO->senha = PasswordHasher::hash($userDTO->senha);

            $this->userRepository->register($userDTO);

        } catch (\Exception $e) {
            throw new \Exception('Erro ao registrar usuário: ' . $e->getMessage(), 500);
        }
        
    }

    public function login(LoginDTO $loginDTO): array
    {
        try {
            $user = $this->userRepository->findOneBy(['email' => $loginDTO->email]);

            if ( !$user ) {
                throw new \Exception('Crendenciais inválidas', 401);
            }

            if ( !PasswordHasher::verify($loginDTO->senha, $user->getSenha()) ) {
                throw new \Exception('Crendenciais inválidas', 401);
            }

            $session = new Session();
            $session->set('user', $user->getId());
            $session->set('email', $user->getEmail());
            $session->set('nome', $user->getNome());

            return [
                'id' => $user->getId(),
                'nome' => $user->getNome(),
                'email' => $user->getEmail(),
                'criado_em' => $user->getCriadoEm()->format('d-m-Y H:i:s')
            ];

        } catch (\Exception $e) {
            throw new \Exception('Erro ao realizar login: ' . $e->getMessage(), 500);
        }
    }
}