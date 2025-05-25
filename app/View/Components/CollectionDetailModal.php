<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Collection;

class CollectionDetailModal extends Component
{
    public $collection;
    public $show; // whether modal is shown

    public function __construct(Collection $collection, $show = false)
    {
        $this->collection = $collection;
        $this->show = $show;
    }

    public function render()
    {
        return view('components.collection-detail-modal');
    }
}
