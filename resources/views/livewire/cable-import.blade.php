<div class="main-content">
    <div class="page-header min-height-300 border-radius-xl mt-4 bg-gradient-primary">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('assets/img/illustrations/power-plant.png') }}" alt="Cable icon" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Cables CSV Upload Center
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Upload your cable data in CSV format
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Requirements -->
    <div class="bg-gray-50 m-4 p-4 rounded-lg border border-gray-200">
        <h3 class="font-medium text-gray-800 mb-2">CSV Requirements</h3>
        <ul class="text-sm text-gray-600 list-disc pl-5 space-y-1">
            <li>File must be in CSV format with UTF-8 encoding</li>
            <li>First row should be the header with column names</li>
            <li>Required columns: <span class="font-mono bg-gray-100 px-1 rounded">Circ_ID</span>, <span class="font-mono bg-gray-100 px-1 rounded">Status</span></li>
            <li>Maximum file size: 10MB</li>
        </ul>
    </div>
    
    <!-- Main Content Area -->
    <div class="max-w-4xl m-4 p-4 bg-white rounded shadow">
        <form wire:submit.prevent="import" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload CSV File</label>
                <input type="file" wire:model="csv_cablefile" accept=".csv"
                    class="mt-1 block w-full border border-gray-300 rounded shadow-sm">
                @error('csv_cablefile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Progress bar --}}
            <div wire:loading wire:target="csv_cablefile" class="w-full bg-gray-200 rounded h-4 mb-4">
                <div class="h-4 bg-blue-500 rounded animate-pulse" style="width: 100%"></div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-gray-700 rounded hover:bg-blue-700 disabled:opacity-50"
                    wire:loading.attr="disabled">
                    Import CSV
                </button>
            </div>
        </form>
    </div>
{{-- Uploaded Rows Table (Preview of newly uploaded data) --}}
    @if (!empty($uploadedRows))
    <div class="max-w-full mx-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <h2 class="text-xl font-bold text-gray-800">Preview of Recently Uploaded Cable Data</h2>
                {{-- This count should reflect the actual number of uploaded rows if you want to display it --}}
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 text-indigo-600">
                    {{ count($uploadedRows) }} Cables Uploaded
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">
                                No.
                            </th>
                            @php
                                // Define the specific headers you want to display for Cables from the CSV
                                // These should correspond to the headers in your CSV and the data keys in $record
                                $cableHeaders = [
                                    'Circ_ID' => ['title' => 'Circ ID', 'width' => 'w-24'],
                                    'Status' => ['title' => 'Status', 'width' => 'w-24'],
                                    'Phasing' => ['title' => 'Phasing', 'width' => 'w-24'],
                                    'Voltage' => ['title' => 'Voltage', 'width' => 'w-20'],
                                    'Class' => ['title' => 'Class', 'width' => 'w-20'],
                                    'Owner_Type' => ['title' => 'Owner Type', 'width' => 'w-24'],
                                    'Owner_Name' => ['title' => 'Owner Name', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'From_Info' => ['title' => 'From Info', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'To_Info' => ['title' => 'To Info', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'Label' => ['title' => 'Label', 'width' => 'w-20'],
                                    'Op_Area' => ['title' => 'Op Area', 'width' => 'w-24'],
                                    'SubstationLabel' => ['title' => 'Substation Label', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'FromToName' => ['title' => 'From To Name', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'FromLabel' => ['title' => 'From Label', 'width' => 'w-20'],
                                    'ToLabel' => ['title' => 'To Label', 'width' => 'w-20'],
                                ];
                            @endphp
                            @foreach($cableHeaders as $key => $header)
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider {{ $header['width'] }}">
                                    {{ $header['title'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Use $paginatedRows for the uploaded data preview --}}
                        @forelse($this->paginatedRows as $index => $cable)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-3 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                                    {{ ($this->paginatedRows->currentPage() - 1) * $this->paginatedRows->perPage() + $index + 1 }}
                                </td>
                                @foreach(array_keys($cableHeaders) as $headerKey)
                                    <td class="px-4 py-4 text-sm text-gray-600 truncate max-w-xs">
                                        {{ $cable[$headerKey] ?? '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($cableHeaders) + 1 }}"
                                    class="px-3 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="font-medium">No recently uploaded cable data to display.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Controls for Uploaded Rows --}}
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $this->paginatedRows->links('livewire::bootstrap') }} {{-- Use tailwind theme as defined in component --}}
            </div>
        </div>
    </div>
    @endif
    
    {{-- Existing Substation Data Table --}}
    <div class="container-fluid py-4">
        @include('components.tables.cables')
    </div>


    {{-- SweetAlert2 for popup --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('import-success', () => {
            Swal.fire({
                title: 'Upload Successful!',
                text: 'CSV file has been imported and stored.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
</div>