<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer;

use function Ilyamur\DifferenceAnalyzer\Parsers\parse;
use function Ilyamur\DifferenceAnalyzer\Builder\diffAsTree;
use function Ilyamur\DifferenceAnalyzer\Formatters\{Stylish\stylish, Plain\plain, Json\json};

/**
 * Differ
 *
 * Checking input args and deciding what type of output user needed
 *
 */

/**
 * Selecting a format handler depending on a format
 *
 * @param string $pathToFile1 Data from first file
 * @param string $pathToFile2 Data from second file
 * @param string $format Output format (optional)
 *
 * @return string
 */
function genDiff(string $pathToFile1, string $pathToFile2, string $format = 'stylish'): string
{
    $data1 = getData($pathToFile1);
    $data2 = getData($pathToFile2);

    // Array with callbacks for each type of output
    $mapping = [
        'stylish' =>
        fn ($tree) => stylish($tree),
        'plain' =>
        fn ($tree) => plain($tree),
        'json' =>
        fn ($tree) => json($tree),
    ];

    // Selecting a handler depending on a format
    return $mapping[$format](diffAsTree($data1, $data2));
}

/**
 * Get a data from a file
 *
 * @param string $pathToFile Path to a file
 *
 * @return \stdClass
 */
function getData(string $pathToFile): \stdClass
{
    $type = pathinfo($pathToFile, PATHINFO_EXTENSION);
    $rawData = file_get_contents($pathToFile);

    return parse($rawData, $type);
}
