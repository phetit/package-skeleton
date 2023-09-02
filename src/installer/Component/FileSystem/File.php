<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component\FileSystem;

class File extends AbstractFile
{
    protected string $content;

    public function __construct(protected string $path)
    {
        if (! is_file($path)) {
            throw new \InvalidArgumentException('Argument "$path" should be a file.');
        }
    }

    public function remove(): bool
    {
        return unlink($this->path);
    }

    public function getContent(): string
    {
        return $this->content ??= FileSystem::getFileContent($this->getPath());
    }

    public function isFile(): bool
    {
        return true;
    }

    public function isDirectory(): bool
    {
        return false;
    }
}
