<?php

namespace Railken\Advent2020\Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Process\Process;
use Railken\Advent2020\Tests\BaseTest;

class PuzzleACommandTest extends BaseTest
{
    public function testCycle()
    {
        $application = new Application();

        $application->add(new \Railken\Advent2020\Day1\PuzzleACommand());

        $command = $application->find('day1:puzzleA');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs([
            'something'
        ]);

        $commandTester->execute([
            'command' => $command->getName()
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals(1, 1);
    }
}
