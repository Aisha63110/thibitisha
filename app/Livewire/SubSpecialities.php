<?php

namespace App\Livewire;

use App\Models\SubSpeciality;
use Livewire\Component;
use Livewire\WithPagination;

class SubSpecialities extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;
    public $orderField = 'name';       // default ordering field
    public $orderDirection = 'asc';    // default ordering direction

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = SubSpeciality::query();

        if (!is_null($this->search)) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        $subspecialities = $query
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(env('PAGINATION_COUNT', 10));

        return view('livewire.sub-specialities', compact('subspecialities'));
    }
    public function orderBy($field)
    {
        // update the order field
        $this->orderField = $field;
        if ($this->orderDirection=== 'asc') {
            // Toggle to descending order
            $this->orderDirection = 'desc';
        } else {
            // Set to ascending order for a new field
            $this->orderDirection = 'asc';
        }
    }
    public function clearSearch()
    {
        $this->search = " ";
    }
}

