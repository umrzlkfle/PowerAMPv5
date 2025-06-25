<div class="max-w-4xl p-4 bg-white rounded-2xl shadow-lg">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">Existing Substation Data</h2>
        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 text-indigo-600">
            {{ $existingSubstations->total() }} Substations
        </div>
    </div>

    {{-- Apply the border directly to the table for a border all around it --}}
    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-xl overflow-hidden">
        <thead class="bg-gray-50">
            <tr>
                {{-- New header for the 'No.' column --}}
                <th scope="col" class="px-3 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                    No.
                </th>
                @php
                    // Define the specific headers you want to display
                    $existingHeaders = [
                        'name',
                        'label',
                        'owner_name',
                        'functional_location',
                        'operational_area',
                        'category'
                    ];
                @endphp
                @foreach($existingHeaders as $header)
                    <th scope="col"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        {{ str_replace('_', ' ', Str::title($header)) }} {{-- Format header for readability --}}
                    </th>
                @endforeach
                {{-- Header for the 'Details' button --}}
                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($existingSubstations as $index => $substation)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    {{-- Numbering column --}}
                    <td class="px-3 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                        {{ ($existingSubstations->currentPage() - 1) * $existingSubstations->perPage() + $index + 1 }}
                    </td>
                    @foreach($existingHeaders as $header)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $substation->$header ?? '-' }}
                        </td>
                    @endforeach
                    {{-- Details Button Column --}}
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a
                            href="{{ route('substation.show', $substation->id) }}"
                            class="inline-flex items-center px-3 py-1.5 text-xs leading-4 font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150"
                            title="View details">
                            Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($existingHeaders) + 2 }}" {{-- +2 for 'No.' and 'Actions' columns --}}
                        class="px-3 py-4 text-center text-sm text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-3 h-3 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <span class="font-medium">No existing substation data to display.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination Controls for Existing Data --}}
    <div class="mt-6">
        {{ $existingSubstations->links('pagination::bootstrap-5') }}
    </div>
</div>