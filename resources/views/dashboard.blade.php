<x-layouts.app :title="'Dashboard'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-white mb-6">Dashboard Overview</h2>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-zinc-800 rounded-xl p-4 shadow text-white">
                <h3 class="text-sm uppercase text-zinc-400">Organizations</h3>
                <p class="text-3xl font-bold">{{ $organizationCount }}</p>
            </div>
            <div class="bg-zinc-800 rounded-xl p-4 shadow text-white">
                <h3 class="text-sm uppercase text-zinc-400">Contacts</h3>
                <p class="text-3xl font-bold">{{ $contactCount }}</p>
            </div>
            <div class="bg-zinc-800 rounded-xl p-4 shadow text-white">
                <h3 class="text-sm uppercase text-zinc-400">Industries</h3>
                <p class="text-3xl font-bold">{{ $industryCount }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-zinc-800 p-4 rounded-xl">
                <h4 class="text-white mb-2">Organization Status</h4>
                <canvas id="orgStatusChart"></canvas>
            </div>
            <div class="bg-zinc-800 p-4 rounded-xl">
                <h4 class="text-white mb-2">Module Overview</h4>
                <canvas id="summaryChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const orgStatusCtx = document.getElementById('orgStatusChart').getContext('2d');
        const orgStatusChart = new Chart(orgStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    data: [{{ $activeOrganizations }}, {{ $inactiveOrganizations }}],
                    backgroundColor: ['#22c55e', '#f87171'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        const summaryCtx = document.getElementById('summaryChart').getContext('2d');
        const summaryChart = new Chart(summaryCtx, {
            type: 'bar',
            data: {
                labels: ['Organizations', 'Contacts', 'Industries'],
                datasets: [{
                    label: 'Total',
                    data: [{{ $organizationCount }}, {{ $contactCount }}, {{ $industryCount }}],
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>
    @endpush
</x-layouts.app>
