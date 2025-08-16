<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class languages extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $key,
        public array $languages
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.languages');
    }

    // só deve redenriza se for Verdadeiro
    public function shouldRender(): bool
    {
        // deve renderizar se for maior que 1
        $toSpeakMoreTwoLanguage = count($this->languages) > 1;

        return $toSpeakMoreTwoLanguage;
    }

    // muda a cor se o nome for john
    public function changeColorName(): bool
    {
        // com a lógica no componente
        return $this->key === 'john';
    }
}