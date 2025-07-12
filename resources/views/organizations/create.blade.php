<x-layouts.app.sidebar :title="'Add Organization'">
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Add Organization</h2>

        <form action="{{ route('organizations.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" required class="w-full border px-3 py-2" value="{{ old('name') }}">
            </div>

            <div>
                <label class="block font-medium">Industry</label>
                <!--<select name="industry_id" class="w-full border px-3 py-2">-->
                <select name="industry_id" class="w-full px-4 py-2 border border-zinc-600 rounded bg-zinc-800 text-white">   
                    <option value="">-- Select Industry --</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>
                            {{ $industry->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Website</label>
                <input type="url" name="website" class="w-full border px-3 py-2" value="{{ old('website') }}">
            </div>

            <div>
                <label class="block font-medium">Tax ID</label>
                <input type="text" name="tax_id" class="w-full border px-3 py-2" value="{{ old('tax_id') }}">
            </div>

            <div class="flex items-center">
               <!-- Fix for Active Status -->
            <input type="hidden" name="is_active" value="0">
            <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="is_active" value="1"
            {{ old('is_active', $contact->is_active ?? true) ? 'checked' : '' }}>
            <span>Active</span>
            </label>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('organizations.index') }}" class="ml-4 text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app.sidebar>
