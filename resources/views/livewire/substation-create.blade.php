<div class="container py-4">
    <div class="card mb-4">
        <div class="card-header bg-white py-3 border-bottom-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create New Substation</h5>
                <a href="{{ route('substations.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Substation Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-font"></i>
                                        </span>
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            placeholder="e.g. Central Grid Station"
                                            wire:model="name"
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Functional Location <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <input 
                                            type="text" 
                                            class="form-control @error('functional_location') is-invalid @enderror" 
                                            placeholder="e.g. GRID-CENT-001"
                                            wire:model="functional_location"
                                        >
                                        @error('functional_location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-power-off"></i>
                                        </span>
                                        <select 
                                            class="form-select @error('status') is-invalid @enderror" 
                                            wire:model="status"
                                        >
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="backup">Backup</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Voltage Level (kV) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-bolt"></i>
                                        </span>
                                        <input 
                                            type="number" 
                                            class="form-control @error('voltage') is-invalid @enderror" 
                                            placeholder="e.g. 132"
                                            wire:model="voltage"
                                            min="0"
                                            step="1"
                                        >
                                        @error('voltage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Design Type <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-drafting-compass"></i>
                                        </span>
                                        <select 
                                            class="form-select @error('design') is-invalid @enderror" 
                                            wire:model="design"
                                        >
                                            <option value="">Select Design</option>
                                            <option value="gis">GIS (Gas Insulated)</option>
                                            <option value="ais">AIS (Air Insulated)</option>
                                            <option value="hybrid">Hybrid</option>
                                            <option value="outdoor">Outdoor</option>
                                            <option value="indoor">Indoor</option>
                                        </select>
                                        @error('design')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Operational Area <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map"></i>
                                        </span>
                                        <input 
                                            type="text" 
                                            class="form-control @error('operational_area') is-invalid @enderror" 
                                            placeholder="e.g. Central Region"
                                            wire:model="operational_area"
                                        >
                                        @error('operational_area')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-globe-americas"></i>
                                        </span>
                                        <input 
                                            type="number" 
                                            class="form-control @error('latitude') is-invalid @enderror" 
                                            placeholder="e.g. 3.1390"
                                            step="any"
                                            wire:model="latitude"
                                        >
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-globe-americas"></i>
                                        </span>
                                        <input 
                                            type="number" 
                                            class="form-control @error('longitude') is-invalid @enderror" 
                                            placeholder="e.g. 101.6869"
                                            step="any"
                                            wire:model="longitude"
                                        >
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text align-items-start pt-2">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <textarea 
                                            class="form-control @error('description') is-invalid @enderror" 
                                            rows="3"
                                            placeholder="Additional details about this substation..."
                                            wire:model="description"
                                        ></textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-secondary"
                                        wire:click.prevent="$dispatch('cancel')"
                                    >
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="btn btn-primary"
                                        wire:loading.attr="disabled"
                                    >
                                        <span wire:loading.remove wire:target="save">
                                            <i class="fas fa-plus-circle me-1"></i> Create Substation
                                        </span>
                                        <span wire:loading wire:target="save">
                                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                            Creating...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="col-lg-4">
                    <div class="card bg-gradient-primary border-0 text-white h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">Location Information</h5>
                            
                            <div class="d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-2"></i>
                                <p class="mb-0">Enter geographical coordinates or use the button below to detect your current location.</p>
                            </div>
                            
                            <div class="position-relative bg-white bg-opacity-15 rounded p-4 mb-4 flex-grow-1">
                                <div id="map-placeholder" class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center">
                                        <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                        <p>Location coordinates will appear here</p>
                                    </div>
                                </div>
                                
                                @if($latitude && $longitude)
                                    <div id="location-coordinates" class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 p-2 text-center">
                                        <small>
                                            <span class="d-block">{{ $latitude }}, {{ $longitude }}</span>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            
                            <button 
                                type="button" 
                                class="btn btn-light btn-sm align-self-start mt-2"
                                wire:click="detectLocation"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading.remove wire:target="detectLocation">
                                    <i class="fas fa-location-arrow me-1"></i> Detect Current Location
                                </span>
                                <span wire:loading wire:target="detectLocation">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Detecting...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if (session()->has('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto"><i class="fas fa-check-circle me-2"></i> Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle location detection events
        Livewire.on('detecting-location', () => {
            const mapEl = document.getElementById('map-placeholder');
            mapEl.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <div class="spinner-border text-light mb-3" role="status"></div>
                    <p>Detecting your location...</p>
                </div>
            `;
        });
        
        Livewire.on('location-detected', (e) => {
            const mapEl = document.getElementById('map-placeholder');
            mapEl.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <p>Location detected successfully!</p>
                </div>
            `;
            
            // Show coordinates container
            document.getElementById('location-coordinates')?.remove();
            const coordsEl = document.createElement('div');
            coordsEl.id = 'location-coordinates';
            coordsEl.className = 'position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 p-2 text-center';
            coordsEl.innerHTML = `<small><span class="d-block">${e.latitude}, ${e.longitude}</span></small>`;
            mapEl.parentElement.appendChild(coordsEl);
        });
        
        Livewire.on('location-error', (message) => {
            const mapEl = document.getElementById('map-placeholder');
            mapEl.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <p>${message}</p>
                </div>
            `;
        });
    });
</script>
@endpush