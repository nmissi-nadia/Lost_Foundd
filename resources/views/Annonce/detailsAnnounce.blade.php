<x-app-layout>
    <nav aria-label="Breadcrumb" class="bg-gray-100 p-4 rounded-md shadow">
        <ol class="flex space-x-2">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Accueil</a></li>
            <li class="flex items-center space-x-2">
                <span>/</span>
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Annonces</a>
            </li>
            <li class="flex items-center space-x-2">
                <span>/</span>
                <span class="text-gray-900">{{ $annonce->titre }}</span>
            </li>
        </ol>
    </nav>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $annonce->titre }}</h1>
        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
            <span class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <!-- SVG content -->
                </svg>
                <span>{{ $annonce->lieu }}</span>
            </span>
        </div>
        <p class="text-gray-700 mb-4">{{ $annonce->description }}</p>

        <!-- Edit Button -->
        <div class="flex justify-end mt-4">
            <a href="{{ route('annonce.edit', $annonce->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Modifier l'annonce
            </a>
        </div>

        <!-- Section Commentaires -->
        <div class="bg-gray-50 rounded-lg shadow-lg p-6 mt-6">
            <h2 class="text-xl font-semibold mb-4">Commentaires</h2>
             <!-- Formulaire de commentaire -->
             <div class="mb-6">
                <form action="{{ route('commentaires.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea 
                        name="contenu"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        rows="3"
                        placeholder="Ajouter un commentaire..."
                        required></textarea>
                    <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Publier
                    </button>
                </form>
            </div>
            <div class="space-y-4">     
                @foreach ($annonce->commentaires as $commentaire)
                    <div class="flex space-x-4 bg-white p-4 rounded-lg shadow-sm">
                        <img src="{{ $commentaire->user->avatar }}" alt="{{ $commentaire->user->name }}" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-1">
                                <span class="font-medium">{{ $commentaire->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $commentaire->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $commentaire->contenu }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>