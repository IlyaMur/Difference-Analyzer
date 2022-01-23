<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Formatters\Json;

/**
 * JSON
 *
 * Preparing difference result as JSON
 *
 */


/**
 * Encoding the difference to JSON format
 *
 * @return string
 */
function json(array $tree): string
{
    return json_encode($tree, JSON_PRETTY_PRINT);
}
