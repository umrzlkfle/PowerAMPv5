<main class="main-content">
    <div class="container-fluid py-4">
        {{-- Summary Dashboard --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-primary shadow-primary border-0 rounded-lg">
                    <div class="card-body p-3">
                        <div class="text-white">
                            <h6 class="text-uppercase text-xs mb-2">Total Cables</h6>
                            <h2 class="mb-0 text-white">{{ $totalCables }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-success shadow-success border-0 rounded-lg">
                    <div class="card-body p-3">
                        <div class="text-white">
                            <h6 class="text-uppercase text-xs mb-2">Existing Cables</h6>
                            <h2 class="mb-0 text-white">{{ $activeCables }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card bg-gradient-warning shadow-warning border-0 rounded-lg">
                    <div class="card-body p-3">
                        <div class="text-white">
                            <h6 class="text-uppercase text-xs mb-2">Inactive Cables</h6>
                            <h2 class="mb-0 text-white">{{ $inactiveCables }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-gradient-secondary shadow-dark border-0 rounded-lg">
                    <div class="card-body p-3">
                        <div class="text-white">
                            <h6 class="text-uppercase text-xs mb-2">Inactive</h6>
                            <h2 class="mb-0 text-white">{{ $inactiveCables }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Bar --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-transparent shadow-none">
                    <div class="card-body p-0 d-flex justify-content-between">
                        <div class="d-flex gap-2">
                            <button
                                wire:click="refreshData"
                                class="btn btn-outline-dark d-flex align-items-center"
                                :disabled="$isRefreshing">
                                <span wire:loading.remove wire:target="refreshData">
                                    <i class="fas fa-sync-alt me-2"></i>
                                </span>
                                <span wire:loading wire:target="refreshData" class="me-2">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </span>
                                Refresh Data
                            </button>
                        </div>
                        <div class="d-flex gap-2">
                            <button
                                wire:click="exportData"
                                class="btn btn-outline-success d-flex align-items-center">
                                <i class="fas fa-file-export me-2"></i>
                                Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            {{-- Search Input --}}
                            <div class="flex-grow-1" style="min-width: 250px">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input
                                        wire:model.debounce.300ms="search" {{-- Real-time search with debounce --}}
                                        wire:keydown.enter="applyFilters" {{-- NEW: Triggers applyFilters on Enter --}}
                                        type="text"
                                        class="form-control"
                                        placeholder="Search substations, status, location, voltage...">
                                </div>
                            </div>
                            <div style="min-width: 180px">
                                <select
                                    wire:model="statusFilter"
                                    class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="Existing">Existing</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Maintenance">Maintenance</option>
                                </select>
                            </div>

                            <div style="min-width: 150px">
                                <select
                                    wire:model="voltageFilter"
                                    class="form-select">
                                    <option value="">All Voltages</option>
                                    @foreach($commonVoltageOptions as $voltage)
                                        <option value="{{ $voltage }}">{{ $voltage }} kV</option>
                                    @endforeach
                                </select>
                            </div>

                            <div style="width: 120px">
                                <select
                                    wire:model="perPage"
                                    class="form-select">
                                    <option value="5">5 per page</option>
                                    <option value="10">10 per page</option>
                                    <option value="15">15 per page</option>
                                    <option value="25">25 per page</option>
                                </select>
                            </div>
                            {{-- NEW: Apply Filters Button --}}
                            <div class="flex-shrink-0">
                                <button wire:click="applyFilters" class="btn btn-primary m-0 d-flex align-items-center">
                                    <i class="fas fa-filter me-2"></i> Apply Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Cables</h6>
                            <div class="text-muted text-sm">
                                Showing {{ $cables->firstItem() }} - {{ $cables->lastItem() }} of {{ $cables->total() }}
                            </div>
                        </div>
                    </div>

                    {{-- Loading Indicator --}}
                    <div wire:loading.class="d-block" wire:target="search, sortBy, perPage, statusFilter, voltageFilter" class="d-none">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="ms-3">Loading cables...</span>
                            </div>
                        </div>
                    </div>

                    <div wire:loading.class="d-none" wire:target="search, sortBy, perPage, statusFilter, voltageFilter" class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        {{-- Cable Label/Name --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer" wire:click="sortBy('label')">
                                            <div class="d-flex align-items-center">
                                                <span>Cable Label</span>
                                                @if($sortField === 'label')
                                                    <span class="ms-1">
                                                        @if($sortDirection === 'asc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                        {{-- From/To Info --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">From / To</th>
                                        {{-- Status --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer" wire:click="sortBy('status')">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span>Status</span>
                                                @if($sortField === 'status')
                                                    <span class="ms-1">
                                                        @if($sortDirection === 'asc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                        {{-- Voltage --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 cursor-pointer" wire:click="sortBy('voltage')">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span>Voltage</span>
                                                @if($sortField === 'voltage')
                                                    <span class="ms-1">
                                                        @if($sortDirection === 'asc')
                                                            <i class="fas fa-sort-up"></i>
                                                        @else
                                                            <i class="fas fa-sort-down"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                        {{-- Phasing --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phasing</th>
                                        {{-- Operational Area --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Operational Area</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cables as $cable)
                                    <tr class="cursor-pointer" onclick="window.location='{{ route('cable show', $cable) }}'">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $cable->label }}</h6>
                                                    <p class="text-xs text-secondary mb-0">CIRC ID: {{ $cable->circ_id ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($cable->FromToName)
                                                    {{ $cable->FromToName }}
                                                @elseif($cable->from_info && $cable->to_info)
                                                    {{ $cable->from_info }} to {{ $cable->to_info }}
                                                @else
                                                    <span class="text-muted">From/To info missing</span>
                                                @endif
                                            </p>
                                            <p class="text-xs text-secondary mb-0">
                                                @if($cable->SubstationLabel)
                                                    Substation: {{ $cable->SubstationLabel }}
                                                @elseif($cable->FromLabel || $cable->ToLabel)
                                                    {{ $cable->FromLabel }} / {{ $cable->ToLabel }}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @php
                                                $statusConfig = [
                                                    'Existing' => ['color' => 'success', 'icon' => 'check-circle'],
                                                    'Inactive' => ['color' => 'secondary', 'icon' => 'times-circle'],
                                                    'Abandoned' => ['color' => 'warning', 'icon' => 'tools'],
                                                ];
                                                $status = $cable->status ?? 'Unknown';
                                                $config = $statusConfig[$status] ?? ['color' => 'dark', 'icon' => 'question-circle'];
                                            @endphp
                                            <span class="badge bg-gradient-{{ $config['color'] }} d-inline-flex align-items-center">
                                                <i class="fas fa-{{ $config['icon'] }} me-1"></i>
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $cable->voltage }} kV</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $cable->phasing ?? 'N/A' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $cable->op_area }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a
                                                href="{{ route('cable show', $cable) }}"
                                                class="text-primary font-weight-bold text-xs"
                                                data-toggle="tooltip"
                                                title="View details">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('assets/img/illustrations/no-data.png') }}" alt="No data" class="w-5 mb-4">
                                                <h5 class="mb-2">No cables found</h5>
                                                <p class="text-sm text-muted mb-3">
                                                    Try adjusting your search or filter parameters
                                                </p>
                                                @if($search || $statusFilter || $voltageFilter)
                                                <button
                                                    wire:click="resetFilters"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Reset Filters
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4 py-3 d-flex justify-content-between align-items-center">
                            <div class="text-muted text-sm">
                                Showing {{ $cables->firstItem() }} - {{ $cables->lastItem() }} of {{ $cables->total() }}
                            </div>
                            <div class="pagination pt-5">
                                {{ $cables->links('livewire::bootstrap') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
