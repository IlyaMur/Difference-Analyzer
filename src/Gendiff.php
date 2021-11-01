<?php

namespace Gendiff\Gendiff;

use function Gendiff\Parser\parseData;
use function Gendiff\NodeGenerator\genNode;

function genDiff(string $pathToFile1, string $pathToFile2, string $format = 'json'): string
{
    $content1 = getContent($pathToFile1);
    $extension1 = pathinfo($pathToFile1, PATHINFO_EXTENSION);
    $fileData1 = parseData($content1, $extension1);

    $content2 = getContent($pathToFile2);
    $extension2 = pathinfo($pathToFile2, PATHINFO_EXTENSION);
    $fileData2 = parseData($content2, $extension2);

    $diffTree = getDiffTree($fileData1, $fileData2);
    // $render = render($format);

    return json_encode($diffTree, JSON_PRETTY_PRINT);
    // return $diffTree;
}

function getContent(string $pathToFile): string
{
    if (!file_exists($pathToFile)) {
        throw new \Exception("File $pathToFile not found");
    }

    $content = file_get_contents($pathToFile);
    if ($content === false) {
        throw new \Exception("Can't read file $pathToFile");
    }

    return $content;
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
