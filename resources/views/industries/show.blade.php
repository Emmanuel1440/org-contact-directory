<x-layouts.app.sidebar :title="'Industry Details'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-white mb-4">{{ $industry->name }}</h2>

        <div class="space-y-4 text-white">
            <!-- Description -->
            <div>
                <strong>Description:</strong>
                <p class="text-zinc-300 mt-1">
                    {{ $industry->description ?? 'N/A' }}
                </p>
            </div>

            <!-- Status -->
            <div>
                <strong>Status:</strong>
                <span class="{{ $industry->is_active ? 'text-green-400' : 'text-gray-400' }}">
                    {{ $industry->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <!-- Created -->
            <div>
                <strong>Created At:</strong>
                <span class="text-zinc-400">{{ $industry->created_at->format('d M Y, h:i A') }}</span>
            </div>

            <!-- Updated -->
            <div>
                <strong>Last Updated:</strong>
                <span class="text-zinc-400">{{ $industry->updated_at->format('d M Y, h:i A') }}</span>
            </div>

            <!-- Back Button -->
            <div>
                <a href="{{ route('industries.index') }}"
                   class="inline-block mt-4 bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app.sidebar>
