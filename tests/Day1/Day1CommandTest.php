<?php

namespace Railken\Advent2020\Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Process\Process;
use Railken\Advent2020\Tests\BaseTest;

class Day1CommandTest extends BaseTest
{
    public function commonDay($path) {

        $start = microtime(true);
        print_r("\n\n$path: ");
        $application = new Application();

        $application->add(new \Railken\Advent2020\Day1\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day1\PuzzleBCommand());

        $command = $application->find($path);
        $commandTester = new CommandTester($command);

        $commandTester->setInputs([
        ]);

        $commandTester->execute([
            'command' => $command->getName(),
            'path' => __DIR__."/input.txt"
        ]);

        $end = microtime(true);

        print_r($end - $start ."s\n");

        return $commandTester->getDisplay();
    }

    public function testDay1PuzzleA()
    {
        $this->assertEquals("1007331", $this->commonDay('day1:puzzleA')); // ~ 0.009 sec
    }

    public function testDay1PuzzleB()
    {
        $this->assertEquals("48914340", $this->commonDay('day1:puzzleB')); // ~0.011 sec
    }
}
