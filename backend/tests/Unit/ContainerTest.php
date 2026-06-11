<?php

use Api\Container;

beforeEach(function () {
    $ref = new ReflectionClass(Container::class);
    $ref->setStaticPropertyValue('instance', null);
});

it('should be a singleton', function () {
    $container1 = Container::getInstance();
    $container2 = Container::getInstance();

    expect($container1)->toBe($container2);
});

it('should set and get a binding', function () {
    $container = Container::getInstance();
    $container->set('foo', fn () => 'bar');

    expect($container->get('foo'))->toBe('bar');
});

it('should return the same instance on repeated gets', function () {
    $container = Container::getInstance();
    $container->set('foo', fn () => (object) ['id' => 1]);

    $instance1 = $container->get('foo');
    $instance2 = $container->get('foo');

    expect($instance1)->toBe($instance2);
});

it('should check if a binding exists', function () {
    $container = Container::getInstance();
    $container->set('foo', fn () => 'bar');

    expect($container->has('foo'))->toBeTrue();
    expect($container->has('baz'))->toBeFalse();
});

it('should throw when getting an unregistered binding', function () {
    $container = Container::getInstance();

    $container->get('non_existent');
})->throws(RuntimeException::class, "No binding registered for 'non_existent'.");
