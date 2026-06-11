<?php

declare(strict_types=1);

namespace Api;

use RuntimeException;

class Container
{
    private static ?self $instance = null;

    /** @var array<string, callable(self): mixed> */
    private array $bindings = [];

    /** @var array<string, mixed> */
    private array $instances = [];

    public static function getInstance(): self
    {
        return self::$instance ??= new self;
    }

    /**
     * @param  callable(self): mixed  $factory
     */
    public function set(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
        unset($this->instances[$id]);
    }

    /**
     * @template T
     *
     * @param  class-string<T>  $id
     * @return T
     */
    public function get(string $id): mixed
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (! isset($this->bindings[$id])) {
            throw new RuntimeException("No binding registered for '{$id}'.");
        }

        $this->instances[$id] = ($this->bindings[$id])($this);

        return $this->instances[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }
}
