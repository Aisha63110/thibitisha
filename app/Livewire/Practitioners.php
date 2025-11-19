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
    public $id, $registration_number, $full_name;
    public $profile_photo_url, $status, $speciality, $sub_speciality;
    public $contacts, $qualifications;
    public $showView = false;
    public $showEdit = false;

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
public function viewOne($id)
{
    $practitioner = Practitioner::with('contacts', 'qualifications')
        ->findOrFail($id);
    
    $this->id = $practitioner->id;
    $this->registration_number = $practitioner->registration_number;
    $this->full_name = $practitioner->full_name;
    $this->profile_photo_url = $practitioner->profile_photo_url;
    $this->status = $practitioner->status ? $practitioner->status->name : '';
    $this->speciality = $practitioner->speciality ? $practitioner->speciality->name : '';
    $this->sub_speciality = $practitioner->sub_speciality ? $practitioner->sub_speciality->name : '';
    $this->contacts = $practitioner->contacts;
    $this->qualifications = $practitioner->qualifications;
    
    $this->showView = true;

}

public function closeView()
{
    $this->reset();
    $this->showView = false;
}

}