<?php

namespace App\Livewire;

use App\Models\SubSpeciality;
use App\Models\Speciality;
use Livewire\Component;
use Livewire\WithPagination;
use App\Rules\AlphaSpaces;


class SubSpecialities extends Component
{
    
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;
    public $orderField = 'name';       // default ordering field
    public $orderDirection = 'asc';   // default ordering direction
    public $name;
    public $speciality;
    public $id;
    public $showForm = false;
    public $isEditing = false;
   

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $specialities = Speciality::all();
        $query = SubSpeciality::query();

        if (!is_null($this->search)) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        $subspecialities = $query
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(env('PAGINATION_COUNT', 10));

        return view('livewire.sub-specialities', compact('subspecialities', 'specialities'));
    }
    public function orderBy($field)
    {
        // update the order field
        $this->orderField = $field;
        if ($this->orderDirection === 'asc') {
            // Toggle to descending order
            $this->orderDirection = 'desc';
        } else {
            // Set to ascending order for a new field
            $this->orderDirection = 'asc';
        }
    }
    public function rules()
    {
        return [
            'name' => ['required','max:30', new AlphaSpaces()],
            'speciality' => ['required','integer']
        ];
    }
    public function clearSearch()
    {
        $this->search = " ";
    }
    public function add()
    {
        //rest the form
        $this->reset();
        $this->showForm = true;
    }
    public function cancel()
    {
        $this->reset();
        $this->showForm = false;
    }
    public function store()
    {
        //validation
        $this->validate();

        //save
        SubSpeciality::create([
            'name' => $this->name,
            'speciality_id' => $this->speciality
        ]);
        $this->reset();
        $this->showForm = false;

        //give a message back to the user
        session()->flash('success', 'Sub-Speciality added successfully.');
    }
    public function edit($id){
        // selct based on id
        $subspeciality = SubSpeciality::findOrFail($id);
        $this->name = $subspeciality->name;
        $this->id = $subspeciality->id;
        $this->speciality = $subspeciality->speciality_id;
        $this->showForm = true;
        $this->isEditing = true;
    }
   public function update($id){
    $subSpeciality = SubSpeciality::findOrFail($id);
    $subSpeciality->name = $this->name;
    $subSpeciality->speciality_id = $this->speciality;
    $subSpeciality->save();

    // update the state of our variable
    $this -> reset();
    $this ->isEditing = false;
    $this -> showForm = false;

    session()->flash('success', 'Sub-Speciality updated successfully.');
   } 
   public function destroy($id){
    $subSpeciality = SubSpeciality::findOrFail($id);
    $subSpeciality->delete();
    session()->flash('success', 'Sub-Speciality deleted successfully.');
   }
}
