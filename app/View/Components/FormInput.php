<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class FormInput extends Component
{
    public $name;
    public $label;
    public $id;
    public $errorKey;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label = null, $id = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->errorKey = $this->formatErrorKey($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }

    /**
     * Format the error key based on the input name.
     */
    private function formatErrorKey($name): string
    {
        // Ubah format 'setting[logo]' menjadi 'setting.logo'
        return Str::of($name)
            ->replace(['[', ']'], ['.', ''])
            ->toString();
    }
}
