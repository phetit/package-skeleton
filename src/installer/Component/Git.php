<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component;

use Symfony\Component\Console\Style\SymfonyStyle;

class Git
{
    public readonly bool $isAvailable;

    public function __construct(protected string $path)
    {
        $this->isAvailable = Command::test('git --version');
    }

    public function setup(SymfonyStyle $io): void
    {
        if (! $this->isAvailable) {
            $io->warning('Git is not available. Skipping...');
            return;
        }

        $io->section('Setting up git');

        $io->info('Creating repository');
        $this->init();

        $io->info('Adding files');
        $this->addAll();

        if ($io->confirm('Create commit?', true)) {
            $message = $io->ask('Commit message', 'Initial commit');
            $this->commit($message);
        }
    }

    public function init(): static
    {
        exec("git -C \"{$this->path}\" init");

        return $this;
    }

    public function addAll(): static
    {
        exec("git -C \"{$this->path}\" add -A");

        return $this;
    }

    public function commit(string $message): static
    {
        exec("git -C \"{$this->path}\" commit -m '{$message}'");

        return $this;
    }
}
