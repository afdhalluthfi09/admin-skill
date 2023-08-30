<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public $page;
    public $js;
    public function __construct($page = null,$js=null)
    {
        $this->page = $page;
        $this->js=$js;
    }
    public function render()
    {
        return view('layouts.dashboard',with([
            'page' => $this->page
        ]));
    }
}
