<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $model;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $model, $type)
    {
        $this->label = $label;
        $this->model = $model;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
