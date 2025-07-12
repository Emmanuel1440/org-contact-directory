<x-layouts.app.sidebar :title="'Organization Details'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">View Organization</h2>

        <div class="bg-zinc-800 rounded-lg p-6 shadow text-white">
            <p><strong>Name:</strong> {{ $organization->name }}</p>
            <p><strong>Industry:</strong> {{ $organization->industry->name ?? 'N/A' }}</p>
            <p><strong>Website:</strong>
                @if($organization->website)
                    <a href="{{ $organization->website }}" target="_blank" class="text-blue-400 hover:underline">
                        {{ $organization->website }}
                    </a>
                @else
                    N/A
                @endif
            </p>
            <p><strong>Status:</strong>
                @if($organization->is_active)
                    <span class="text-green-500 font-semibold">Active</span>
                @else
                    <span class="text-gray-400">Inactive</span>
                @endif
            </p>
        </div>

        <div class="mt-4 flex space-x-4">
            <a href="{{ route('organizations.edit', $organization->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded">Edit</a>
            <a href="{{ route('organizations.index') }}" class="bg-zinc-700 hover:bg-zinc-600 text-white font-semibold px-4 py-2 rounded">Back</a>
        </div>
    </div>
</x-layouts.app.sidebar>
