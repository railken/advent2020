<?php

namespace Railken\Advent2020\Tests;

use Railken\Advent2020\Tests\BaseTest;

class Day2CommandTest extends BaseTest
{
    public function testDay2PuzzleA()
    {
        $this->assertEquals("469", $this->commonDay('day2:puzzleA', __DIR__."/input.txt")); // ~ 0.00616128s
    }

    public function testDay2PuzzleB()
    {
        $this->assertEquals("267", $this->commonDay('day2:puzzleB', __DIR__."/input.txt")); // ~0.00580080s
    }
}
