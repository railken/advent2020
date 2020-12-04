<?php

namespace Railken\Advent2020\Day3;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleBCommand extends BaseCommand
{
    protected $name = 'day3:puzzleB';

    public function calculate($rows, $x, $y)
    {
        $col = 0;
        $n = 0;
        for ($row = 0; $row < count($rows); $row += $y) {
            $s = $rows[$row];

            if (!empty($s)) {
                $index = $this->getIndex($col, strlen($s));

                if ($s[$index] === '#') {
                    ++$n;
                }

                $col += $x;
            }
        }

        return $n;
    }

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
        $options = collect([
            [1, 1],
            [3, 1],
            [5, 1],
            [7, 1],
            [1, 2],
        ]);

        return $options->map(function ($opt) use ($rows) {
            return $this->calculate($rows, $opt[0], $opt[1]);
        })->reduce(function ($carry, $item) {
            return $carry * $item;
        }, 1);
    }
}
