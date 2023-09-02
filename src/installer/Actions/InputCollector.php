<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Actions;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

use function Symfony\Component\String\u;

class InputCollector
{
    protected const PHP_VERSIONS = ['8.1', '8.2'];

    protected array $packageInfo = [
        'vendor' => '',
        'package' => '',
        'namespace' => '',
        'composer.package' => '',
        'description' => '',
        'author' => '',
        'email' => '',
        'copyright' => '',
        'php' => '8.1',
    ];

    public function __construct(protected SymfonyStyle $io)
    {
    }

    public function run(): array
    {
        $this->requestAll();

        return $this->packageInfo;
    }

    protected function requestAll(): void
    {
        $this->requestVendor();
        $this->requestPackageName();
        $this->requestNamespace();
        $this->requestComposerPackageName();
        $this->requestComposerDescription();
        $this->requestAuthorName();
        $this->requestAuthorEmail();
        $this->requestCopyright();
        $this->requestPHPVersion();
    }

    protected function requestVendor(): void
    {
        $this->packageInfo['vendor'] = $this->io->ask(
            'Vendor name (example: MyVendor)',
            validator: Validation::createCallable(new NotBlank(), new Regex([
                'pattern' => '/^([A-Z][a-zA-Z]*)+$/',
                'message' => 'Vendor name should be PascalCase without spaces',
            ])),
        );
    }

    protected function requestPackageName(): void
    {
        $this->packageInfo['package'] = $this->io->ask(
            'Package name (example: My Awesome Package)',
            validator: Validation::createCallable(new NotBlank(), new Regex([
                'pattern' => '/^[a-zA-Z0-9]([\w -]*[a-zA-Z0-9])*$/',
                'message' => 'Package name should contain only letters, numbers, hyphen, underscore and spaces',
            ])),
        );

        $vendor = u($this->packageInfo['vendor']);
        $package = u($this->packageInfo['package']);

        $this->packageInfo['namespace'] = "{$vendor}\\{$package->camel()->title()}";
        $this->packageInfo['composer.package'] = "{$vendor->lower()}/{$package->snake()->replace('_', '-')}";
        $this->packageInfo['description'] = "Description for {$vendor} {$package}.";
    }

    protected function requestNamespace(): void
    {
        $this->packageInfo['namespace'] = $this->io->ask(
            'Package namespace (pointing to "src/")',
            $this->packageInfo['namespace'],
            Validation::createCallable(new Regex([
                'pattern' => '/^[A-Z][a-zA-Z0-9_]*(\\\\[A-Z][a-zA-Z0-9_]*)*$/',
                'message' => "Package's namespace should be of type \"{$this->packageInfo['namespace']}\"",
            ])),
        );
    }

    protected function requestComposerPackageName(): void
    {
        $this->packageInfo['composer.package'] = $this->io->ask(
            'Composer package name',
            $this->packageInfo['composer.package'],
            Validation::createCallable(new Regex([
                'pattern' => '/^[a-z0-9](-?[a-z0-9]+)*\/[a-z0-9](-?[a-z0-9]+)*$/',
                'message' => "Packages's name should be of type \"{$this->packageInfo['composer.package']}\"",
            ])),
        );
    }

    protected function requestComposerDescription(): void
    {
        $this->packageInfo['description'] = $this->io->ask(
            'Package description',
            $this->packageInfo['description'],
        );
    }

    protected function requestAuthorName(): void
    {
        $this->packageInfo['author'] = $this->io->ask(
            'Author\'s name',
            $this->packageInfo['vendor']
        );
    }

    protected function requestAuthorEmail(): void
    {
        $this->packageInfo['email'] = $this->io->ask(
            'Author\'s email',
            validator: Validation::createCallable(new Email(), new NotBlank()),
        );
    }

    protected function requestCopyright(): void
    {
        $this->packageInfo['copyright'] = $this->io->ask(
            'Copyright',
            $this->packageInfo['author']
        );
    }

    protected function requestPHPVersion(): void
    {
        $this->packageInfo['php'] = $this->io->choice(
            'PHP version',
            static::PHP_VERSIONS,
            $this->packageInfo['php']
        );
    }
}
