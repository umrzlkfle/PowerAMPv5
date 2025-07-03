<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Export Database Tables</h6>
                    </div>
                    <p class="text-sm mb-0">Select a table and a format to download its data.</p>
                </div>
                <div class="card-body">
                    <!-- Table Selection Cards -->
                    <div class="row">
                        <!-- Substations Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('substations')">
                                <div class="card-body text-center">
                                    <img src="{{ asset('assets/img/illustrations/power-plant.png') }}" alt="Folder Icon" style="width:48px; height:48px;" class="mb-2">
                                    <h6 class="mb-3">Substations</h6>
                                    <p class="text-sm text-muted">{{ $counts['substations'] ?? 0 }} records</p>
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
                                    <img src="{{ asset('assets/img/illustrations/wiring.png') }}" alt="Folder Icon" style="width:48px; height:48px;" class="mb-2">
                                    <h6 class="mb-3">Cables</h6>
                                    <p class="text-sm text-muted">{{ $counts['cables'] ?? 0 }} records</p>
                                    <div wire:loading wire:target="downloadTable('cables')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Breakdown Records Card -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 cursor-pointer" wire:click="downloadTable('breakdown_records')">
                                <div class="card-body text-center">
                                    <!-- Add the folder.png icon here -->
                                    <img src="{{ asset('assets/img/illustrations/folder.png') }}" alt="Folder Icon" style="width:48px; height:48px;" class="mb-2">
                                    <h6 class="mb-3">Breakdown Records</h6>
                                    <p class="text-sm text-muted">{{ $counts['breakdown_records'] ?? 0 }} records</p>
                                    <div wire:loading wire:target="downloadTable('breakdown_records')">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="ms-2">Preparing download...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Format Selection -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="mb-3">Download Format:</h6>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="format" id="excel" autocomplete="off" 
                                        wire:model.live="format" value="xlsx" checked>
                                    <label class="btn btn-outline-primary" for="excel">Excel (.xlsx)</label>

                                    <input type="radio" class="btn-check" name="format" id="csv" autocomplete="off" 
                                        wire:model.live="format" value="csv">
                                    <label class="btn btn-outline-primary" for="csv">CSV (.csv)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>