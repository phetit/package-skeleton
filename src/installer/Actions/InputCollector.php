<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Actions;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

use function Symfony\Component\String\u;

class InputCollector
{
    protected array $input = [
        'vendor' => 'Phetit',
        'package' => '',
        'namespace' => '',
        'composer.package' => '',
        'author.name' => '',
        'author.email' => '',
        'php' => '8.1',
    ];

    public function __construct(protected SymfonyStyle $io)
    {
        $this->io->section('Package info');
    }

    protected function requestVendor(): void
    {
        $validator = Validation::createCallable(new Regex([
            'pattern' => '/^([A-Z][a-zA-Z]*)+$/',
            'message' => 'Vendor name should be PascalCase without spaces',
        ]));

        $this->input['vendor'] = $this->io->ask('Provide the vendor name', $this->input['vendor'], $validator);
    }

    protected function requestPackage(): void
    {
        $validator = Validation::createCallable(new NotBlank(), new Regex([
            'pattern' => '/^[a-zA-Z0-9]([\w -]*[a-zA-Z0-9])*$/',
            'message' => 'Package name should contain only letters, numbers, hyphen, underscore and spaces',
        ]));

        $this->input['package'] = $this->io->ask(
            'Provide the package name (example: My Awesome Package)',
            validator: $validator,
        );

        $vendor = u($this->input['vendor']);
        $package = u($this->input['package']);

        $this->input['namespace'] = "{$vendor}\\{$package->camel()->title()}";
        $this->input['composer.package'] = "{$vendor->lower()}/{$package->snake()->replace('_', '-')}";
    }

    public function run(): void
    {
        $this->requestVendor();
        $this->requestPackage();
    }

    public function getInput(): array
    {
        return $this->input;
    }
}
