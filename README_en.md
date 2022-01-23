# Difference Analyzer

![CodeSniffer PSR-12](https://github.com/IlyaMur/php-project-lvl2/workflows/CodeSniffer-PSR-12/badge.svg) 
![PHPUnit-Tests](https://github.com/IlyaMur/php-project-lvl2/workflows/PHPUnit-Tests/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/maintainability)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/6edf6b009909fff44632/test_coverage)](https://codeclimate.com/github/IlyaMur/php-project-lvl2/test_coverage) 

**Table of contents**
  - [Overview](#overview)
    - [Features](#features)
  - [Install](#install)
    - [Used libraries](#used-libraries)
  - [How To Use](#how-to-use)
  - [How It Works](#how-it-works)

### Overview
The CLI utility for checking the difference between two configuration files.  
Different types of output supported.  
Written in PHP.

#### Features

```
Formats support: json, yaml
Reports generation: json, plain, stylish
```
### Install

- PHP >= 7.0
- Composer

For install:  

    $ make install  

For linter checking:  

    $ make lint 

For tests with coverage:  

    $ make test-coverage

#### Used libraries
- docopt/docopt
- symfony/yaml
- funct/funct

### How To Use

For generate the difference:  

    $ gendiff [--format <fmt>] <pathToFile1> <pathTofile2>

For help:

    $ gendiff -h
    $ gendiff --help

### How It Works

Comparsion of two json files with output formats: stylish, plain и json.

[![asciicast](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd.svg)](https://asciinema.org/a/Ca2ALuRhfVDVPO2AklPH3Wuwd)

Comparsion of two yaml/yml files with output formats: stylish, plain и json.

[![asciicast](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE.svg)](https://asciinema.org/a/3hcI9bVJgJEubTg36md5AsEnE)

