[![Maintainability](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/maintainability)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/test_coverage)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/test_coverage) ![CodeSniffer-Linter](https://github.com/IlyaMur/php-project-lvl2/workflows/CodeSniffer-Linter/badge.svg) ![PHPUnit-tests](https://github.com/IlyaMur/php-project-lvl2/workflows/PHPUnit-tests/badge.svg)

#### О приложении

Утилита командной строки для поиска отличий в конфигурационных файлах.
Выполнена на PHP 8.0

Возможности утилиты:

```
Поддержка разных форматов: json, yaml
Генерация отчетов json, plain, stylish
```

## Пример использования:

    $ gendiff [--format <fmt>] <pathToFile1> <pathTofile2>

Вызов справки:

    $ gendiff -h
    $ gendiff --help

#### Установка

Для установки зависимостей:  
`$ make install`  
Проверка линтером:  
`$ make install`  
Проверка запуск тестов с выводом покрытия:  
`$ make test`

#### Для разработки

- PHP >=7.0
- Composer

#### Использованные библиотеки:

- docopt/docopt
- symfony/yaml
- funct/funct

### Как работает пакет

#### Сравнение файлов json и yaml/yml в формате по умолчанию stylish

[![asciicast](https://asciinema.org/a/394025.svg)](https://asciinema.org/a/394025)

#### Сравнение файлов json/yaml в формате plain

[![asciicast](https://asciinema.org/a/392103.svg)](https://asciinema.org/a/392103)

#### Сравнение файлов json/yaml в формате json

[![asciicast](https://asciinema.org/a/392109.svg)](https://asciinema.org/a/392109)
