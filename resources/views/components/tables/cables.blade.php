{{-- Existing Cable Data Table (from database) --}}
    {{-- This section will display data directly from the 'cables' table --}}
    <div class="max-w-full"> {{-- Added margin top for separation --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <h2 class="text-xl font-bold text-gray-800">Existing Cable Data</h2>
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 text-indigo-600">
                    {{ $this->existingCables->total() }} Cables
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
                                // Define the specific headers you want to display for Cables from the database
                                $dbCableHeaders = [
                                    'circ_id' => ['title' => 'Circ ID', 'width' => 'w-24'],
                                    'status' => ['title' => 'Status', 'width' => 'w-24'],
                                    'phasing' => ['title' => 'Phasing', 'width' => 'w-24'],
                                    'voltage' => ['title' => 'Voltage', 'width' => 'w-20'],
                                    'owner_type' => ['title' => 'Owner Type', 'width' => 'w-24'],
                                    'owner_name' => ['title' => 'Owner Name', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'from_info' => ['title' => 'From Info', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'to_info' => ['title' => 'To Info', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'label' => ['title' => 'Label', 'width' => 'w-20'],
                                    'op_area' => ['title' => 'Op Area', 'width' => 'w-24'], // Corresponds to 'Op Area'
                                    'SubstationLabel' => ['title' => 'Substation Label', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'FromToName' => ['title' => 'From To Name', 'width' => 'min-w-[150px] max-w-[200px]'],
                                    'FromLabel' => ['title' => 'From Label', 'width' => 'w-20'],
                                ];
                            @endphp
                            @foreach($dbCableHeaders as $key => $header)
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider {{ $header['width'] }}">
                                    {{ $header['title'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($this->existingCables as $index => $cable)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-3 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                                    {{ ($this->existingCables->currentPage() - 1) * $this->existingCables->perPage() + $index + 1 }}
                                </td>
                                @foreach(array_keys($dbCableHeaders) as $headerKey)
                                    <td class="px-4 py-4 text-sm text-gray-600 truncate max-w-xs">
                                        {{ $cable->$headerKey ?? '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($dbCableHeaders) + 1 }}"
                                    class="px-3 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-4">
                                        <svg class="w-4 h-4 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="font-medium">No existing cable data to display.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Controls for Existing Cables --}}
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $this->existingCables->links('livewire::bootstrap') }}
            </div>
        </div>
    </div>