<x-layouts.app.sidebar :title="'Contacts List'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Contacts</h2>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

      <!-- Search Form -->
<form method="GET" action="{{ route('contacts.index') }}" class="mb-4">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search by name, job title, or organization..."
        class="w-full lg:w-1/2 px-4 py-2 border border-zinc-600 rounded-md bg-zinc-800 text-white placeholder-zinc-400 focus:outline-none focus:ring focus:ring-blue-400"
    >
</form>


        <!-- Contacts Table -->
        <div class="overflow-x-auto rounded-lg shadow border border-zinc-700">
            <table class="table-auto w-full text-sm text-left text-zinc-200 dark:text-zinc-300">
                <thead class="bg-zinc-800 text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Job Title</th>
                        <th class="px-4 py-3">Organization</th>
                        <th class="px-4 py-3">Primary?</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="border-t border-zinc-700 hover:bg-zinc-900 transition">
                            <td class="px-4 py-2">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td class="px-4 py-2">{{ $contact->job_title ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $contact->organization->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                @if($contact->is_primary_contact)
                                    <span class="text-green-500 font-semibold">Yes</span>
                                @else
                                    <span class="text-gray-400">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $contact->email ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $contact->mobile_phone_number ?? $contact->office_phone_number ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if($contact->is_active)
                                    <span class="text-green-500 font-semibold">Active</span>
                                @else
                                    <span class="text-gray-400">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-500 hover:underline">Edit</a>

                                <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}" onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-400">No contacts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
    {{ $contacts->appends(request()->query())->links('pagination::tailwind') }}
</div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $contacts->links('pagination::tailwind') }}
        </div>  <!-- Add Contact Button -->
        <div class="mb-4">
            <a href="{{ route('contacts.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                + Add Contact
            </a>
        </div>
    </div>
</x-layouts.app.sidebar>
