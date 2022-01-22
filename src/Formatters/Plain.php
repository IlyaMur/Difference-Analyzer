<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Formatters\Plain;

use stdClass;

use function Ilyamur\DifferenceAnalyzer\Tree\getType;
use function Ilyamur\DifferenceAnalyzer\Tree\getName;
use function Ilyamur\DifferenceAnalyzer\Tree\getOldValue;
use function Ilyamur\DifferenceAnalyzer\Tree\getNewValue;
use function Ilyamur\DifferenceAnalyzer\Tree\getChildren;
use function Ilyamur\DifferenceAnalyzer\Preparation\boolToString;
use function Funct\Collection\flattenAll;

function iter(array $tree, string $preName): array
{
    $result = array_reduce($tree, function (array $res, array $node) use ($preName) {
        $type = getType($node);
        $name = $preName . getName($node);
        switch ($type) {
            case 'added':
                $newValue = prepareValue(getNewValue($node));
                $res[] = "Property '{$name}' was {$type} with value: {$newValue}";
                break;
            case 'removed':
                $res[] = "Property '{$name}' was {$type}";
                break;
            case 'notChanged':
                break;
            case 'updated':
                $oldValue = prepareValue(getOldValue($node));
                $newValue = prepareValue(getNewValue($node));
                $res[] = "Property '{$name}' was {$type}. From {$oldValue} to {$newValue}";
                break;
            case 'nested':
                $children = getChildren($node);
                $res[] = iter($children, $name . '.');
        };
        return $res;
    }, []);
    return flattenAll($result);
}

function plain(array $tree): string
{
    return implode("\n", iter($tree, ''));
}

function prepareValue(mixed $value): string
{
    $preparedValue = is_string($value) ? "'{$value}'" : boolToString($value);
    $preparedValue = is_object($preparedValue) ? '[complex value]' : $preparedValue;
    return $preparedValue;
}
