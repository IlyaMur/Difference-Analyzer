<?php

namespace Gendiff\Gendiff;

use function Gendiff\NodeGenerator\genNode;
use function Gendiff\GetContent\extractData;

function genDiff(string $pathToFile1, string $pathToFile2, string $format = 'json'): string
{
    $file1Data = extractData($pathToFile1);
    $file2Data = extractData($pathToFile2);

    $diffTree = getDiffTree($file1Data, $file2Data);

    return json_encode($diffTree, JSON_PRETTY_PRINT);
}

function getDiffTree(array $data1, array $data2): array
{
    $unionKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));

    return array_map(
        static function ($key) use ($data1, $data2) {
            if (!array_key_exists($key, $data1)) {
                $diffType = 'added';
                $value1 = null;
                $value2 = $data2[$key];
                return genNode($key, $diffType, $value1, $value2);
            }

            if (!array_key_exists($key, $data2)) {
                $diffType = 'removed';
                $value1 = $data1[$key];
                $value2 = null;
                return genNode($key, $diffType, $value1, $value2);
            }

            $value1 = $data1[$key];
            $value2 = $data2[$key];
            if (is_array($value1) && is_array($value2)) {
                $diffType = 'nested';
                $children = getDiffTree($value1, $value2);
                return genNode($key, $diffType, $value1, $value2, $children);
            }

            $diffType = ($value1 === $value2) ? 'notchanged' : 'changed';
            return genNode($key, $diffType, $value1, $value2);
        },
        $unionKeys
    );
}
