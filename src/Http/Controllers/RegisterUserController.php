<?php
namespace App\Http\Controllers;

use App\Core\Base\Controller;
use App\Services\RegisterUserUseCase;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResponseDTO;
use App\Attributes\Name;
use App\Attributes\Email;
use App\Attributes\Password;

class RegisterUserController extends Controller
{

    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
    }

    public function __invoke(Name $name, Email $email, Password $password)
    {
        $registerUserRequest = new RegisterUserRequest($name, $email, $password);
        // Ejecutar el caso de uso
        $user = $this->registerUserUseCase->run($registerUserRequest);

        // Crear el DTO de respuesta
        $responseDTO = new UserResponseDTO($user);

        // Devolver la respuesta en formato JSON
        return $this->response->json($responseDTO, 201);
    }
}