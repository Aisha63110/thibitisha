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
   {{-- The form (Add/Edit Practitioner) --}}
@if ($showForm)
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h5>{{ $isEditing ? 'Edit' : 'Add New' }} Practitioner</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                
                <!-- Registration Number (readonly) -->
                <div class="mb-3">
                    <label class="form-label">Registration Number</label>
                    <input type="text" 
                           class="form-control" 
                           wire:model="registration_number" 
                           readonly>
                </div>

                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" 
                           class="form-control @error('full_name') is-invalid @enderror" 
                           wire:model="full_name" 
                           placeholder="Enter full name">
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Photo Upload -->
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" 
                           class="form-control @error('profile_photo_url') is-invalid @enderror" 
                           wire:model="profile_photo_url">
                    @error('profile_photo_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Dropdown -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select @error('status_id') is-invalid @enderror" 
                            wire:model.live="status_id">
                        <option value="">Select Status</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- speciality --}}
                <div class="mb-3">
    <label class="form-label">Speciality</label>
    <select class="form-select" wire:model.live="specialityId">
        <option value="">Select Speciality</option>
        @foreach ($specialities as $speciality)
            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
        @endforeach
    </select>
</div>

                {{-- sub speciality --}}
           @if ($specialityId)
    <div class="mb-3">
        <label class="form-label">Sub Speciality</label>
        <select wire:key="subSpeciality-{{ $specialityId }}" 
                class="form-select" 
                wire:model="subSpecialityId">
            <option value="">Select Sub Speciality</option>
            @if ($subSpecialities)
                @foreach ($subSpecialities as $subSpeciality)
                    <option value="{{ $subSpeciality->id }}">
                        {{ $subSpeciality->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
@endif
{{-- Academic qualifications --}}
<div class="mb-3">
    <label class="form-label">Academic Qualifications</label>
    
    @foreach ($qualifications_array as $index => $qualification)
        <div class="card mb-2" wire:key="qualification-{{ $index }}">
            <div class="card-body">
                
                <!-- Degree -->
                <div class="mb-2">
                    <label class="form-label">Degree</label>
                    <select class="form-select" 
                            wire:model="qualifications_array.{{ $index }}.degree_id">
                        <option value="">Select Degree</option>
                        @foreach ($degrees as $degree)
                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Institution -->
                <div class="mb-2">
                    <label class="form-label">Institution</label>
                    <select class="form-select" 
                            wire:model="qualifications_array.{{ $index }}.institution_id">
                        <option value="">Select Institution</option>
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">
                                {{ $institution->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Awarded -->
                <div class="mb-2">
                    <label class="form-label">Year Awarded</label>
                    <input type="number" 
                           min="1900" 
                           max="{{ date('Y') }}" 
                           class="form-control" 
                           wire:model="qualifications_array.{{ $index }}.year_awarded"
                           placeholder="Enter year">
                </div>

                <!-- Remove Button -->
                <button type="button" 
                        class="btn btn-danger btn-sm" 
                        wire:click="removeQualification({{ $index }})">
                    Remove
                </button>
            </div>
        </div>
    @endforeach

    <button type="button" 
            class="btn btn-success btn-sm" 
            wire:click="addQualification">
        Add Qualification
    </button>
</div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif


    
     {{-- Table --}}
    @if ($showView && ! $showForm)
    <div class="card card-warning card-outline mb-4">
        <div class="card-header">
            <h3>Practitioners List</h3>
            
            <div class="card-tools">
                <button wire:click="add" class="btn btn-primary btn-sm">
                   <i class="bi bi-plus-circle"></i> Add New Practitioner
                 </button> 

                 <div class = "d-inline-block me-2">
                    <input wire:model.live.debounce.200ms="search" 
                       type="text" 
                       class="form-control" 
                       placeholder="Search Practitioners">
                 
                 </div> 
                      
              
                       
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
