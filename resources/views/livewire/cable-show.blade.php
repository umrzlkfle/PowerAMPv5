<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Cable Details</h5>
                        <a href="{{ route('cables') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Cable List
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
                                        <span class="text-muted">Cable Label:</span>
                                        <span class="fw-bold">{{ $cable->label }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">CIRC ID:</span>
                                        <span class="fw-bold">{{ $cable->circ_id ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge bg-gradient-{{
                                            $cable->status == 'Existing' ? 'success' :
                                            ($cable->status == 'Abandoned' ? 'warning' : 'secondary')
                                        }}">
                                            {{ $cable->status }}
                                        </span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Voltage Level:</span>
                                        <span class="fw-bold">{{ $cable->voltage }} kV</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Phasing:</span>
                                        <span class="fw-bold">{{ $cable->phasing ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Operational Area:</span>
                                        <span class="fw-bold">{{ $cable->op_area }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-uppercase text-xs text-muted mb-3">Ownership & Classification</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Owner Type:</span>
                                        <span class="fw-bold">{{ $cable->owner_type }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Owner Name:</span>
                                        <span class="fw-bold">{{ $cable->owner_name }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Class:</span>
                                        <span class="fw-bold">{{ $cable->class ?? 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Connection Information Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="border rounded p-3">
                                <h6 class="text-uppercase text-xs text-muted mb-3">Connection Information</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">From Info:</span>
                                        <span class="fw-bold">{{ $cable->from_info ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">To Info:</span>
                                        <span class="fw-bold">{{ $cable->to_info ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">From/To Name:</span>
                                        <span class="fw-bold">{{ $cable->FromToName ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">From Label:</span>
                                        <span class="fw-bold">{{ $cable->FromLabel ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">To Label:</span>
                                        <span class="fw-bold">{{ $cable->ToLabel ?? 'N/A' }}</span>
                                    </li>
                                    <li class="list-group-item px-0 py-1 d-flex justify-content-between">
                                        <span class="text-muted">Associated Substation:</span>
                                        <span class="fw-bold">{{ $cable->SubstationLabel ?? 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <a
                                href="{{ route('cable edit', $cable) }}"
                                class="btn btn-outline-warning">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button
                                wire:click="delete({{ $cable }})"
                                class="btn btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this cable?') || event.stopImmediatePropagation()">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
