<x-layouts.app.sidebar :title="'Add New Contact'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Create Contact</h2>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST" class="space-y-4 text-white">
            @csrf

            <!-- Organization -->
            <div>
                <label for="organization_id" class="block mb-1">Organization <span class="text-red-500">*</span></label>
                <select name="organization_id" id="organization_id" required class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                    <option value="">-- Select Organization --</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}" {{ old('organization_id') == $org->id ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- First Name -->
            <div>
                <label for="first_name" class="block mb-1">First Name <span class="text-red-500">*</span></label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block mb-1">Last Name <span class="text-red-500">*</span></label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Job Title -->
            <div>
                <label for="job_title" class="block mb-1">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Department -->
            <div>
                <label for="department" class="block mb-1">Department</label>
                <input type="text" name="department" id="department" value="{{ old('department') }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Phone Numbers -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label for="office_phone_number" class="block mb-1">Office Phone</label>
                    <input type="text" name="office_phone_number" id="office_phone_number" value="{{ old('office_phone_number') }}"
                           class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                </div>

                <div class="w-full">
                    <label for="mobile_phone_number" class="block mb-1">Mobile Phone</label>
                    <input type="text" name="mobile_phone_number" id="mobile_phone_number" value="{{ old('mobile_phone_number') }}"
                           class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="3"
                          class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">{{ old('notes') }}</textarea>
            </div>

            <!-- Status & Primary Contact -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Fix for Primary Contact -->
<input type="hidden" name="is_primary_contact" value="0">
<label class="inline-flex items-center space-x-2">
    <input type="checkbox" name="is_primary_contact" value="1"
        {{ old('is_primary_contact', $contact->is_primary_contact ?? false) ? 'checked' : '' }}>
    <span>Primary Contact</span>
</label>

<!-- Fix for Active Status -->
<input type="hidden" name="is_active" value="0">
<label class="inline-flex items-center space-x-2">
    <input type="checkbox" name="is_active" value="1"
        {{ old('is_active', $contact->is_active ?? true) ? 'checked' : '' }}>
    <span>Active</span>
</label>

            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                    Save Contact
                </button>
                <a href="{{ route('contacts.index') }}" class="ml-4 text-gray-400 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app.sidebar>
