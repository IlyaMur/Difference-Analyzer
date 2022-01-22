<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Formatters\Json;

function json(array $tree): string
{
    return json_encode($tree, JSON_PRETTY_PRINT);
}
