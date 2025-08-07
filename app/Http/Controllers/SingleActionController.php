<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleActionController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): void
    {
        $this->show_string("metodo invoke");
        $this->show_string("Single Action");
        $this->show_string($this->private_method());
    }

    // pode ter metodos privados apenas por ser um Single Action
    private function private_method(): string
    {
        return "private method";
    }

    private function show_string($args)
    {
        echo "<h3>$args</h3><br>";
    }
}