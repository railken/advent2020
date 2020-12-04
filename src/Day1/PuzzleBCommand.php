<?php

namespace Railken\Advent2020\Day1;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleBCommand extends BaseCommand
{
    protected $name = 'day1:puzzleB';

    protected function parseFile(string $content): Collection
    {
        $rows = Collection::make(explode("\n", $content));

        $rows = $rows->map(function ($row) {
            return intval($row);
        });

        return $rows->sort()->values();
    }

    protected function getResult(Collection $rows)
    {
        $rows = $rows->toArray();

        $length = count($rows);

        for ($x1 = 0; $x1 < $length; ++$x1) {
            for ($x2 = 0; $x2 < $length; ++$x2) {
                for ($x3 = 0; $x3 < $length; ++$x3) {
                    if ($rows[$x1] + $rows[$x2] + $rows[$x3] === 2020) {
                        return $rows[$x1] * $rows[$x2] * $rows[$x3];
                    }
                }
            }
        }

        return null;
    }
}
