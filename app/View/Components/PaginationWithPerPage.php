<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaginationWithPerPage extends Component
{
    public $pagination;

    public function __construct($pagination)
    {
        $this->pagination = $pagination;
    }

    public function render()
    {
        return view('admin::layouts.pagination-with-per-page');
    }
}
