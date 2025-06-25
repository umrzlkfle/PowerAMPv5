<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Edit Cable: {{ $cable->label }}</h5>
                            <a href="{{ route('cable show', $cable) }}" class="btn btn-sm btn-outline-primary">
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
                                                <label for="label" class="form-label text-muted">Label:</label>
                                                <input type="text" id="label" wire:model.defer="label" class="form-control" placeholder="Cable Label">
                                                @error('label') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="circ_id" class="form-label text-muted">Circuit ID:</label>
                                                <input type="text" id="circ_id" wire:model.defer="circ_id" class="form-control" placeholder="Circuit ID">
                                                @error('circ_id') <span class="text-danger text-xs">{{ $message }}</span> @enderror
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
                                                <label for="voltage" class="form-label text-muted">Voltage Level (kV):</label>
                                                <input type="text" id="voltage" wire:model.defer="voltage" class="form-control" placeholder="e.g., 33">
                                                @error('voltage') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="op_area" class="form-label text-muted">Operational Area:</label>
                                                <input type="text" id="op_area" wire:model.defer="op_area" class="form-control" placeholder="Operational Area">
                                                @error('op_area') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <h6 class="text-uppercase text-xs text-muted mb-3">Connection Details</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 py-1">
                                                <label for="from_info" class="form-label text-muted">From Location:</label>
                                                <input type="text" id="from_info" wire:model.defer="from_info" class="form-control" placeholder="From Location">
                                                @error('from_info') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="to_info" class="form-label text-muted">To Location:</label>
                                                <input type="text" id="to_info" wire:model.defer="to_info" class="form-control" placeholder="To Location">
                                                @error('to_info') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="FromToName" class="form-label text-muted">From-To Name:</label>
                                                <input type="text" id="FromToName" wire:model.defer="FromToName" class="form-control" placeholder="From-To Name">
                                                @error('FromToName') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="SubstationLabel" class="form-label text-muted">Substation Label:</label>
                                                <input type="text" id="SubstationLabel" wire:model.defer="SubstationLabel" class="form-control" placeholder="Substation Label">
                                                @error('SubstationLabel') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                            <li class="list-group-item px-0 py-1">
                                                <label for="class" class="form-label text-muted">Cable Class:</label>
                                                <select id="class" wire:model.defer="cable_class" class="form-select">
                                                    <option value="">Select Class</option>
                                                    <option value="Class C">Class C</option>
                                                    <option value="Class D">Class D</option>
                                                </select>
                                                @error('cable_class') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-uppercase text-xs text-muted mb-3">Route Information</h6>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="route_length" class="form-label text-muted">Route Length (km):</label>
                                                    <input type="number" step="0.01" id="route_length" wire:model.defer="route_length" class="form-control" placeholder="e.g., 5.2">
                                                    @error('route_length') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="FromLabel" class="form-label text-muted">From Label:</label>
                                                    <input type="text" id="FromLabel" wire:model.defer="FromLabel" class="form-control" placeholder="From Label">
                                                    @error('FromLabel') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column mb-3">
                                                    <label for="ToLabel" class="form-label text-muted">To Label:</label>
                                                    <input type="text" id="ToLabel" wire:model.defer="ToLabel" class="form-control" placeholder="To Label">
                                                    @error('ToLabel') <span class="text-danger text-xs">{{ $message }}</span> @enderror
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
                                                <i class="fas fa-map-marker-alt me-2"></i> Cable route visualization would appear here if coordinates were available.
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