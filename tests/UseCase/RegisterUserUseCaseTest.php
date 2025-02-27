<?php
namespace Tests\UseCase;

use PHPUnit\Framework\TestCase;
use App\Attributes\UserId;
use App\Attributes\Email;
use App\Attributes\Name;
use App\Attributes\Password;
use App\Entities\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\RegisterUserUseCase;

class RegisterUserUseCaseTest extends TestCase
{

    public function testRegisterUser()
    {
        $userId = new UserId('123e4567-e89b-12d3-a456-426614174000');
        $email = new Email('test@example.com');
        $name = new Name('John Doe');
        $password = new Password('securepassword123');

        // Crear un mock de UserRepositoryInterface
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class));

        // Pasar el mock al constructor de RegisterUserUseCase
        $useCase = new RegisterUserUseCase($userRepository);
        $user = $useCase->execute($userId, $email, $name, $password);

        // Verificar que el usuario se creó correctamente
        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($password, $user->getPassword());
    }
}