<?php

namespace Railken\Advent2020\Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Process\Process;
use Railken\Advent2020\Tests\BaseTest;

class Day1CommandTest extends BaseTest
{
    public function testDay1PuzzleA()
    {
        $application = new Application();

        $application->add(new \Railken\Advent2020\Day1\PuzzleACommand());

        $command = $application->find('day1:puzzleA');
        $commandTester = new CommandTester($command);

        $commandTester->setInputs([
        ]);

        $commandTester->execute([
            'command' => $command->getName(),
            'path' => __DIR__."/input.txt"
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals("1007331", $output);
    }

    public function testDay1PuzzleB()
    {
        $application = new Application();

        $application->add(new \Railken\Advent2020\Day1\PuzzleBCommand());

        $command = $application->find('day1:puzzleB');
        $commandTester = new CommandTester($command);

        $commandTester->setInputs([
        ]);

        $commandTester->execute([
            'command' => $command->getName(),
            'path' => __DIR__."/input.txt"
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals("48914340", $output);
    }
}
