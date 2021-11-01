<?php

namespace Gendiff\GetContent;

use function Gendiff\Parser\parseData;

function extractData(string $pathToFile): array
{
    $content = getContent($pathToFile);
    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);
    return parseData($content, $extension);
}

function getContent(string $pathToFile): string
{
    if (!file_exists($pathToFile)) {
        throw new \Exception("File $pathToFile not found");
    }

    $content = file_get_contents($pathToFile);
    if ($content === false) {
        throw new \Exception("Can't read file $pathToFile");
    }

    return $content;
}
