<?php

use Api\ClassLoader\ContainerClassLoader;
use Api\Container;

beforeEach(function () {
    $ref = new ReflectionClass(Container::class);
    $ref->setStaticPropertyValue('instance', null);
});

it('should load a class registered in the container', function () {
    $container = Container::getInstance();
    $std = new stdClass;
    $container->set(stdClass::class, fn () => $std);

    $loader = new ContainerClassLoader;
    $result = $loader->loadClass(stdClass::class);

    expect($result)->toBe($std);
});

it('should instantiate a class not registered in the container', function () {
    $loader = new ContainerClassLoader;

    $result = $loader->loadClass(stdClass::class);

    expect($result)->toBeInstanceOf(stdClass::class);
});

it('should load a class method via call_user_func_array', function () {
    $loader = new ContainerClassLoader;
    $class = new class
    {
        public function greet(string $name): string
        {
            return "Hello, {$name}!";
        }
    };

    $result = $loader->loadClassMethod($class, 'greet', ['name' => 'World']);

    expect($result)->toBe('Hello, World!');
});

it('should load a closure via call_user_func_array', function () {
    $loader = new ContainerClassLoader;
    $closure = fn (int $a, int $b) => (string) ($a + $b);

    $result = $loader->loadClosure($closure, ['b' => 3, 'a' => 2]);

    expect($result)->toBe('5');
});
