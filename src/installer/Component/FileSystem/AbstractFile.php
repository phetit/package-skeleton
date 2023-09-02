<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component\FileSystem;

abstract class AbstractFile
{
    public readonly string $basename;

    public readonly string $filename;

    public readonly string $extension;

    public function __construct(protected string $path)
    {
    }

    abstract public function remove(): bool;
    abstract public function isFile(): bool;
    abstract public function isDirectory(): bool;

    public function rename(string $newPath): bool
    {
        return rename($this->getPath(), $newPath);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getBaseName(): string
    {
        return $this->basename ??= FileSystem::getFileBaseName($this->getPath());
    }

    public function getName(): string
    {
        return $this->filename ??= FileSystem::getFileName($this->getPath());
    }

    public function getExtension(): string
    {
        return $this->extension ??= FileSystem::getFileExtension($this->getPath());
    }

    public function __toString(): string
    {
        return $this->getPath();
    }
}
