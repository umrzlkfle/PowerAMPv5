<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Substation Details</h5>
                        <a href="{{ route('substations') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Basic Information Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-uppercase text-xs text-muted mb-3">Core Information</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Name:</span>
                                        <span class="fw-bold">{{ $substation->name }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Functional Location:</span>
                                        <span class="fw-bold">{{ $substation->functional_location }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge bg-gradient-{{ 
                                            $substation->status == 'Existing' ? 'success' : 
                                            ($substation->status == 'Inactive' ? 'warning' : 'secondary') 
                                        }}">
                                            {{ $substation->status }}
                                        </span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Voltage Level:</span>
                                        <span class="fw-bold">{{ $substation->voltage }} kV</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Operational Area:</span>
                                        <span class="fw-bold">{{ $substation->operational_area }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-uppercase text-xs text-muted mb-3">Ownership Details</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Owner Type:</span>
                                        <span class="fw-bold">{{ $substation->owner_type }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Owner Name:</span>
                                        <span class="fw-bold">{{ $substation->owner_name }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Design:</span>
                                        <span class="fw-bold">{{ $substation->design }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Category:</span>
                                        <span class="fw-bold">{{ $substation->category }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Status Activity:</span>
                                        <span class="fw-bold">{{ $substation->status_act }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-uppercase text-xs text-muted mb-0">Location Information</h6>
                                    @if($mapUrl)
                                        <a href="{{ $mapUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-map-marked-alt me-1"></i> View on Google Maps
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Latitude</small>
                                            <span class="fw-bold">{{ $substation->latitude ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Longitude</small>
                                            <span class="fw-bold">{{ $substation->longitude ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column">
                                            <small class="text-muted">Label</small>
                                            <span class="fw-bold">{{ $substation->label ?? 'No label available' }}</span>
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
                                            src="https://maps.google.com/maps?q={{ $substation->latitude }},{{ $substation->longitude }}&z=15&output=embed">
                                        </iframe>
                                    </div>
                                @else
                                    <div class="alert alert-warning mt-3">
                                        <i class="fas fa-map-marker-alt me-2"></i> No coordinates available for this substation
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Breakdown History Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="border rounded p-3">
                                <h6 class="text-uppercase text-xs text-muted mb-3">Breakdown History</h6>
                                @if ($breakdownRecords->isEmpty())
                                    <p class="text-muted">No breakdown records found for this substation.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tripping No.</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Source</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tripping Point</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tripping Date/Time</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Restoration Date/Time</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Failure Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($breakdownRecords as $record)
                                                    <tr>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->tripping_no ?? 'N/A' }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->source ?? 'N/A' }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->tripping_point ?? 'N/A' }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->tripping_date_time ? \Carbon\Carbon::parse($record->tripping_date_time)->format('Y-m-d H:i') : 'N/A' }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->restoration_date_time ? \Carbon\Carbon::parse($record->restoration_date_time)->format('Y-m-d H:i') : 'N/A' }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $record->failure_mode ?? 'N/A' }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <a 
                                href="{{ route('substation edit', $substation) }}" 
                                class="btn btn-outline-warning">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button 
                                wire:click="delete({{ $substation->id }})"
                                class="btn btn-outline-danger"
                                onclick="return confirm('Are you sure?') || event.stopImmediatePropagation()">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
