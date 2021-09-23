<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datatable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $tableConfig;
    public function __construct($tableConfig)
    {
        $this->tableConfig = $tableConfig;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
