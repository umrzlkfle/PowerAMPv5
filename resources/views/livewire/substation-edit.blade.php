<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Edit Substation: {{ $substation->name }}</h5>
                            <a href="{{ route('substation.show', $substation) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Details
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <!-- Basic Information Section -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <h6 class="text-uppercase text-xs text-muted mb-3">Core Information</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 py-1">
                                                <label for="name" class="form-label text-muted">Name:</label>
                                                <input type="text" id="name" wire:model.defer="name" class="form-control" placeholder="Substation Name">
                                                @error('name') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="functional_location" class="form-label text-muted">Functional Location:</label>
                                                <input type="text" id="functional_location" wire:model.defer="functional_location" class="form-control" placeholder="Functional Location">
                                                @error('functional_location') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="status" class="form-label text-muted">Status:</label>
                                                <select id="status" wire:model.defer="status" class="form-select">
                                                    <option value="">Select Status</option>
                                                    <option value="Existing">Existing</option>
                                                    <option value="Inactive">Inactive</option>
                                                    <option value="Abandoned">Abandoned</option>
                                                </select>
                                                @error('status') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="voltage" class="form-label text-muted">Voltage Level (e.g., 33/11 or 132):</label>
                                                <input type="text" id="voltage" wire:model.defer="voltage" class="form-control" placeholder="e.g., 33/11">
                                                @error('voltage') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="operational_area" class="form-label text-muted">Operational Area:</label>
                                                <input type="text" id="operational_area" wire:model.defer="operational_area" class="form-control" placeholder="Operational Area">
                                                @error('operational_area') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <h6 class="text-uppercase text-xs text-muted mb-3">Ownership Details</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 py-1">
                                                <label for="owner_type" class="form-label text-muted">Owner Type:</label>
                                                <input type="text" id="owner_type" wire:model.defer="owner_type" class="form-control" placeholder="Owner Type" readonly>
                                                @error('owner_type') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="owner_name" class="form-label text-muted">Owner Name:</label>
                                                <input type="text" id="owner_name" wire:model.defer="owner_name" class="form-control" placeholder="Owner Name" readonly>
                                                @error('owner_name') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="design" class="form-label text-muted">Design:</label>
                                                <input type="text" id="design" wire:model.defer="design" class="form-control" placeholder="Design">
                                                @error('design') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="category" class="form-label text-muted">Category:</label>
                                                <select id="category" wire:model.defer="category" class="form-select">
                                                    <option value="">Select Category</option>
                                                    <option value="PMU">PMU</option>
                                                    <option value="PPU">PPU</option>
                                                    <option value="SSU">SSU</option>
                                                </select>
                                                @error('category') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="status_act" class="form-label text-muted">Status Activity:</label>
                                                <input type="text" id="status_act" wire:model.defer="status_act" class="form-control" placeholder="Status Activity">
                                                @error('status_act') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-uppercase text-xs text-muted mb-3">Location Information</h6>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="latitude" class="form-label text-muted">Latitude:</label>
                                                    <input type="text" id="latitude" wire:model.live="latitude" class="form-control" placeholder="e.g., 3.140853">
                                                    @error('latitude') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="longitude" class="form-label text-muted">Longitude:</label>
                                                    <input type="text" id="longitude" wire:model.live="longitude" class="form-control" placeholder="e.g., 101.693207">
                                                    @error('longitude') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="label" class="form-label text-muted">Label:</label>
                                                    <input type="text" id="label" wire:model.defer="label" class="form-control" placeholder="Location Label" readonly>
                                                    @error('label') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($mapUrl)
                                            <div class="mt-3" style="height: 300px; border-radius: 8px; overflow: hidden;">
                                                <iframe 
                                                    width="100%" 
                                                    height="100%" 
                                                    frameborder="0" 
                                                    scrolling="no" 
                                                    marginheight="0" 
                                                    marginwidth="0" 
                                                    src="https://maps.google.com/maps?q={{ $latitude }},{{ $longitude }}&z=15&output=embed">
                                                </iframe>
                                            </div>
                                        @else
                                            <div class="alert alert-warning mt-3">
                                                <i class="fas fa-map-marker-alt me-2"></i> Enter Latitude and Longitude to view map preview.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="button" wire:click="cancel" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


