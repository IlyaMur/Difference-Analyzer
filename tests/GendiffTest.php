<?php

namespace Gendiff\Tests;

use PHPUnit\Framework\TestCase;

use function Gendiff\Gendiff\genDiff;
use function Gendiff\Gendiff\makeDiff;

class GendiffTest extends TestCase
{
    /**
     * @dataProvider fixturesFilenames
     */
    public function testMakeDiff(string $file1name, string $file2name, string $resultName): void
    {
        $file1path = $this->getFixturePath($file1name);
        $file2path = $this->getFixturePath($file2name);
        $resultPath = $this->getFixturePath($resultName);

        $result = genDiff($file1path, $file2path);
        $expected = trim(file_get_contents($resultPath));
        // echo '123';
        // var_dump($expected);

        $this->assertEquals($result, $expected);
    }

    public function getFixturePath($fileName): string
    {
        return __DIR__ . "/fixtures/$fileName";
    }

    public function fixturesFilenames()
    {
        return [
            ['1.json', '2.json', 'result.json'],
        ];
    }
}