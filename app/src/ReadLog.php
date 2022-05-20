<?php

namespace App;

use Exception;

class ReadLog
{
    public function getLines($pathToFile): \Generator
    {
        try {
            $f = fopen($pathToFile, 'r');
            if (!$f) {
                throw new Exception("Can't open this file");
            }
            while ($line = fgets($f)) {
                yield $line;
            }
        } catch (Exception $exception) {
            die($exception->getMessage());
        } finally {
            fclose($f);
        }
    }
}