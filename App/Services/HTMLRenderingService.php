<?php

namespace App\Services;

class HTMLRenderingService
{
    public function render($file, $arguments)
    {
        foreach ($arguments as $key => $value) {
            $GLOBALS[$key] = $value;
        }

        include_once $file;
    }
}