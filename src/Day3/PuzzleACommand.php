<?php

namespace Railken\Advent2020\Day3;

use Eloquent\Composer\Configuration\ConfigurationReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    protected $name = 'day3:puzzleA';

    protected function parseFile(string $content): Collection
    {
        return Collection::make(explode("\n", $content));
    }

    protected function getIndex($i, $max)
    {
        return $i % $max;
    }

    protected function getResult(Collection $rows)
    {
        $col = 0; 
        $n = 0;
        for ($row = 0; $row < count($rows); $row++) {

            $s = $rows[$row];

            if (!empty($s)) {
                $index = $this->getIndex($col, strlen($s));

                if ($s[$index] === '#') {
                    $n++;
                }

                $col += 3;
            }

        }

        return $n;
    }
}
