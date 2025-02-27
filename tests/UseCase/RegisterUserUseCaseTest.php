<?php
namespace Tests\UseCase;

use PHPUnit\Framework\TestCase;
use App\Attributes\Email;
use App\Attributes\Name;
use App\Attributes\Password;
use App\Entities\User;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\RegisterUserUseCase;

class RegisterUserUseCaseTest extends TestCase
{

    public function testRegisterUser()
    {
        $email = new Email('test@example.com');
        $name = new Name('John Doe');
        $password = new Password('P@ssw0rd!123');

        // Crear un mock de UserRepositoryInterface
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $userRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class));

        // Pasar el mock al constructor de RegisterUserUseCase
        $useCase = new RegisterUserUseCase($userRepository);
        $user = $useCase->run(new RegisterUserRequest($name, $email, $password));

        // Verificar que el usuario se creó correctamente
        $this->assertTrue(uuid_is_valid($user->getId()->getValue()));
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($password, $user->getPassword());
    }
}