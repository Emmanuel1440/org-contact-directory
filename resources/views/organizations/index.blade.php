<x-layouts.app.sidebar :title="'Organizations List'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Organizations</h2>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('organizations.index') }}" class="mb-4">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, industry, or website..."
                class="w-full lg:w-1/2 px-4 py-2 border border-zinc-600 rounded-md bg-zinc-800 text-white placeholder-zinc-400 focus:outline-none focus:ring focus:ring-blue-400"
            >
        </form>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow border border-zinc-700">
            <table class="table-auto w-full text-sm text-left text-zinc-200 dark:text-zinc-300">
                <thead class="bg-zinc-800 text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Industry</th>
                        <th class="px-4 py-3">Website</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organizations as $org)
                        <tr class="border-t border-zinc-700 hover:bg-zinc-900 transition">
                            <td class="px-4 py-2">{{ $org->name }}</td>
                            <td class="px-4 py-2">{{ $org->industry->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                @if($org->website)
                                    <a href="{{ $org->website }}" class="text-blue-400 hover:underline" target="_blank">
                                        {{ $org->website }}
                                    </a>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($org->is_active)
                                    <span class="text-green-500 font-semibold">Active</span>
                                @else
                                    <span class="text-gray-400">Inactive</span>
                                @endif
                            </td>
                            <!-- Action buttons: View, Edit, Delete -->
                            <td class="px-4 py-2 flex space-x-2">
                                <!-- View -->
                                <a href="{{ route('organizations.show', $org->id) }}" class="text-blue-500 hover:underline">View</a>

                                <!-- Edit -->
                                <a href="{{ route('organizations.edit', $org->id) }}" class="text-yellow-500 hover:underline">Edit</a>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('organizations.destroy', $org->id) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-400">No organizations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        

        <!-- Pagination -->
        <div class="mt-4">
            {{ $organizations->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>        <a href="{{ route('organizations.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
    + Add Organization
</a>

</x-layouts.app.sidebar>
