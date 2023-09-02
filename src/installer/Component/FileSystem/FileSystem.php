<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component\FileSystem;

class FileSystem
{
    public static function mkdir(string $directory, int $permissions = 0777, bool $recursive = true): bool
    {
        if (is_dir($directory)) {
            return true;
        }

        if (file_exists($directory)) {
            return false;
        }

        return mkdir($directory, $permissions, $recursive);
    }

    public static function rmdir(string $directory,): bool
    {
        foreach (static::scandir($directory) as $filename) {
            $filepath = "{$directory}/{$filename}";

            if (is_file($filepath)) {
                unlink($filepath);
                continue;
            }

            static::rmdir($filepath);
        }

        return rmdir($directory);
    }

    public static function scandir(string $directory, int $sortingOrder = 0): array
    {
        return array_diff(scandir($directory, $sortingOrder), ['.', '..']);
    }

    public static function getFileExtension(string $path): string
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    public static function getFileName(string $path): string
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function getFileBaseName(string $path): string
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }

    public static function getFileContent(string $path): string
    {
        return file_get_contents($path);
    }
}
