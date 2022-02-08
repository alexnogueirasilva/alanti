<?php


namespace App\Api;


abstract class Logger
{
    public function __construct($filename)
    {
        $this->filename = $filename;
        file_put_contents($filename);

    }

    abstract function write($mensage);

}