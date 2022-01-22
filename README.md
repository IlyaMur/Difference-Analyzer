[![Maintainability](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/maintainability)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/test_coverage)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/test_coverage) ![CodeSniffer-Linter](https://github.com/IlyaMur/php-project-lvl2/workflows/CodeSniffer-Linter/badge.svg) ![PHPUnit-tests](https://github.com/IlyaMur/php-project-lvl2/workflows/PHPUnit-tests/badge.svg)

## Difference Analyzer

Утилита командной строки для поиска отличий в конфигурационных файлах.

Возможности утилиты:

```
Поддержка форматов: json, yaml
Генерация отчетов json, plain, stylish
```

## Пример использования

    $ gendiff [--format <fmt>] <pathToFile1> <pathTofile2>

Вызов справки:

    $ gendiff -h
    $ gendiff --help

## Установка

Для установки зависимостей:  
`$ make install`  
Проверка линтером:  
`$ make lint`  
Запуск тестов с выводом покрытия:  
`$ make test`

#### Для разработки

- PHP >=7.0
- Composer

#### Использованные библиотеки

- docopt/docopt
- symfony/yaml
- funct/funct

## Как работает приложение

#### Сравнение файлов json в форматах stylish, plain и json.

[![asciicast](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd.svg)](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd)

#### Сравнение файлов yaml в форматах stylish, plain и json.

[![asciicast](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE.svg)](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE)

