<?php

namespace Railken\Advent2020\Tests;

class Day1CommandTest extends BaseTest
{
    public function testDay1PuzzleA()
    {
        $this->assertEquals('1007331', $this->commonDay('day1:puzzleA', __DIR__.'/input.txt')); // ~ 0.00202346s
    }

    public function testDay1PuzzleB()
    {
        $this->assertEquals('48914340', $this->commonDay('day1:puzzleB', __DIR__.'/input.txt')); // ~0.01146319s
    }
}
