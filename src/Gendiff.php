<?php

namespace Gendiff\Gendiff;

const ADDED = 'added';
const REMOVED = 'removed';
const CHANGED = 'changed';
const NOTCHANGED = 'notchanged';
const NESTED = 'nested';

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $content1 = getContent($pathToFile1);
    $fileData1 = json_decode($content1, true, 512, JSON_THROW_ON_ERROR);

    $content2 = getContent($pathToFile2);
    $fileData2 = json_decode($content2, true, 512, JSON_THROW_ON_ERROR);

    $diffTree = getDiffTree($fileData1, $fileData2);
    return render($diffTree);
}

function render(array $diffTree): string
{
    return json_encode($diffTree, JSON_PRETTY_PRINT);
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
                $diffType = ADDED;
                $value1 = null;
                $value2 = $data2[$key];
                return getNode($key, $diffType, $value1, $value2);
            }

            if (!array_key_exists($key, $data2)) {
                $diffType = REMOVED;
                $value1 = $data1[$key];
                $value2 = null;
                return getNode($key, $diffType, $value1, $value2);
            }

            $value1 = $data1[$key];
            $value2 = $data2[$key];
            if (is_array($value1) && is_array($value2)) {
                $diffType = NESTED;
                $children = getDiffTree($value1, $value2);
                return getNode($key, $diffType, $value1, $value2, $children);
            }

            $diffType = ($value1 === $value2) ? NOTCHANGED : CHANGED;
            return getNode($key, $diffType, $value1, $value2);
        },
        $unionKeys
    );
}

function getNode(string $key, string $diffType, $value1, $value2, ?array $children = null)
{
    return [
        'key' => $key,
        'diffType' => $diffType,
        'value1' => $value1,
        'value2' => $value2,
        'children' => $children,
    ];
}
