<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Institution;

class InstitutionForm extends Component
{
    public $name, $abbrev, $description;
    public $institutions;
    public $editingId = null;

    protected $rules = [
        'name' => 'required|string|max:100|unique:institutions,name',
        'abbrev' => 'nullable|string|max:10',
        'description' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->institutions = Institution::all();
    }

    public function save()
    {
        $this->validate();

        Institution::create([
            'name' => $this->name,
            'abbrev' => $this->abbrev,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'abbrev', 'description']);
        $this->institutions = Institution::all();
        session()->flash('success', 'Institution added successfully!');
    }

    public function edit($id)
    {
        $institution = Institution::findOrFail($id);
        $this->editingId = $id;
        $this->name = $institution->name;
        $this->abbrev = $institution->abbrev;
        $this->description = $institution->description;
    }

    public function update()
    {
        $institution = Institution::findOrFail($this->editingId);

        $this->validate([
            'name' => 'required|string|max:100|unique:institutions,name,' . $institution->id,
            'abbrev' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:255',
        ]);

        $institution->update([
            'name' => $this->name,
            'abbrev' => $this->abbrev,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'abbrev', 'description', 'editingId']);
        $this->institutions = Institution::all();
        session()->flash('success', 'Institution updated successfully!');
    }

    public function delete($id)
    {
        Institution::findOrFail($id)->delete();
        $this->institutions = Institution::all();
        session()->flash('success', 'Institution deleted successfully!');
    }

    public function render()
    {
        return view('livewire.institution');
    }
}

