<?php

namespace Gendiff\Parser;

function parseData(string $content, string $format): array
{
    switch ($format) {
        case 'json':
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            break;
        default:
            throw new \Exception("Unknown format: $format");
            break;
    }
}
