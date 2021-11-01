<?php

namespace Gendiff\Tests;

use PHPUnit\Framework\TestCase;

use function Gendiff\Gendiff\genDiff;

class GendiffTest extends TestCase
{
    /**
     * @dataProvider fixturesFilenames
     */
    public function testGenDiff(string $file1name, string $file2name, string $resultName): void
    {
        $file1path = $this->getFixturePath($file1name);
        $file2path = $this->getFixturePath($file2name);
        $resultPath = $this->getFixturePath($resultName);

        $result = genDiff($file1path, $file2path);
        $expected = trim(file_get_contents($resultPath));

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
            ['1.yml', '2.yml', 'result.json'],
        ];
    }
}
