<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component;

class Git
{
    public readonly bool $isAvailable;

    public function __construct(protected string $path)
    {
        $this->isAvailable = Command::test('git --version');
    }

    public function setup(string $message): void
    {
        if ($this->isAvailable) {
            $this->init();
            $this->addAll();
            $this->commit($message);
        }
    }

    public function init(): void
    {
        exec("git -C \"{$this->path}\" init");
    }

    public function addAll(): void
    {
        exec("git -C \"{$this->path}\" add -A");
    }

    public function commit(string $message): void
    {
        exec("git -C \"{$this->path}\" commit -m '{$message}'");
    }
}
