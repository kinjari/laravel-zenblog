<?php

namespace Kinjari\LaravelZenblog\Support;

use Illuminate\Support\Collection;

class ZenblogPaginator
{
    public Collection $items;
    public $total;
    public $per_page;
    public $current_page;
    public $last_page;

    public function __construct(Collection $items, $total = null, $per_page = null, $current_page = null, $last_page = null)
    {
        $this->items = $items;
        $this->total = $total;
        $this->per_page = $per_page;
        $this->current_page = $current_page;
        $this->last_page = $last_page;
    }

    public function items()
    {
        return $this->items;
    }

    public function toArray()
    {
        return [
            'items' => $this->items->toArray(),
            'total' => $this->total,
            'per_page' => $this->per_page,
            'current_page' => $this->current_page,
            'last_page' => $this->last_page,
        ];
    }
} 