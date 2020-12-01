<?php

namespace Railken\Advent2020\Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $dir = __DIR__.'/../var';

        if (file_exists($dir)) {
            $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
            $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($ri as $file) {
                $file->isDir() ? rmdir($file) : unlink($file);
            }
            rmdir($dir);
        }

        mkdir($dir, 0777, true);
    }

    public function getDir()
    {
        return __DIR__.'/../var/cache';
    }
}
