<?php

namespace Railken\Advent2020\Day4;

use Illuminate\Support\Collection;
use Railken\Advent2020\BaseCommand;

class PuzzleBCommand extends BaseCommand
{
    protected $name = 'day4:puzzleB';

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
        })->filter(function ($row) {
            $byr = intval($row->get('byr'));

            return $byr >= 1920 && $byr <= 2002;
        })->filter(function ($row) {
            $iyr = intval($row->get('iyr'));

            return $iyr >= 2010 && $iyr <= 2020;
        })->filter(function ($row) {
            $eyr = intval($row->get('eyr'));

            return $eyr >= 2020 && $eyr <= 2030;
        })->filter(function ($row) {
            $hgt = $row->get('hgt');
            $h = intval($hgt);

            if (strpos($hgt, 'cm')) {
                return $h >= 150 && $h <= 193;
            } elseif (strpos($hgt, 'in')) {
                return $h >= 59 && $h <= 76;
            } else {
                return false;
            }
        })->filter(function ($row) {
            return preg_match('/^#([0123456789abcdef]*){6}$/i', $row->get('hcl'));
        })->filter(function ($row) {
            return in_array($row->get('ecl'), ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true);
        })->filter(function ($row) {
            return preg_match('/^([0-9]{9})$/', $row->get('pid'));
        })->count();
    }
}
