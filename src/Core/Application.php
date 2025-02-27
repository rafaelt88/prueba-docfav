<?php
namespace App\Core;

use App\Core\Base\Controller;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;

final class Application
{

    private EntityManager $entityManager;

    private Request $request;

    private Response $response;

    private Controller $controller;

    private string $controllersNamespace = 'App\\Http\\Controllers\\';

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->request = new Request();
        $this->response = new Response();
    }

    public function run(): void
    {
        try {
            $controllerName = trim(preg_replace('#\W+#', ' ', $this->request->path));

            if (! empty($controllerName)) {
                $controllerName = str_replace(' ', '', ucwords($controllerName));

                $controllerClass = $this->controllersNamespace . $controllerName . 'Controller';

                $reflection = (new \ReflectionClass($controllerClass));
                $this->controller = $reflection->newInstanceWithoutConstructor();

                $content = $this->controller->run($this);
            } else {
                $content = 'Hello !';
            }

            $this->response->send($content);
        } catch (\ReflectionException $e) {
            $this->response->send('Not found.', 404);
        } catch (\Throwable $e) {
            $this->response->send($e->getMessage(), 400);
        }
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function getDb(): Connection
    {
        return $this->getEntityManager()->getConnection();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}