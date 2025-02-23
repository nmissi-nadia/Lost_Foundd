<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Modifier l'annonce</h1>

        <form action="{{ route('annonce.update', $annonce->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" value="{{ $annonce->title }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">{{ $annonce->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ $annonce->location }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
                    <option value="lost" {{ $annonce->type === 'lost' ? 'selected' : '' }}>Objet Perdu</option>
                    <option value="found" {{ $annonce->type === 'found' ? 'selected' : '' }}>Objet Trouvé</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image (optional)</label>
                <input type="file" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
            </div>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Mettre à jour l'annonce
            </button>
        </form>
    </div>
</x-app-layout>