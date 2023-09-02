<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component\FileSystem;

use Traversable;

/**
 * @implements \IteratorAggregate<int,AbstractFile>
 */
class Directory extends AbstractFile implements \IteratorAggregate
{
    /**
     * @var AbstractFile[]
     */
    protected ?array $files = null;

    public function __construct(protected string $path)
    {
        if (! is_dir($path)) {
            throw new \InvalidArgumentException('Argument "$path" should be a directory.');
        }
    }

    public function remove(): bool
    {
        array_map(fn(AbstractFile $file) => $file->remove(), $this->getFiles());

        return rmdir($this->getPath());
    }

    /**
     * @return AbstractFile[]
     */
    public function getFiles(): array
    {
        if (is_null($this->files)) {
            $this->files = array_map(function ($file) {
                $filePath = "{$this->getPath()}/{$file}";

                return is_file($filePath) ? new File($filePath) : new Directory($filePath);
            }, FileSystem::scandir($this->getPath()));
        }

        return $this->files;
    }

    public function isFile(): bool
    {
        return false;
    }

    public function isDirectory(): bool
    {
        return true;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->getFiles());
    }
}
