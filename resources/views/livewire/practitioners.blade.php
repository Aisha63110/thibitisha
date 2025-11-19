<div class="col-12">

    {{--  flash messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif 
    <div class="card card-warning card-outline mb-4">
        <div class="card-header">
            <h3>Practitioners List</h3>
            <div class="card-tools">
                <input wire:model.live.debounce.200ms="search" 
                       type="text" 
                       class="form-control" 
                       placeholder="Search Practitioners">
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Reg. No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($practitioners as $practitioner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $practitioner->full_name }}</td>
                            <td>{{ $practitioner->registration_number }}</td>
                            <td>{{ $practitioner->status->name }}</td>
                            <td>{{ $practitioner->speciality->name }}</td>
                            <td>
                                <td>
    @if ($practitioner->status->name !== 'ACTIVE')
        <button wire:click="activate({{ $practitioner->id }})" 
                class="btn btn-sm btn-success"
                title="Activate">
            <i class="bi bi-check-circle"></i> Activate
        </button>
    @else
        <button wire:click="deactivate({{ $practitioner->id }})" 
                class="btn btn-sm btn-secondary"
                title="Deactivate">
            <i class="bi bi-x-circle"></i> Deactivate
        </button>
    @endif
</td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No practitioners found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $practitioners->links() }}
        </div>
    </div>
</div>
