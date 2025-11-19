<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="{{ $editingId ? 'update' : 'save' }}">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" wire:model="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Abbreviation</label>
            <input type="text" wire:model="abbrev" class="form-control">
            @error('abbrev') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea wire:model="description" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $editingId ? 'Update Institution' : 'Add Institution' }}
        </button>
    </form>

    <hr>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Abbrev</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($institutions as $institution)
                <tr>
                    <td>{{ $institution->id }}</td>
                    <td>{{ $institution->name }}</td>
                    <td>{{ $institution->abbrev }}</td>
                    <td>{{ $institution->description }}</td>
                    <td>
                        <button wire:click="edit({{ $institution->id }})" class="btn btn-warning btn-sm">Edit</button>
                        <button wire:click="delete({{ $institution->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

