<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component;

class Composer
{
    public function __construct(protected string $path)
    {
    }

    public function install(): static
    {
        exec("composer -d \"{$this->path}\" install");

        return $this;
    }

    public function bump(): static
    {
        exec("composer -d \"{$this->path}\" bump");

        return $this;
    }
}
