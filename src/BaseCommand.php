<?php

namespace Railken\Advent2020;

use Illuminate\Support\Collection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName($this->name)
            ->addArgument('path', InputArgument::REQUIRED, 'The path of the input.txt files containing all records')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('path'))) {
            $output->write("<error>File doesn't exists</error>");

            return 1;
        }

        $result = $this->getResult($this->parseFile(file_get_contents($input->getArgument('path'))));

        if (!$result) {
            $output->write('<error>No match found</error>');

            return 1;
        }

        $output->write("<info>$result</info>");

        return 0;
    }

    abstract protected function getResult(Collection $rows);

    abstract protected function parseFile(string $content): Collection;
}
