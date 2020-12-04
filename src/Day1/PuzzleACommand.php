<?php

namespace Railken\Advent2020\Day1;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    protected $name = 'day1:puzzleA';

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
        foreach ($rows as $row1) {
            foreach ($rows as $row2) {
                if ($row1 + $row2 === 2020) {
                    return $row1 * $row2;
                }
            }
        }
    }
}
