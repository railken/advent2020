<?php

namespace Railken\Advent2020\Day1;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    /**
     * Name of the command
     *
     * @var string
     */
    protected $name = 'day1:puzzleA';

    /**
     * Convert input file into a Collection
     *
     * @param string $content
     *
     * @return Collection
     */
    protected function mapInput(string $content): Collection
    {
        $rows = Collection::make(explode("\n", $content));

        $rows = $rows->map(function ($row) {
            return intval($row);
        });

        return $rows->sort()->values();
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
        foreach ($rows as $row1) {
            foreach ($rows as $row2) {
                if ($row1 + $row2 === 2020) {
                    return $row1 * $row2;
                }
            }
        }
    }
}
