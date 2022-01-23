# Difference Analyzer

![CodeSniffer PSR-12](https://github.com/IlyaMur/php-project-lvl2/workflows/CodeSniffer-PSR-12/badge.svg) 
![PHPUnit-Tests](https://github.com/IlyaMur/php-project-lvl2/workflows/PHPUnit-Tests/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/maintainability)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/test_coverage)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/test_coverage) 

**[🇬🇧 English readme](https://github.com/IlyaMur/difference_analyzer/blob/master/README_en.md)**

**Содержание**
  - [О приложении](#о-приложении)
    - [Особенности](#особенности)
  - [Установка](#установка)
    - [Использованные библиотеки](#использованные-библиотеки)
  - [Как использовать](#как-использовать)
  - [Пример работы](#пример-работы)

### О приложении
CLI-утилита для проверки разницы между двумя конфигурационными файлами.  
Поддерживаются различные форматы вывода (stylish, json, plain text).  
Приложение написано на PHP.

#### Особенности

```
Поддерживаемые форматы: json, yaml
Форматы отчётов: json, plain, stylish
```
### Установка

- PHP >= 7.0
- Composer

Для установки зависимостей:  

    $ make install  

Для проверки линтером:  

    $ make lint 

Вывод тестов с покрытием:  

    $ make test-coverage

#### Использованные библиотеки

- docopt/docopt
- symfony/yaml
- funct/funct

### Как использовать

Для генерации отчета по различиям:  

    $ ./gendiff [--format <fmt>] <pathToFile1> <pathTofile2>

Вывод помощи:

    $ gendiff -h
    $ gendiff --help

### Пример работы

Сравнение двух json-файлов и вывод разницы в форматах: stylish, plain и json.

[![asciicast](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd.svg)](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd)

Сравнение двух yaml/yml-файлов и вывод разницы в форматах: stylish, plain и json.

[![asciicast](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE.svg)](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE)

