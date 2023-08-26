<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton;

use Phetit\PackageSkeleton\Actions\InputCollector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'install',
    description: 'Install package',
)]
class DefaultCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        $io->title($this->getApplication()->getName());

        $collector = new InputCollector($io);
        $collector->run();

        $packageInfo = $collector->getInput();

        $io->definitionList(
            'Package info',
            new TableSeparator(),
            ...array_map(function ($index, $value) {
                return [$index => $value];
            }, array_keys($packageInfo), array_values($packageInfo)),
        );

        return Command::SUCCESS;
    }
}
