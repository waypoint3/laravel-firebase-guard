<?php

namespace Waypoint3\LaravelFirebaseGuard;

use Illuminate\Contracts\Auth\Authenticatable;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class User implements Authenticatable
{
    public function __construct(protected array $claims) {}

    public function get(string $name): ?string
    {
        return array_key_exists($name, $this->claims) ? $this->claims[$name] : null;
    }

    public function __get(string $name): ?string
    {
        return $this->get($name);
    }

    public function id(): ?string
    {
        return $this->getAuthIdentifier();
    }

    public function toArray(): array
    {
        return $this->claims;
    }

    public function getAuthIdentifierName(): string
    {
        return 'sub';
    }

    public function getAuthIdentifier(): string
    {
        return $this->get($this->getAuthIdentifierName());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAuthPasswordName(): Throws
    {
        throw new \Exception('Not supported in Firebase');
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAuthPassword(): Throws
    {
        throw new \Exception('Not supported in Firebase');
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRememberToken(): Throws
    {
        throw new \Exception('Not supported in Firebase');
    }

    /**
     * @codeCoverageIgnore
     */
    public function setRememberToken(mixed $value): Throws
    {
        throw new \Exception('Not supported in Firebase');
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRememberTokenName(): Throws
    {
        throw new \Exception('Not supported in Firebase');
    }
}