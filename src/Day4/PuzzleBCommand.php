<?php

namespace Railken\Advent2020\Day4;

use Eloquent\Composer\Configuration\ConfigurationReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Support\Collection;

class PuzzleBCommand extends Command
{
    /**
     * @var \Eloquent\Composer\Configuration\ConfigurationReader
     */
    protected $composerReader;

    /**
     * Create a new instance of the command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('day4:puzzleB')
            ->addArgument('path', InputArgument::REQUIRED, 'The path of the input.txt files containing all records')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('path'))) {
            $output->write("<error>File doesn't exists</error>");
            return 1;
        }

        $rows = Collection::make(preg_split("/(\r\n|\r|\n)(\r\n|\r|\n)/", file_get_contents($input->getArgument('path'))));


        $rows = $rows->map(function($i) {
            return preg_split("/(\r\n|\r|\n| )/", $i);
        });


        $rows = $rows->map(function($i) {
            return collect($i)->filter(function($r) {
                return !empty($r);
            })->mapWithKeys(function ($r) {

                [$key, $value] = explode(":", $r);

                return [$key => $value];
            });
        });

        $result = $this->getResult($rows);

        if (!$result) {
            $output->write("<error>No match found</error>");
            return 1;
        }

        $output->write("<info>$result</info>");

        return 0;
    }

    public function getResult($rows)
    {
        $required = ['ecl', 'pid', 'eyr', 'hcl', 'byr', 'iyr', 'hgt'];
        return $rows->filter(function ($row) use ($required) {
            return $row->has($required);
        })->filter(function($row) {

            $byr = intval($row->get('byr'));
            return $byr >= 1920 && $byr <= 2002;
        })->filter(function($row) {

            $iyr = intval($row->get('iyr'));
            return $iyr >= 2010 && $iyr <= 2020;

        })->filter(function($row) {

            $eyr = intval($row->get('eyr'));
            return $eyr >= 2020 && $eyr <= 2030;
        })->filter(function($row) {

            $hgt = $row->get('hgt');
            $h = intval($hgt);

            if (strpos($hgt, "cm")) {

                return $h >= 150 && $h <= 193;
            } else if (strpos($hgt, "in")) {
                return $h >= 59 && $h <= 76;
            } else {
                return false;
            }

        })->filter(function($row) {
            return preg_match("/^#([0123456789abcdef]*){6}$/i",$row->get('hcl'));
        })->filter(function($row) {
            return in_array($row->get('ecl'), ['amb','blu','brn','gry','grn','hzl','oth']);
        })->filter(function($row) {
            return preg_match("/^([0-9]{9})$/",$row->get('pid'));
        })->count();
    }
}
