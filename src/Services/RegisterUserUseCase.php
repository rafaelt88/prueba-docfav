<?php
namespace App\Services;

use App\Core\Base\Component;
use App\Entities\User;
use App\Events\UserRegisteredEvent;
use App\Events\UserRegisteredEventHandler;
use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\DoctrineUserRepository;
use App\Http\Requests\RegisterUserRequest;

class RegisterUserUseCase extends Component
{

    private DoctrineUserRepository $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
    }

    public function run(RegisterUserRequest $request): User
    {
        $this->boot();

        if ($this->userRepository->findByEmail($request->email)) {
            throw new UserAlreadyExistsException();
        }

        $user = new User($request->name, $request->email, $request->password);

        $this->userRepository->save($user);

        // Disparar evento de dominio
        (new UserRegisteredEventHandler())->__invoke(new UserRegisteredEvent($user));

        return $user;
    }
}