<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Download Data Tables</h6>
                    </div>
                    <p class="text-sm mb-0">Click on any table to download</p>
                </div>
                <div class="card-body">
                    <!-- Table Selection Cards -->
                    <div class="row">
                        <!-- Substations Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('substations')">
                                <div class="card-body text-center">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md mb-3">
                                        <i class="fas fa-bolt text-lg opacity-10"></i>
                                    </div>
                                    <h6 class="mb-3">Substations</h6>
                                    <p class="text-sm text-muted">{{ $counts['substations'] }} records</p>
                                    <div wire:loading wire:target="downloadTable('substations')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cables Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('cables')">
                                <div class="card-body text-center">
                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md mb-3">
                                        <i class="fas fa-network-wired text-lg opacity-10"></i>
                                    </div>
                                    <h6 class="mb-3">Cables</h6>
                                    <p class="text-sm text-muted">{{ $counts['cables'] }} records</p>
                                    <div wire:loading wire:target="downloadTable('cables')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assets Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('assets')">
                                <div class="card-body text-center">
                                    <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md mb-3">
                                        <i class="fas fa-boxes text-lg opacity-10"></i>
                                    </div>
                                    <h6 class="mb-3">Assets</h6>
                                    <p class="text-sm text-muted">{{ $counts['assets'] }} records</p>
                                    <div wire:loading wire:target="downloadTable('assets')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Breakdown Records Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('breakdown_record')">
                                <div class="card-body text-center">
                                    <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md mb-3">
                                        <i class="fas fa-tools text-lg opacity-10"></i>
                                    </div>
                                    <h6 class="mb-3">Breakdown Records</h6>
                                    <p class="text-sm text-muted">{{ $counts['breakdown_record'] }} records</p>
                                    <div wire:loading wire:target="downloadTable('breakdown_record')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Records Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('maintenance_record')">
                                <div class="card-body text-center">
                                    <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md mb-3">
                                        <i class="fas fa-clipboard-check text-lg opacity-10"></i>
                                    </div>
                                    <h6 class="mb-3">Maintenance Records</h6>
                                    <p class="text-sm text-muted">{{ $counts['maintenance_record'] }} records</p>
                                    <div wire:loading wire:target="downloadTable('maintenance_record')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Format Selection -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="mb-3">Download Format:</h6>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="format" id="excel" autocomplete="off" 
                                    wire:model="format" value="xlsx" checked>
                                <label class="btn btn-outline-primary" for="excel">Excel (.xlsx)</label>

                                <input type="radio" class="btn-check" name="format" id="csv" autocomplete="off" 
                                    wire:model="format" value="csv">
                                <label class="btn btn-outline-primary" for="csv">CSV (.csv)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>