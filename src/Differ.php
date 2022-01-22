<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer;

use function Ilyamur\DifferenceAnalyzer\Parsers\parse;
use function Ilyamur\DifferenceAnalyzer\Builder\diffAsTree;
use function Ilyamur\DifferenceAnalyzer\Formatters\Stylish\stylish;
use function Ilyamur\DifferenceAnalyzer\Formatters\Plain\plain;
use function Ilyamur\DifferenceAnalyzer\Formatters\Json\json;

function genDiff(string $pathToFile1, string $pathToFile2, string $format = 'stylish'): string
{
    $data1 = getData($pathToFile1);
    $data2 = getData($pathToFile2);

    $mapping = [
        'stylish' =>
        fn ($tree) => stylish($tree),
        'plain' =>
        fn ($tree) => plain($tree),
        'json' =>
        fn ($tree) => json($tree),
    ];
    return $mapping[$format](diffAsTree($data1, $data2));
}

function getData(string $pathToFile): \stdClass
{
    $type = pathinfo($pathToFile, PATHINFO_EXTENSION);
    $rawData = file_get_contents($pathToFile);
    return parse($rawData, $type);
}
