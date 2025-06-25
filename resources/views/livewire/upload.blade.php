<div class="main-content">
    <div class="page-header min-height-300 border-radius-xl mt-4 bg-gray-200">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        CSV Upload Center
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Select the type of data you want to upload
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CSV Upload Sections -->
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Section 1 -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Substations Data</h6>
                    </div>
                    <div class="card-body pt-4 p-3 d-flex flex-column">
                        <p class="text-sm mb-4">
                            Upload a CSV file containing substations information including names, locations, and capacities.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('download.template', ['filename' => '1-PPU-SSU_template.csv']) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-download me-2"></i>Download Template
                            </a>                                
                            <a href="{{ route('substations import') }}" class="btn bg-gradient-primary w-100">
                                Upload Substations CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section 2 -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Cables Data</h6>
                    </div>
                    <div class="card-body pt-4 p-3 d-flex flex-column">
                        <p class="text-sm mb-4">
                            Upload a CSV file containing cables information including names, types, and lengths.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('download.template', ['filename' => '2-MVUG_template.csv']) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-download me-2"></i>Download Template
                            </a>                                
                            <a href="{{ route('cables import') }}" class="btn bg-gradient-primary w-100">
                                Upload Cables CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>