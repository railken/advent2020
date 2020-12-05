<?php

namespace Railken\Advent2020\Day5;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleBCommand extends PuzzleACommand
{
    /**
     * Name of the command
     *
     * @var string
     */
    protected $name = 'day5:puzzleB';

 
    /**
     * Resolve puzzle given collection
     *
     * @param Collection $rows
     *
     * @return mixed
     */
    protected function getResult(Collection $rows)
    {
        $rows = $rows->map(function ($row) {
            return $this->calculate("F", "B", $row[0], 128) * 8 + $this->calculate("L", "R", $row[1], 8);
        });

        $rows = $rows->sort()->values();

        $missing = [];
        $prev = null;

        for ($x = 0; $x < count($rows); $x++) {
            $el = $rows->get($x);

            if ($prev !== null && ($prev+1 != $rows->get($x))) {
                $missing = array_merge($missing, range($prev+1, $rows->get($x)-1));
            }

            $prev = $rows->get($x);
        }

        return $missing[0];
    }
}
