<x-layouts.app.sidebar :title="'Edit Industry'">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-white mb-4">Edit Industry</h2>

        <form action="{{ route('industries.update', $industry->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-white">Industry Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $industry->name) }}"
                    class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white"
                    required>
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-white">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="w-full px-4 py-2 rounded bg-zinc-800 border border-zinc-600 text-white">{{ old('description', $industry->description) }}</textarea>
                @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

           <!-- Status -->
           <div class="flex items-center space-x-2 mt-4">
           <input type="checkbox" id="is_active" name="is_active" value="1"
            {{ old('is_active', $industry->is_active) ? 'checked' : '' }}>
           <label for="is_active" class="text-white">Active</label>
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                    Update Industry
                </button>
                <a href="{{ route('industries.index') }}" class="ml-4 text-gray-300 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.app.sidebar>
