<?php

declare(strict_types=1);

namespace  Ilyamur\DifferenceAnalyzer\Preparation;

/**
 * Preparation
 *
 * Helpers for the main functionality
 *
 */

/**
 * Checking a data and casting provided boolean to a string
 *
 * @param mixed $value Input data
 *
 * @return mixed
 */
function boolToString(mixed $value): mixed
{
    if (is_bool($value)) {
        return $value === true ? 'true' : 'false';
    }

    return $value;
}
