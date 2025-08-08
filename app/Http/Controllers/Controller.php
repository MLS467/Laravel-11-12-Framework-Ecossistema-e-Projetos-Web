<?php

namespace App\Http\Controllers;

/**
 * Base Controller
 *
 * @package App\Http\Controllers
 */
abstract class Controller
{
    // Base controller for other controllers to extend

    protected function cleanToUpperCase($args)
    {
        return "<h1>Valor de: " . strtoupper(trim($args)) . "</h1>";
    }
}