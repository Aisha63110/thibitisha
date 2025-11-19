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
    {{-- show view --}}
    @if ($showView)
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <h5>Practitioner Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $full_name }}</p>
            <p><strong>Registration Number:</strong> {{ $registration_number }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <p><strong>Speciality:</strong> {{ $speciality }}</p>
            <p><strong>Sub Speciality:</strong> {{ $sub_speciality }}</p>
            
            @if ($profile_photo_url)
                <p><strong>Photo:</strong></p>
                <img src="{{ asset('storage/' . $profile_photo_url) }}" 
                     class="img-thumbnail" 
                     width="150">
            @endif

            <h5 class="mt-3">Contact Details</h5>
            @if ($contacts && $contacts->count() > 0)
                <ul>
                    @foreach ($contacts as $contact)
                        <li>{{ $contact->type }}: {{ $contact->value }}</li>
                    @endforeach
                </ul>
            @else
                <p>No contact details available.</p>
            @endif

            <h5>Academic Qualifications</h5>
            @if ($qualifications && $qualifications->count() > 0)
                <ul>
                    @foreach ($qualifications as $qualification)
                        <li>
                            {{ $qualification->degree->name }} 
                            from {{ 
                            $qualification -> institution ? $qualification->institution->name : '' }}
                            ({{ $qualification->year_awarded }})
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No qualifications available.</p>
            @endif

            <div class="mt-3">
                <button wire:click="closeView" class="btn btn-secondary">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif
    
     {{-- Table --}}
    @if ($showView && ! $showForm)
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
                                    <button wire:click="viewOne({{ $practitioner->id }})" 
                                         class="btn btn-sm btn-info"
                                         title="View">
                                         <i class="bi bi-eye"></i> View
                                    </button>
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
    @endif
</div>
