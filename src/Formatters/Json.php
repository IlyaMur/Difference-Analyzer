<?php

namespace  Differ\Formatters\Json;

function json($tree)
{
    return json_encode($tree, JSON_PRETTY_PRINT);
}
