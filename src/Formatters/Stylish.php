<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Formatters\Stylish;

use function Ilyamur\DifferenceAnalyzer\Tree\getType;
use function Ilyamur\DifferenceAnalyzer\Tree\getName;
use function Ilyamur\DifferenceAnalyzer\Tree\getOldValue;
use function Ilyamur\DifferenceAnalyzer\Tree\getNewValue;
use function Ilyamur\DifferenceAnalyzer\Tree\getChildren;
use function Ilyamur\DifferenceAnalyzer\Preparation\boolToString;
use function Funct\Collection\flattenAll;

function iter(array $tree, string $space): array
{
    $addedSpace = '    ';
    $result = array_reduce($tree, function (array $res, array $node) use ($space, $addedSpace) {
        $type = getType($node);
        $name = getName($node);
        switch ($type) {
            case 'added':
                $newValue = getNewValue($node);
                $res[] = $space . "  + {$name}: " . prepareValue($newValue, $space . $addedSpace);
                break;
            case 'removed':
                $oldValue = getOldValue($node);
                $res[] = $space . "  - {$name}: " . prepareValue($oldValue, $space . $addedSpace);
                break;
            case 'notChanged':
                $newValue = getNewValue($node);
                $res[] = $space . "    {$name}: " . prepareValue($newValue, $space . $addedSpace);
                break;
            case 'updated':
                $oldValue = getOldValue($node);
                $newValue = getNewValue($node);
                $res[] = $space . "  - {$name}: " . prepareValue($oldValue, $space . $addedSpace);
                $res[] = $space . "  + {$name}: " . prepareValue($newValue, $space . $addedSpace);
                break;
            case 'nested':
                $children = getChildren($node);
                $res[] = $space . "    {$name}: {";
                $res[] = iter($children, $space . $addedSpace);
                $res[] = $space . '    }';
        };
        return $res;
    }, []);
    return flattenAll($result);
}

function stylish(array $tree): string
{
    $res = implode("\n", iter($tree, ''));
    return "{\n" . $res . "\n}\n";
}

function prepareValue(mixed $value, string $space = ''): int|string
{
    if (!is_object($value)) {
        return boolToString($value);
    }
    $arr = (array) ($value);
    $res = implode('', array_map(function ($key, $value) use ($space) {
        return "\n" . $space . "    {$key}: " . prepareValue($value, $space . '    ');
    }, array_keys($arr), $arr));
    return '{' . $res . "\n" . $space . '}';
}
