<?php

namespace Railken\Advent2020\Day2;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleBCommand extends BaseCommand
{
    /**
     * Name of the command
     *
     * @var string
     */
    protected $name = 'day2:puzzleB';

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

        return $rows->map(function ($row) {
            preg_match_all("/^([\d]*)-([\d]*) ([\w]{1})\: ([\w]*)$/", $row, $result);

            return isset($result[0][0]) ? [intval($result[1][0]), intval($result[2][0]), $result[3][0], $result[4][0]] : null;
        })->filter(function ($i) {
            return isset($i[0]);
        });
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
        // 0 min
        // 1 max
        // 2 char
        // 3 string

        return $rows->filter(function ($row) {
            $x1 = ($row[3][$row[0] - 1] ?? null) == $row[2];
            $x2 = ($row[3][$row[1] - 1] ?? null) == $row[2];

            return $x1 xor $x2;
        })->count();
    }
}
