<?php

declare(strict_types=1);

namespace Api\ClassLoader;

use Api\Container;
use Pecee\SimpleRouter\ClassLoader\IClassLoader;

class ContainerClassLoader implements IClassLoader
{
    /**
     * @param  class-string  $class
     * @return object
     */
    public function loadClass(string $class)
    {
        $container = Container::getInstance();

        if ($container->has($class)) {
            return $container->get($class);
        }

        return new $class;
    }

    /**
     * @param  object  $class
     * @param  array<int, mixed>  $parameters
     */
    public function loadClassMethod($class, string $method, array $parameters): string
    {
        /** @phpstan-ignore cast.string, argument.type */
        return (string) call_user_func_array([$class, $method], array_values($parameters));
    }

    /**
     * @param  array<int, mixed>  $parameters
     */
    public function loadClosure(callable $closure, array $parameters): string
    {
        /** @phpstan-ignore cast.string */
        return (string) call_user_func_array($closure, array_values($parameters));
    }
}
