<?php

namespace Railken\Advent2020\Tests;

class Day3CommandTest extends BaseTest
{
    public function testDay3PuzzleA()
    {
        $this->assertEquals('205', $this->commonDay('day3:puzzleA', __DIR__.'/input.txt')); // ~ 0.00150385s
    }

    public function testDay3PuzzleB()
    {
        $this->assertEquals('3952146825', $this->commonDay('day3:puzzleB', __DIR__.'/input.txt')); // ~0.00479009s
    }
}
