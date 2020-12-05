<?php

namespace Railken\Advent2020\Day5;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    /**
     * Name of the command
     *
     * @var string
     */
    protected $name = 'day5:puzzleA';

    /**
     * Convert input file into a Collection
     *
     * @param string $content
     *
     * @return Collection
     */
    protected function mapInput(string $content): Collection
    {
        $rows = Collection::make(preg_split("/\n/", $content));

        $rows = $rows->filter(function ($row) {
            return !empty($row);
        });

        return $rows->map(function ($i) {
            return str_split($i, 7);
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
        $rows = $rows->map(function ($row) {
            return $this->calculate("F", "B", $row[0], 128) * 8 + $this->calculate("L", "R", $row[1], 8);
        });
        
        return $rows->sortDesc()->first();
    }

    public function calculate($scaleDownLast, $scaleUpFirst, $str, $max)
    {
        $i = [0, $max - 1];

        for ($x = 0; $x < strlen($str); $x++) {

            $max=$max/2;

            $char = $str[$x];

            if ($char === $scaleUpFirst) {
                $i[0] += $max;
            }
            if ($char === $scaleDownLast) {
                $i[1] -= $max;
            }

            if ($i[0] === $i[1]) {
                return $i[0];
            }
        }

        throw new \Exception(sprintf("Cannot calculate %s", $row[0]));
    }
}
