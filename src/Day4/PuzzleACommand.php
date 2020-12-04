<?php

namespace Railken\Advent2020\Day4;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleACommand extends BaseCommand
{
    protected $name = 'day4:puzzleA';

    protected function parseFile(string $content): Collection
    {
        $rows = Collection::make(preg_split("/(\r\n|\r|\n)(\r\n|\r|\n)/", $content));

        $rows = $rows->map(function ($i) {
            return preg_split("/(\r\n|\r|\n| )/", $i);
        });

        return $rows->map(function ($i) {
            return collect($i)->filter(function ($r) {
                return !empty($r);
            })->mapWithKeys(function ($r) {
                [$key, $value] = explode(':', $r);

                return [$key => $value];
            });
        });
    }

    protected function getResult(Collection $rows)
    {
        $required = ['ecl', 'pid', 'eyr', 'hcl', 'byr', 'iyr', 'hgt'];

        return $rows->filter(function ($row) use ($required) {
            return $row->has($required);
        })->count();
    }
}
