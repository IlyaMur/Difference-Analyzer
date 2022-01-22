<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Preparation;

function boolToString(mixed $value): mixed
{
    if (is_bool($value)) {
        return $value === true ? 'true' : 'false';
    }

    return $value;
}
