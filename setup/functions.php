<?php

function swrite(string $message, string $color): string
{
    $foreground = match ($color) {
         'black' => '0;30',
         'dark_gray' => '1;30',
         'red' => '0;31',
         'bold_red' => '1;31',
         'green' => '0;32',
         'bold_green' => '1;32',
         'brown' => '0;33',
         'yellow' => '1;33',
         'blue' => '0;34',
         'bold_blue' => '1;34',
         'purple' => '0;35',
         'bold_purple' => '1;35',
         'cyan' => '0;36',
         'bold_cyan' => '1;36',
         'white' => '1;37',
         'bold_gray' => '0;37',
         default => '0'
    };

    return "\033[{$foreground}m{$message}\033[0m";
}

function write(string $message, string $color): void
{
    echo swrite($message, $color) . PHP_EOL;
}

function msg(string $message): void
{
    write($message, 'green');
}

function info(string $message): void
{
    write($message, 'blue');
}

function warning(string $message): void
{
    write($message, 'yellow');
}

function error(string $message): void
{
    write($message, 'red');
}

function getDirectoryFiles(string $path): array
{
    return array_diff(scandir($path), ['.', '..']);
}

function removeDirRecursive(string $path): bool
{
    foreach (getDirectoryFiles($path) as $filename) {
        $filepath = "{$path}/{$filename}";

        if (is_file($filepath)) {
            unlink($filepath);
            continue;
        }

        removeDirRecursive($filepath);
    }

    return rmdir($path);
}

function processStub(string $source, string $destination): void
{
    $file = fopen($destination, 'w');
    fwrite($file, file_get_contents($source));
    fclose($file);
}

function installStubs(string $source, string $destination): void
{
    foreach (getDirectoryFiles($source) as $filename) {
        $srcPath = "{$source}/{$filename}";
        $dstPath = "{$destination}/{$filename}";

        if (is_dir($srcPath)) {
            mkdir($dstPath);
            installStubs($srcPath, $dstPath);
            continue;
        }

        if (pathinfo($filename, PATHINFO_EXTENSION) !== 'stub') {
            rename($srcPath, $dstPath);
            continue;
        }

        $originalName = pathinfo($filename, PATHINFO_FILENAME);

        processStub($srcPath, "{$destination}/{$originalName}");
    }
}

function test_command(string $command): bool
{
    $status = null;

    try {
        exec("{$command} 2>&1", $output, result_code: $status);
    } catch (\Throwable) {
    }

    return $status === 0;
}

function create_git_repository(string $workDir): void
{
    if (test_command('git --version')) {
        write('Creating git repository...', 'bold_cyan');

        exec("git -C \"{$workDir}\" init");
        exec("git -C \"{$workDir}\" add -A");
        exec("git -C \"{$workDir}\" commit -m 'Initial commit'");
    }
}

function composer_install(string $workDir): void
{
    write('Installing dependencies...', 'bold_cyan');
    exec("composer -d \"{$workDir}\" install");
}
