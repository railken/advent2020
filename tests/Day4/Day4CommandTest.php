<?php

namespace Railken\Advent2020\Tests;

class Day4CommandTest extends BaseTest
{
    public function testDay4PuzzleA()
    {
        $this->assertEquals('200', $this->commonDay('day4:puzzleA', __DIR__.'/input.txt')); // ~ 0.00150385s
    }

    public function testDay4PuzzleB()
    {
        $this->assertEquals('116', $this->commonDay('day4:puzzleB', __DIR__.'/input.txt')); // ~0.01278751s
    }
}
