<div class="p-4">
    <div class="flex flex-col md:flex-row gap-4 mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search organizations..."
               class="w-full md:w-1/2 px-4 py-2 border border-zinc-600 rounded-md bg-zinc-800 text-white placeholder-zinc-400 focus:outline-none focus:ring focus:ring-blue-400">

        <select wire:model="industryId"
                class="w-full md:w-1/4 px-4 py-2 border border-zinc-600 rounded-md bg-zinc-800 text-white focus:outline-none">
            <option value="">All Industries</option>
            @foreach($industries as $industry)
                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="overflow-x-auto rounded-lg shadow border border-zinc-700">
        <table class="table-auto w-full text-sm text-left text-zinc-200 dark:text-zinc-300">
            <thead class="bg-zinc-800 text-white uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Industry</th>
                    <th class="px-4 py-3">Website</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organizations as $org)
                    <tr class="border-t border-zinc-700 hover:bg-zinc-900 transition">
                        <td class="px-4 py-2">{{ $org->name }}</td>
                        <td class="px-4 py-2">{{ $org->industry->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ $org->website }}" class="text-blue-400 hover:underline" target="_blank">
                                {{ $org->website }}
                            </a>
                        </td>
                        <td class="px-4 py-2">
                            @if($org->is_active)
                                <span class="text-green-500 font-semibold">Active</span>
                            @else
                                <span class="text-gray-400">Inactive</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-400">No organizations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $organizations->links('pagination::tailwind') }}
    </div>
</div>
