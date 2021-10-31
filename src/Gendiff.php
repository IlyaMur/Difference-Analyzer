<?php

namespace Gendiff\Gendiff;

function parse($path)
{
    if (!file_exists($path)) {
        throw new \Exception("Invalid file path: {$path}");
    }

    $content = file_get_contents($path);

    if ($content === false) {
        throw new \Exception("Can't read file: {$path}");
    }

    return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
}

function buildNode($typeNode, $key, $oldValue, $newValue, $children = null)
{
    $node = [
        'typeNode' => $typeNode,
        'key' => $key,
        'oldValue' => $oldValue,
        'newValue' => $newValue,
        'children' => $children
    ];
    return $node;
}

function genDiff(string $firstFilePath, string $secondFilePath, $format = "stylish")
{
    $firstArray = parse($firstFilePath);
    $secondArray = parse($secondFilePath);
    $diff = makeDiff($firstArray, $secondArray);
    print_r($diff);
}

function makeDiff(array $before, array $after)
{
    $unionKeys = array_unique(array_merge(array_keys($before), array_keys($after)));
    sort($unionKeys);

    return array_map(
        function ($key) use ($before, $after) {
            if (array_key_exists($key, $before) && array_key_exists($key, $after)) {
                if (is_array($before[$key]) && is_array($after[$key])) {
                    $node =  buildNode('nested', $key, null, null, makeDiff($before[$key], $after[$key]));
                } elseif ($before[$key] === $after[$key]) {
                    $node = buildNode("unchanged", $key, $before[$key], $after[$key]);
                } else {
                    $node = buildNode("changed", $key, $before[$key], $after[$key]);
                }
            }
            if (array_key_exists($key, $before) && !array_key_exists($key, $after)) {
                $node = buildNode("removed", $key, $before[$key], null);
            }
            if (!array_key_exists($key, $before) && array_key_exists($key, $after)) {
                $node = buildNode("added", $key, null, $after[$key]);
            }
            return $node;
        }, $unionKeys
    );
}
