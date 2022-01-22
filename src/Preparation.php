<?php

namespace  Ilyamur\DifferenceAnalyzer\Preparation;

function boolToString($value)
{
    if (is_bool($value)) {
        if ($value === true) {
            return 'true';
        }
        return 'false';
    }
    return $value;
}
