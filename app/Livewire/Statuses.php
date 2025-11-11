<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Status;
use App\Rules\AlphaSpaces;
use Illuminate\Support\Facades\Log;

class Statuses extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = null;
    public $orderField = 'name';       // default ordering field
    public $orderDirection = 'asc';   // default ordering direction
    public $name;
    public $description;
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
        $statuses = Status::all();
        $query = Status::query();

        if (!is_null($this->search)) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        $statuses = $query
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(env('PAGINATION_COUNT', 10));

        return view('livewire.statuses', compact('statuses'));
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
            'name' => ['required','max:12', 'alpha'],
            'description' => ['nullable','max:20',new AlphaSpaces()],
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
        $this->resetValidation();
        $this->showForm = false;
    }
    public function store()
    {
        //validation
        $this->validate();

        //save
        Status::create([
            'name' => $this->name,
            'description' => $this->description
        ]);
        $this->reset();
        $this->resetValidation();
        $this->showForm = false;

        //give a message back to the user
        session()->flash('success', 'Status added successfully.');
    }
    public function edit($id){
        // selct based on id
        $status = Status::findOrFail($id);
        $this->name = $status->name;
        $this->id = $status->id;
        $this->description = $status->description;
        $this->showForm = true;
        $this->isEditing = true;
    }
   public function update($id){
    // validate
    $this->validate();
    $status = Status::findOrFail($id);
    $status->name = $this->name;
    $status->description = $this->description;
    $status->save();

    // update the state of our variable
    $this -> reset();
    $this -> resetValidation();
    $this ->isEditing = false;
    $this -> showForm = false;

    session()->flash('success', 'Status updated successfully.');
   } 
   public function destroy($id){
    try{
        $status = Status::findOrFail($id);
        $status->delete();
        session()->flash('success', 'Status deleted successfully.');
        
    }catch(\Illuminate\Database\QueryException $e){
        Log::error($e);
        session()->flash('error', 'Cannot delete status because it is linked to other records.');
    }
     }
}