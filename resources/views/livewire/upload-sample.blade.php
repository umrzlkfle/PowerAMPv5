

<div class="p-6 bg-white rounded shadow-md w-full max-w-md mx-auto">
    <h2 class="text-lg font-semibold mb-4">Upload Excel File</h2>

    @if (session()->has('message'))
        <div class="p-2 mb-4 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="upload">
        <input type="file" wire:model="excelFile" class="mb-3" accept=".xls,.xlsx" />
        
        @error('excelFile') 
            <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload
        </button>
    </form>
</div>
