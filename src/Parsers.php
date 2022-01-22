<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $rawData, string $type): \stdClass
{
    $mapping = [
        'yml' =>
        fn ($rawData) => Yaml::parse($rawData, Yaml::PARSE_OBJECT_FOR_MAP),
        'json' =>
        fn ($rawData) => json_decode($rawData),
    ];
    return $mapping[$type]($rawData);
}
