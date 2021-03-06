<?php

namespace Railken\Advent2020\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

abstract class BaseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $dir = __DIR__.'/../var';

        if (file_exists($dir)) {
            $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
            $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($ri as $file) {
                $file->isDir() ? rmdir($file) : unlink($file);
            }
            rmdir($dir);
        }

        mkdir($dir, 0777, true);
    }

    public function commonDay($path, $file)
    {
        $application = new Application();

        $application->add(new \Railken\Advent2020\Day1\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day1\PuzzleBCommand());
        $application->add(new \Railken\Advent2020\Day2\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day2\PuzzleBCommand());
        $application->add(new \Railken\Advent2020\Day3\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day3\PuzzleBCommand());
        $application->add(new \Railken\Advent2020\Day4\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day4\PuzzleBCommand());
        $application->add(new \Railken\Advent2020\Day5\PuzzleACommand());
        $application->add(new \Railken\Advent2020\Day5\PuzzleBCommand());

        $command = $application->find($path);
        $commandTester = new CommandTester($command);

        $commandTester->setInputs([
        ]);

        $diff = 0;
        $total = 10;

        for ($i = 0; $i < $total; ++$i) {
            $start = microtime(true);

            $commandTester->execute([
                'command' => $command->getName(),
                'path'    => $file,
            ]);

            $end = microtime(true);

            $diff += $end - $start;
        }

        print_r("\n\n<Name:'$path'> <AVG:".number_format($diff / $total, 8).'s> <Total:'.$total.">\n");

        return $commandTester->getDisplay();
    }

    public function getDir()
    {
        return __DIR__.'/../var/cache';
    }
}
