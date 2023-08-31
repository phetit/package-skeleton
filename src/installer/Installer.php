<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton;

use Composer\Script\Event;
use Phetit\PackageSkeleton\Actions\InputCollector;
use Phetit\PackageSkeleton\Actions\StubGenerator;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class Installer
{
    public function __construct(protected string $name, protected string $version)
    {
    }

    public function run(): void
    {
        $io = new SymfonyStyle(new ArgvInput(), new ConsoleOutput());

        $io->title("{$this->name}: {$this->version}");

        $io->section('Configurations');
        $packageInfo = (new InputCollector($io))->run();

        $io->definitionList(
            'Configurations',
            new TableSeparator(),
            ...array_map(function ($index, $value) {
                return [$index => $value];
            }, array_keys($packageInfo), array_values($packageInfo)),
        );

        $io->section('Generating stubs');
        $stubs = new StubGenerator('stubs', $io);
        $stubs->with($packageInfo)->generate('.');
    }
}
