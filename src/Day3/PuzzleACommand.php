<?php

namespace Railken\Advent2020\Day3;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    /**
     * Name of the command
     *
     * @var string
     */
    protected $name = 'day3:puzzleA';

    /**
     * Convert input file into a Collection
     *
     * @param string $content
     *
     * @return Collection
     */
    protected function mapInput(string $content): Collection
    {
        return Collection::make(explode("\n", $content));
    }

    /**
     * Resolve puzzle given collection
     *
     * @param Collection $rows
     *
     * @return mixed
     */
    protected function getResult(Collection $rows)
    {
        $col = 0;
        $n = 0;
        for ($row = 0; $row < count($rows); ++$row) {
            $s = $rows[$row];

            if (!empty($s)) {
                $index = $this->getIndex($col, strlen($s));

                if ($s[$index] === '#') {
                    ++$n;
                }

                $col += 3;
            }
        }

        return $n;
    }

    protected function getIndex($i, $max)
    {
        return $i % $max;
    }
}
