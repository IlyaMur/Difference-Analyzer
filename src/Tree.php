<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Tree;

function makeNode(string $name, string $type, $oldValue, $newValue)
{
    return [
        "name" => $name,
        "type" => $type,
        "oldValue" => $oldValue,
        "newValue" => $newValue
    ];
}

function makeNestedNode(string $name, string $type, array $children)
{
    return [
        "name" => $name,
        "type" => $type,
        "children" => $children
    ];
}

function getName(array $node): string
{
    return $node['name'];
}

function getType(array $node): string
{
    return $node['type'];
}

function getOldValue(array $node): mixed
{
    return $node['oldValue'];
}

function getNewValue(array $node): mixed
{
    return $node['newValue'];
}

function getChildren($node): array
{
    return $node['children'];
}
