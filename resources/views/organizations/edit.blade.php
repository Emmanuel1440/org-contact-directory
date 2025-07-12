<x-layouts.app.sidebar :title="'Edit Organization'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-zinc-100 mb-4">Edit Organization</h2>

        <form action="{{ route('organizations.update', $organization->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-white mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $organization->name) }}"
                       class="w-full px-4 py-2 border border-zinc-600 rounded bg-zinc-800 text-white" required>
            </div>

            <div>
                <label class="block text-white mb-1">Industry</label>
                <select name="industry_id" class="w-full px-4 py-2 border border-zinc-600 rounded bg-zinc-800 text-white">
                    <option value="">-- Select Industry --</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry->id }}" {{ $organization->industry_id == $industry->id ? 'selected' : '' }}>
                            {{ $industry->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-white mb-1">Website</label>
                <input type="url" name="website" value="{{ old('website', $organization->website) }}"
                       class="w-full px-4 py-2 border border-zinc-600 rounded bg-zinc-800 text-white">
            </div>

            <div>
              <!-- Fix for Active Status -->
             <input type="hidden" name="is_active" value="0">
             <label class="inline-flex items-center space-x-2">
             <input type="checkbox" name="is_active" value="1"
              {{ old('is_active', $contact->is_active ?? true) ? 'checked' : '' }}>
             <span>Active</span>
             </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Update</button>
                <a href="{{ route('organizations.index') }}" class="bg-zinc-700 hover:bg-zinc-600 text-white font-semibold px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app.sidebar>
