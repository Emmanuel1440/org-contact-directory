<x-layouts.app.sidebar :title="'Industry List'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Industries</h2>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        
        <!-- Filter Form -->
<form method="GET" action="{{ route('industries.index') }}" class="mb-4 flex flex-col md:flex-row gap-4 items-center">
    <input type="text" name="search" placeholder="Search industries..." value="{{ request('search') }}"
        class="px-4 py-2 w-full md:w-1/3 rounded bg-zinc-800 text-white border border-zinc-600 placeholder-zinc-400 focus:outline-none focus:ring">

    <select name="status" class="px-4 py-2 w-full md:w-1/4 rounded bg-zinc-800 text-white border border-zinc-600 focus:outline-none">
        <option value="">All Statuses</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
        Filter
    </button>
</form>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow border border-zinc-700">
            <table class="table-auto w-full text-sm text-left text-zinc-200 dark:text-zinc-300">
                <thead class="bg-zinc-800 text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($industries as $industry)
                        <tr class="border-t border-zinc-700 hover:bg-zinc-900 transition">
                            <td class="px-4 py-2">{{ $industry->name }}</td>
                            <td class="px-4 py-2">{{ $industry->description ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if($industry->is_active)
                                    <span class="text-green-500 font-semibold">Active</span>
                                @else
                                    <span class="text-gray-400">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('industries.show', $industry->id) }}" class="text-blue-400 hover:underline">View</a>
                                <a href="{{ route('industries.edit', $industry->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('industries.destroy', $industry->id) }}" onsubmit="return confirm('Delete this industry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-400">No industries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $industries->links('pagination::tailwind') }}
        </div><!-- Add Button -->
        <div class="mb-4">
            <a href="{{ route('industries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                + Add Industry
            </a>
        </div>
    </div>
</x-layouts.app.sidebar>
