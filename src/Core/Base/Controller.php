<?php
namespace App\Core\Base;

use App\Core\Application;
use App\Core\Request;
use App\Core\Response;

abstract class Controller extends Component
{

    public Request $request;

    public Response $response;

    public function run(Application $app, array $args = [])
    {
        $this->boot();

        $this->request = $app->getRequest();

        $this->response = $app->getResponse();

        $reflection = new \ReflectionMethod($this, '__invoke');

        foreach ($reflection->getParameters() as $param) {
            $args[$param->name] = $this->resolveArg($param, $this->request);
        }

        return $reflection->invokeArgs($this, $args);
    }

    protected function resolveArg(\ReflectionParameter $param, Request $request): mixed
    {
        try {
            $value = $request->get($param->name);
            $className = $param->getType()->getName();

            if (class_exists($className) && ! is_null($value)) {
                $value = new $className($value);
            }

            if (is_null($value) && ! $param->allowsNull()) {
                if (! $param->isDefaultValueAvailable()) {
                }
                $value = $param->getDefaultValue();
            }

            return $value;
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException("[$param->name]: " . $e->getMessage());
        }
    }
}