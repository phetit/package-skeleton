<?php

require __DIR__ . '/functions.php';

define('BASE_PATH', dirname(__DIR__));
define('STUBS_PATH', __DIR__ . '/stubs');

info('Welcome to Phetit Template setup');
msg(PHP_EOL);

// $author = readline("Author: ");

write('Generating project files...', 'bold_cyan');
installStubs(STUBS_PATH, BASE_PATH);

write('Removing installation files...', 'bold_cyan');
removeDirRecursive(__DIR__);

write('Removing git repository files...', 'bold_cyan');
removeDirRecursive(BASE_PATH . '/.git');

// $workDir = '"' . BASE_PATH . '"';

create_git_repository(BASE_PATH);
// composer_install(BASE_PATH);
