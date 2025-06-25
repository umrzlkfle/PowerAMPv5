<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Substation Map & List</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h6>Substation Locations</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div id="map"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h6>Substation List</h6>
                                    </div>
                                    <div class="card-body p-3" style="max-height: 500px; overflow-y: auto;">
                                        <ul class="list-group">
                                            @forelse ($substations as $substation)
                                                <li class="list-group-item d-flex justify-content-between align-items-center mb-2 border-radius-lg bg-gradient-light shadow-sm"
                                                    wire:click="selectSubstation({{ $substation->id }})" style="cursor:pointer;">
                                                    <div>
                                                        <h6 class="mb-0 text-sm">{{ $substation->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">ID: {{ $substation->substation_id }}</p>
                                                    </div>
                                                    <i class="fas fa-map-marker-alt text-primary opacity-10"></i>
                                                </li>
                                            @empty
                                                <li class="list-group-item">No substations found.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('livewire:initialized', () => {
        const map = L.map('map').setView([3.140853, 101.693207], 10); // Default view (Kuala Lumpur, Malaysia)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let currentMarker = null;

        // Listen for the 'substationSelected' event from Livewire
        Livewire.on('substationSelected', ({ latitude, longitude, name }) => {
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            const latLng = [latitude, longitude];
            currentMarker = L.marker(latLng).addTo(map)
                .bindPopup(name)
                .openPopup();

            map.setView(latLng, 15); // Zoom in when a substation is selected
        });

        // Initialize markers for all substations on load (optional, but good for initial view)
        @if ($substations)
            @foreach ($substations as $substation)
                @if ($substation->latitude && $substation->longitude)
                    L.marker([{{ $substation->latitude }}, {{ $substation->longitude }}])
                        .addTo(map)
                        .bindPopup("{{ $substation->name }}");
                @endif
            @endforeach
        @endif
    });
</script>