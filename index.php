<?php

use Phetit\PackageSkeleton\DefaultCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$app = new Application('Phetit Package Skeleton Installer', '1.0.0');
$command = new DefaultCommand();

$app->add($command);
$app->setDefaultCommand($command->getName(), true);

$app->run();
