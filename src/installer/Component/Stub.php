<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component;

use Phetit\PackageSkeleton\Component\FileSystem\File;

class Stub
{
    protected array $replacements = [];

    protected string $content;

    public function __construct(protected File $source, protected string $destination)
    {
        $this->content = $source->getContent();
    }

    public function generate(): void
    {
        if ($this->isStub()) {
            $this->process();
        }

        $this->save();
    }

    public function isStub(): bool
    {
        return $this->source->getExtension() === 'stub';
    }

    /**
     * @param array<string,string> $replacements
     */
    public function with(array $replacements): Stub
    {
        $this->replacements = $replacements;

        return $this;
    }

    public function getFileName(): string
    {
        return "{$this->destination}/{$this->getSourceName()}";
    }

    protected function getSourceName(): string
    {
        if ($this->isStub()) {
            return $this->source->getName();
        }

        return $this->source->getBaseName();
    }

    protected function save(): void
    {
        $file = fopen($this->getFileName(), 'w');
        fwrite($file, $this->content);
        fclose($file);
    }

    protected function process(): void
    {
        $this->content = strtr($this->content, $this->replacements);
    }
}
