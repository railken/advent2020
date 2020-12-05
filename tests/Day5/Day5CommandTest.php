<?php

namespace Railken\Advent2020\Tests;

class Day5CommandTest extends BaseTest
{
    public function testDay5PuzzleA()
    {
        $this->assertEquals('864', $this->commonDay('day5:puzzleA', __DIR__.'/input.txt')); // ~ 0.01177380s
    }

    public function testDay5PuzzleB()
    {
        $this->assertEquals('739', $this->commonDay('day5:puzzleB', __DIR__.'/input.txt')); // ~0.01528759s
    }
}
