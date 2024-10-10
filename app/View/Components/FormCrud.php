<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormCrud extends Component
{
    public $name;
    public $label;
    public $type;
    public $placeholder;
    public $value;

    public function __construct($name, $label, $type = 'text', $placeholder = '', $value = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form-crud');
    }
}
