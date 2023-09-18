<div align="center">

[![GitHub tag (with filter)](https://img.shields.io/github/v/tag/phetit/package-skeleton)](https://github.com/phetit/package-skeleton/releases/latest)
[![Packagist](https://img.shields.io/packagist/v/phetit/package-skeleton)](https://packagist.org/packages/phetit/package-skeleton)
[![GitHub](https://img.shields.io/github/license/phetit/package-skeleton)](https://github.com/phetit/package-skeleton/blob/main/LICENSE)

</div>

# Phetit Package Skeleton

This repository provides a skeleton to start your next PHP package.

> **Requires PHP 8.1+**

## Usage

### Installation

:package: Create a [Composer](https://getcomposer.org/) project:

```bash
composer create-project phetit/package-skeleton --keep-vcs PackageName
```

> If you want to get the last changes in the repository, add `--stability=dev` option.

After installation, follow the console instructions to set up your project.


### Composer scripts

Once the project has been set up, you can use the following composer scripts.

:art: Run code style analysis using [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer):

```bash
composer test:lint
```

:hammer_and_wrench: Run static analysis using [PHPStan](https://phpstan.org/):

```bash
composer test:types
```

:white_check_mark: Run unit tests using [PHPUnit](https://phpunit.de/):

```bash
composer test:unit
```

:rocket: Run the entire test suit

```bash
composer test
```

## License

This project is licensed under the [**MIT license**](https://opensource.org/license/mit/).

## References

- [nunomaduro/skeleton-php](https://github.com/nunomaduro/skeleton-php)
- [briandk
briandk/CONTRIBUTING.md
](https://gist.github.com/briandk/3d2e8b3ec8daf5a27a62)
- [github/docs/CONTRIBUTING.md](https://github.com/github/docs/blob/main/CONTRIBUTING.md)
- [ikatyang/emoji-cheat-sheet](https://github.com/ikatyang/emoji-cheat-sheet)
- [parmentf/GitCommitEmoji.md](https://gist.github.com/parmentf/035de27d6ed1dce0b36a)
