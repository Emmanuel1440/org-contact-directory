<x-layouts.app :title="'Dashboard'">
    <div class="p-4 space-y-6">

        <h2 class="text-2xl font-semibold text-white">Dashboard Overview</h2>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-zinc-800 text-white p-4 rounded-lg shadow">
                <p class="text-sm text-zinc-400">Total Organizations</p>
                <h3 class="text-2xl font-bold">{{ $totalOrganizations }}</h3>
            </div>
            <div class="bg-green-800 text-white p-4 rounded-lg shadow">
                <p class="text-sm text-green-200">Active Organizations</p>
                <h3 class="text-2xl font-bold">{{ $activeOrganizations }}</h3>
            </div>
            <div class="bg-red-800 text-white p-4 rounded-lg shadow">
                <p class="text-sm text-red-200">Inactive Organizations</p>
                <h3 class="text-2xl font-bold">{{ $inactiveOrganizations }}</h3>
            </div>
            <div class="bg-blue-800 text-white p-4 rounded-lg shadow">
                <p class="text-sm text-blue-200">Total Contacts</p>
                <h3 class="text-2xl font-bold">{{ $totalContacts }}</h3>
            </div>
        </div>
   
        <div class="bg-zinc-900 rounded-lg shadow p-4 mt-6">
    <h3 class="text-lg font-bold text-white mb-2">Organizations per Industry</h3>
    <canvas id="industryChart" height="150"></canvas>
</div>


        <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex flex-wrap gap-4 items-end">
    <div>
        <label for="industry_id" class="block text-sm text-white">Filter by Industry</label>
        <select name="industry_id" id="industry_id" class="bg-zinc-800 text-white px-3 py-2 rounded">
            <option value="">-- All Industries --</option>
            @foreach($industries as $industry)
                <option value="{{ $industry->id }}" {{ $selectedIndustry == $industry->id ? 'selected' : '' }}>
                    {{ $industry->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="status" class="block text-sm text-white">Status</label>
        <select name="status" id="status" class="bg-zinc-800 text-white px-3 py-2 rounded">
            <option value="">-- All --</option>
            <option value="active" {{ $selectedStatus == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $selectedStatus == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Apply Filters
        </button>
    </div>
</form>

        <!-- Charts -->
        <div class="bg-zinc-800 p-4 rounded-lg shadow mt-6">
            <h4 class="text-white text-lg mb-4">Organizations by Industry</h4>
            <!-- <canvas id="industryChart" class="w-full h-20"></canvas> -->
        </div>
        <div class="mt-6 bg-zinc-900 rounded-lg p-4 shadow">
    <h3 class="text-lg font-bold text-white mb-2">Recently Added Organizations</h3>
    <ul class="divide-y divide-zinc-700">
        @forelse($recentOrganizations as $org)
            <li class="py-2 flex justify-between items-center">
                <div>
                    <span class="font-semibold text-white">{{ $org->name }}</span>
                    <span class="text-sm text-gray-400 ml-2">{{ $org->industry->name ?? 'Uncategorized' }}</span>
                </div>
                <span class="text-xs px-2 py-1 rounded-full 
                    {{ $org->is_active ? 'bg-green-600 text-white' : 'bg-gray-600 text-gray-300' }}">
                    {{ $org->is_active ? 'Active' : 'Inactive' }}
                </span>
            </li>
        @empty
            <li class="text-gray-400">No recent organizations.</li>
        @endforelse
    </ul>
</div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-zinc-800 p-4 rounded-lg shadow">
                <h4 class="text-white text-lg mb-3">Recent Organizations</h4>
                <ul class="divide-y divide-zinc-600">
                    @forelse($recentOrganizations as $org)
                        <li class="py-2 text-zinc-300">{{ $org->name }}</li>
                    @empty
                        <li class="py-2 text-zinc-400">No recent organizations.</li>
                    @endforelse
                </ul>
            </div>
            <div class="bg-zinc-800 p-4 rounded-lg shadow">
                <h4 class="text-white text-lg mb-3">Recent Contacts</h4>
                <ul class="divide-y divide-zinc-600">
                    @forelse($recentContacts as $contact)
                        <li class="py-2 text-zinc-300">
                            {{ $contact->first_name }} {{ $contact->last_name }}
                            <span class="text-sm text-zinc-500">({{ $contact->organization->name ?? 'N/A' }})</span>
                        </li>
                    @empty
                        <li class="py-2 text-zinc-400">No recent contacts.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

    @push('scripts')
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('industryChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($industriesSummary->pluck('name')) !!},
                    datasets: [{
                        label: 'Organizations',
                        data: {!! json_encode($industriesSummary->pluck('organizations_count')) !!},
                        backgroundColor: [
                            '#10B981', '#F59E0B', '#3B82F6', '#EF4444', '#8B5CF6', '#F472B6',
                        ],
                        borderColor: '#1f2937',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#e5e7eb' // Tailwind Zinc-200
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.app>
