<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public $label;
    public $model;
    public $data;
    public $key;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data, $key, $value, $label, $model)
    {
        $this->label = $label;
        $this->model = $model;
        $this->data = $data;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-select');
    }
}
