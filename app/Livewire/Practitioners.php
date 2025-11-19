<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Practitioner;
use App\Models\Status;
use App\Models\Speciality;
use App\Models\SubSpeciality;
use App\Models\Degree;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Practitioners extends Component
{
    use WithPagination,WithFileUploads;
    
    protected $paginationTheme = "bootstrap";
    
    public $search = '';
    public $orderField = 'full_name';
    public $orderDirection = 'asc';
    public $id, $registration_number, $full_name;
    public $profile_photo_url, $status, $speciality, $sub_speciality, $statusId;
    public $contacts, $qualifications;

    public $status_id, $specialityId, $subSpecialityId;
    public $subSpecialities = null;
    public $qualifications_array = [];

    public $showView = false;
    public $showEdit = false;
    public $isEditing = false;
    public $showForm = false;

public function render()
{
    $searchString = '%' . $this->search . '%';
    $statuses = Status::all();
    $specialities = Speciality::all();
    $degrees = Degree::all();
    $degrees = degree::all();

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

    return view('livewire.practitioners', compact('practitioners', 'statuses','specialities','degrees','institutions'));
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
    $this->sub_speciality = $practitioner->subspeciality ? $practitioner->sub_speciality->name : '';
    $this->contacts = $practitioner->contacts;
    $this->qualifications = $practitioner->qualifications;
    
    $this->showView = true;

}

public function closeView()
{
    $this->reset();
    $this->showView = false;
}

public function add()
{
    $this->reset();
    $this->resetValidation();
    
    // Generate registration number
    $lastPractitioner = Practitioner::orderBy('registration_number', 'desc')->first();
    $nextId = $lastPractitioner ? $lastPractitioner->registration_number + 1 : 1;
    $this->registration_number = $nextId;
    
    $this->showForm = true;
}

public function cancel()
{
    $this->reset();
    $this->showForm = false;
}
public function rules()
{
    return [
        'registration_number' => 'required',
        'full_name' => ['required', 'max:255'],
        'profile_photo_url' => 'nullable|image|max:5120', // 5MB max
        'status_id' => 'required|exists:statuses,id',
        'specialityId' => 'nullable|exists:specialities,id',
        'subSpecialityId' => 'nullable|exists:sub_specialities,id',
    ];
}

public function store(){
    $this ->validate ();
    $photoPath = null;
    
    // Handle photo upload
    if ($this->profile_photo_url) {
        Storage::disk('public')->makeDirectory('profile_photos');
        $photoPath = $this->profile_photo_url->store('profile_photos', 'public');
    }

    // Create practitioner
    $practitioner = new Practitioner();
    $practitioner->registration_number = $this->registration_number;
    $practitioner->full_name = $this->full_name;
    $practitioner->profile_photo_url = $photoPath;
    $practitioner->status_id = $this->status_id;
    
    // Set default specialities if not provided
    $practitioner->speciality_id = $this->specialityId ?? 
        Speciality::where('name', 'UNKNOWN')->first()->id;
    $practitioner->sub_speciality_id = $this->subSpecialityId ?? 
        SubSpeciality::where('name', 'UNKNOWN')->first()->id;
    
    $practitioner->date_of_registration = now();
    $practitioner->save();

    // Save qualifications
    foreach ($this->qualifications_array as $qualificationData) {
        if (isset($qualificationData['degree_id'], 
                  $qualificationData['institution_id'], 
                  $qualificationData['year_awarded'])) {
            $practitioner->qualifications()->create([
                'degree_id' => $qualificationData['degree_id'],
                'institution_id' => $qualificationData['institution_id'],
                'year_awarded' => $qualificationData['year_awarded'],
            ]);
        }
    }

    $this->reset();
    $this->resetValidation();
    $this->showForm = false;

    session()->flash('success', 'Practitioner Created Successfully');


}
public function updatedSpecialityId()
{
    $this->subSpecialities = SubSpeciality::where('speciality_id', $this->specialityId)->get();
    $this->subSpecialityId = null; // Reset sub-speciality selection
}


}


