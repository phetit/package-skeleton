<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton;

use Composer\Script\Event;
use Phetit\PackageSkeleton\Actions\InputCollector;
use Phetit\PackageSkeleton\Actions\StubGenerator;
use Phetit\PackageSkeleton\Component\Composer;
use Phetit\PackageSkeleton\Component\FileSystem\FileSystem;
use Phetit\PackageSkeleton\Component\Git;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class Installer
{
    protected SymfonyStyle $io;

    protected string $rootPath;

    protected string $installerPath;

    protected string $stubsPath;

    public function __construct(protected string $name, protected string $version)
    {
        $this->io = new SymfonyStyle(new ArgvInput(), new ConsoleOutput());
        $this->rootPath = realpath('.');
        $this->installerPath = "{$this->rootPath}/src/installer";
        $this->stubsPath = "{$this->installerPath}/stubs";
    }

    public function run(): void
    {
        $this->io->title("{$this->name}: {$this->version}");

        $this->io->section('Configurations');
        $configurations = (new InputCollector($this->io))->run();

        $this->io->definitionList(
            'Configurations',
            new TableSeparator(),
            ...array_map(function ($index, $value) {
                return [$index => $value];
            }, array_keys($configurations), array_values($configurations)),
        );

        $configurations['composer.namespace'] = str_replace('\\', '\\\\', $configurations['namespace']);

        $this->io->section('Generating files');
        $stubs = new StubGenerator($this->stubsPath, $this->io);
        $stubs->with($configurations)->generate($this->rootPath);

        $this->io->section('Setting up repository');
        $git = new Git($this->rootPath);
        $composer = new Composer($this->rootPath);

        $this->io->info('Cleaning installation files');
        FileSystem::rmdir($this->installerPath);
        unlink($this->rootPath . '/setup.php');
        FileSystem::rmdir($this->rootPath . '/vendor');

        $this->io->info('Removing .git folder');
        FileSystem::rmdir($this->rootPath . '/.git');

        $this->io->info('Updating composer dependencies');
        $composer->install()->bump();

        $this->io->info('Creating git repository');

        if ($git->isAvailable) {
            $git->setup('Initial commit');
        } else {
            $this->io->warning('Git is not available. Skipping...');
        }

        $this->io->success('Process completed.');
    }
}
