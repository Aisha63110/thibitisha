<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Practitioner;
use App\Models\Status;

class Practitioners extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap";
    
    public $search = '';
    public $orderField = 'full_name';
    public $orderDirection = 'asc';
    public function render()
    {
        $searchString = '%' . $this->search . '%';
         $practitioners = Practitioner::query()
        ->where('full_name', 'like', $searchString)
        ->orWhereHas('status', function($q) use ($searchString) {
            $q->where('name', 'like', $searchString);
        })
        ->orWhereHas('speciality', function($q) use ($searchString) {
            $q->where('name', 'like', $searchString);
        })
        ->orderBy($this->orderField, $this->orderDirection)
        ->paginate(env('PAGINATION_COUNT', 10));

        return view('livewire.practitioners', compact('practitioners'));
    }
    public function activate($id)
{
    $practitioner = Practitioner::findOrFail($id);
    $activeStatus = Status::where('name', 'ACTIVE')->first();
    
    if ($activeStatus) {
        $practitioner->status_id = $activeStatus->id;
        $practitioner->save();
        session()->flash('success', 'Practitioner Activated Successfully');
    } else {
        session()->flash('error', 'Active status not found');
    }
}

public function deactivate($id)
{
    $practitioner = Practitioner::findOrFail($id);
    $inactiveStatus = Status::where('name', 'INACTIVE')->first();
    
    if ($inactiveStatus) {
        $practitioner->status_id = $inactiveStatus->id;
        $practitioner->save();
        session()->flash('success', 'Practitioner Deactivated Successfully');
    } else {
        session()->flash('error', 'Inactive status not found');
    }
}

}