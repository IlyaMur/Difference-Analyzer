<?php

namespace Gendiff\NodeGenerator;

function genNode(string $key, string $diffType, $value1, $value2, ?array $children = null)
{
    return [
        'key' => $key,
        'diffType' => $diffType,
        'value1' => $value1,
        'value2' => $value2,
        'children' => $children,
    ];
}
