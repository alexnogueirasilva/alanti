<?php


namespace App\Api;


class LoggerTXT extends Logger
{

    public function write($mensage)
    {
        $text = date('Y-m-d H:i:s') . ' :' . $mensage;
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text . "\n");
        fclose($handler);
    }
}