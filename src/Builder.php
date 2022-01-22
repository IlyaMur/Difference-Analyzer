<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Builder;

use function Ilyamur\DifferenceAnalyzer\Tree\makeNode;
use function Ilyamur\DifferenceAnalyzer\Tree\makeNestedNode;

function diffAsTree(\stdClass $data1, \stdClass $data2): array
{
    $data1 = (array) $data1;
    $data2 = (array) $data2;

    $keys = array_keys(array_merge($data1, $data2));

    sort($keys);

    return array_map(function (string $key) use ($data1, $data2) {
        if (!array_key_exists($key, $data1)) {
            return makeNode($key, 'added', null, $data2[$key]);
        };
        if (!array_key_exists($key, $data2)) {
            return makeNode($key, 'removed', $data1[$key], null);
        };
        if (is_object($data1[$key]) && (is_object($data2[$key]))) {
            return makeNestedNode($key, 'nested', diffAsTree($data1[$key], $data2[$key]));
        };
        if ($data1[$key] !== $data2[$key]) {
            return makeNode($key, 'updated', $data1[$key], $data2[$key]);
        };
        return makeNode($key, 'notChanged', $data1[$key], $data2[$key]);
    }, $keys);
}
