<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tableFilter extends Component
{
    private  $filterConfig;

    /**
     * @param $filterConfig
     */
    public function __construct($filterConfig)
    {
        $this->filterConfig = $filterConfig;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-filter')->with('filterConfig',$this->filterConfig);
    }
}
