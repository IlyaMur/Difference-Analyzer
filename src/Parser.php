<?php

namespace Gendiff\Parser;

use Symfony\Component\Yaml\Yaml;

function parseData(string $content, string $extension): array
{
    switch ($extension) {
        case 'json':
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            break;
        case 'yml':
        case 'yaml':
            return Yaml::parse($content);
            break;
        default:
            throw new \Exception("Unknown extension: $extension");
            break;
    }
}
