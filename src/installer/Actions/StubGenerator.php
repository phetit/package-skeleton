<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Actions;

use Phetit\PackageSkeleton\Component\FileSystem\Directory;
use Phetit\PackageSkeleton\Component\FileSystem\FileSystem;
use Phetit\PackageSkeleton\Component\Stub;
use Symfony\Component\Console\Style\SymfonyStyle;

class StubGenerator
{
    protected array $replacements = [];

    protected array $formattedReplacements = [];

    public function __construct(protected string $path, protected SymfonyStyle $io)
    {
    }

    /**
     * @param array<string,string> $replacements
     */
    public function with(array $replacements): StubGenerator
    {
        $this->replacements = $replacements;
        $this->formattedReplacements = $this->formatReplacements();

        return $this;
    }

    public function generate(string $destination): void
    {
        $this->generateRecursively(new Directory($this->path), $destination);
    }

    protected function generateRecursively(Directory $directory, string $destination): void
    {
        FileSystem::mkdir($destination);

        foreach ($directory as $file) {
            if ($file->isDirectory()) {
                $this->generateRecursively($file, "{$destination}/{$file->getBaseName()}");
                continue;
            }

            $stub = new Stub($file, $destination);
            $this->io->writeln("Generating \"{$stub->getFileName()}\"");

            $stub->with($this->formattedReplacements)->generate();
        }
    }

    /**
     * @return array<string,string>
     */
    protected function formatReplacements(): array
    {
        return array_combine(
            array_map(fn($key) => "{{ $key }}", array_keys($this->replacements)),
            array_values($this->replacements),
        );
    }
}
