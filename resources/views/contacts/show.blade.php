<x-layouts.app.sidebar :title="'Contact Details'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">View Contact</h2>

        <div class="bg-zinc-800 rounded-lg p-6 shadow text-white space-y-4">
            <p><strong>Full Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
            <p><strong>Organization:</strong> {{ $contact->organization->name }}</p>
            <p><strong>Job Title:</strong> {{ $contact->job_title ?? 'N/A' }}</p>
            <p><strong>Department:</strong> {{ $contact->department ?? 'N/A' }}</p>
            <p><strong>Email:</strong>
                @if($contact->email)
                    <a href="mailto:{{ $contact->email }}" class="text-blue-400 hover:underline">
                        {{ $contact->email }}
                    </a>
                @else
                    <span class="text-gray-400">N/A</span>
                @endif
            </p>
            <p><strong>Office Phone:</strong> {{ $contact->office_phone_number ?? 'N/A' }}</p>
            <p><strong>Mobile Phone:</strong> {{ $contact->mobile_phone_number ?? 'N/A' }}</p>
            <p><strong>Primary Contact:</strong>
                @if($contact->is_primary_contact)
                    <span class="text-green-400 font-semibold">Yes</span>
                @else
                    <span class="text-gray-400">No</span>
                @endif
            </p>
            <p><strong>Status:</strong>
                @if($contact->is_active)
                    <span class="text-green-500 font-semibold">Active</span>
                @else
                    <span class="text-red-400 font-semibold">Inactive</span>
                @endif
            </p>
            @if($contact->notes)
                <p><strong>Notes:</strong> {{ $contact->notes }}</p>
            @endif
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded">
                Edit
            </a>
            <a href="{{ route('contacts.index') }}" class="bg-zinc-700 hover:bg-zinc-600 text-white font-semibold px-4 py-2 rounded">
                Back
            </a>
        </div>
    </div>
</x-layouts.app.sidebar>
