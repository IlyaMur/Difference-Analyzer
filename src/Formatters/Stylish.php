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

/**
 * Stylish
 *
 * Preparing final result in 'stylish' format (default)
 *
 */

/**
 * Iterating provided array and formating text output depending on file difference
 *
 * @param array $tree Tree
 * @param string $space String for spacing
 *
 * @return array
 */
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

/**
 * Preparing stylish output
 *
 * @param array $tree Tree
 *
 * @return string
 */
function stylish(array $tree): string
{
    $res = implode("\n", iter($tree, ''));
    return "{\n" . $res . "\n}\n";
}

/**
 * Convert tree objects to the string
 *
 * @param mixed $value Tree's object
 * @param string $space String for spacing
 *
 * @return int|string
 */
function prepareValue(mixed $value, string $space = ''): int|string
{
    // Cast boolean to a string
    if (!is_object($value)) {
        return boolToString($value);
    }

    // Cast stdClass to an associative array
    $arr = (array) ($value);

    // Recursing and preparing output
    $preparedOutput = array_map(
        function ($key, $value) use ($space) {
            return "\n" . $space . "    {$key}: " . prepareValue($value, $space . '    ');
        },
        array_keys($arr),
        $arr
    );

    $res = implode('', $preparedOutput);

    return '{' . $res . "\n" . $space . '}';
}
