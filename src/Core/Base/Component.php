<?php
namespace App\Core\Base;

abstract class Component
{

    protected function boot(): void
    {
        $this->resolve('__construct');
    }

    protected function resolve(string $function): void
    {
        $reflection = new \ReflectionMethod($this, $function);

        foreach ($reflection->getParameters() as $param) {
            $className = $param->getType()->getName();
            if (property_exists($this, $param->name) && class_exists($className)) {
                $property = new \ReflectionProperty($this, $param->name);
                if (! $property->isInitialized($this)) {
                    $instance = (new \ReflectionClass($className))->newInstanceWithoutConstructor();
                    $property->setValue($this, $instance);
                }
            }
        }
    }
}