<x-layouts.app.sidebar :title="'Edit Contact'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Update Contact</h2>

        @if($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="space-y-4 text-white">
            @csrf
            @method('PUT')

            <!-- Organization -->
            <div>
                <label for="organization_id" class="block mb-1">Organization <span class="text-red-500">*</span></label>
                <select name="organization_id" id="organization_id" required
                        class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}" {{ $contact->organization_id == $org->id ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- First & Last Name -->
            <div>
                <label for="first_name" class="block mb-1">First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $contact->first_name) }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <div>
                <label for="last_name" class="block mb-1">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $contact->last_name) }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Job Title / Department -->
            <div>
                <label for="job_title" class="block mb-1">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $contact->job_title) }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <div>
                <label for="department" class="block mb-1">Department</label>
                <input type="text" name="department" id="department" value="{{ old('department', $contact->department) }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}"
                       class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
            </div>

            <!-- Phone Numbers -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label for="office_phone_number" class="block mb-1">Office Phone</label>
                    <input type="text" name="office_phone_number" id="office_phone_number"
                           value="{{ old('office_phone_number', $contact->office_phone_number) }}"
                           class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                </div>
                <div class="w-full">
                    <label for="mobile_phone_number" class="block mb-1">Mobile Phone</label>
                    <input type="text" name="mobile_phone_number" id="mobile_phone_number"
                           value="{{ old('mobile_phone_number', $contact->mobile_phone_number) }}"
                           class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block mb-1">Notes</label>
                <textarea name="notes" id="notes" rows="3"
                          class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">{{ old('notes', $contact->notes) }}</textarea>
            </div>

            <!-- Checkboxes -->
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
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-6 py-2 rounded">
                    Update Contact
                </button>
                <a href="{{ route('contacts.index') }}" class="ml-4 text-gray-400 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app.sidebar>
