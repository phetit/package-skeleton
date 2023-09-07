<?php

declare(strict_types=1);

namespace Phetit\PackageSkeleton\Component;

class Command
{
    public static function test(string $command): bool
    {
        $status = null;

        try {
            exec("{$command} 2>&1", $output, result_code: $status);
        } catch (\Throwable) {
        }

        return $status === 0;
    }
}
