<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Tree;

/**
 * Tree
 *
 * Nodes formatting
 *
 */

/**
 * Creating a node
 *
 * @param string $name Name
 * @param string $type Data type
 * @param mixed $oldValue Old value
 * @param mixed $newValue New value
 *
 * @return mixed
 */
function makeNode(string $name, string $type, mixed $oldValue, mixed $newValue)
{
    return [
        "name" => $name,
        "type" => $type,
        "oldValue" => $oldValue,
        "newValue" => $newValue
    ];
}

/**
 * Creating a nested node
 *
 * @param string $name Name
 * @param string $type Data type
 * @param array $children Nested node
 *
 * @return array
 */
function makeNestedNode(string $name, string $type, array $children): array
{
    return [
        "name" => $name,
        "type" => $type,
        "children" => $children
    ];
}

/**
 * Get a node's name
 *
 * @param array $node Node
 *
 * @return string
 */
function getName(array $node): string
{
    return $node['name'];
}

/**
 * Get a node's type
 *
 * @param array $node Type
 *
 * @return string
 */
function getType(array $node): string
{
    return $node['type'];
}

/**
 * Get a node's old value
 *
 * @param array $node Node
 *
 * @return mixed
 */
function getOldValue(array $node): mixed
{
    return $node['oldValue'];
}

/**
 * Get a node's new value
 *
 * @param array $node Node
 *
 * @return mixed
 */
function getNewValue(array $node): mixed
{
    return $node['newValue'];
}

/**
 * Get a node's children
 *
 * @param array $node Node
 *
 * @return array
 */
function getChildren($node): array
{
    return $node['children'];
}
