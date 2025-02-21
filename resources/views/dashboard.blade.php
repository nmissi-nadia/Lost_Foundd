<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <title>Lost & Found</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
            <body class="bg-gray-100">
            <div x-data="{ showFilters: false, selectedType: 'all', selectedCategory: 'all', searchQuery: '' }">
                <!-- Header avec barre de recherche -->
                <header class="bg-white shadow-md py-4 mb-6">
                <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
                    <div class="container mx-auto px-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <h1 class="text-2xl font-bold text-blue-600">Lost & Found</h1>
                            <div class="flex-1 max-w-2xl">
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="search" value="{{ request('search') }}" 
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Rechercher un objet..."
                                    >
                                </div>
                            </div>
                            <a 
                                href="/annonce/create"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                            >
                                Creer Annonce
                            </a>
                            <button 
                                click="showFilters()"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                            >
                                Filtres
                            </button>
                        </div>

                        <!-- Filtres -->
                        <div id="showFilters" x-transition class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <<!-- Filtre par type -->
                                <div>
                                    <select name="type" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Tous</option>
                                        <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Objets perdus</option>
                                        <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Objets trouvés</option>
                                    </select>
                                </div>

                                <!-- Filtre par catégorie -->
                                <div>
                                    <select name="categorie" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="all">Toutes</option>
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                                {{ $categorie->categorie }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Tri -->
                                <div>
                                    <select name="sort" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Plus récent</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus ancien</option>
                                    </select>
                                </div>
                                <div class="flex justify-between items-center">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Filtrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </header>

                <!-- Contenu principal -->
                <main class="container mx-auto px-4">
                    <!-- Statistiques -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Total des annonces</h3>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ $annonces->total() }}
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Objets perdus</h3>
                            <p class="text-2xl font-bold text-red-600">
                                {{ $annonces->where('type', 'lost')->count() }}
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Objets trouvés</h3>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $annonces->where('type', 'found')->count() }}
                            </p>

                        </div>
                    </div>

                    <!-- Grid des annonces -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($annonces as $annonce)
                            <a href="annonce/details/{{$annonce->id}}" class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($annonce->photo)
                                    <img src="{{ Storage::url($annonce->photo) }}" alt="{{ $annonce->titre }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">Pas d'image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">{{ $annonce->titre }}</h3>
                                    <p class="text-gray-600 mb-2">{{ Str::limit($annonce->description, 100) }}</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span>{{ $annonce->lieu }}</span>
                                        <span>{{ \Carbon\Carbon::parse($annonce->date_perdu_trouve)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="px-2 py-1 bg-{{ $annonce->type == 'lost' ? 'red' : 'green' }}-100 text-{{ $annonce->type == 'lost' ? 'red' : 'green' }}-800 rounded-full text-sm">
                                            {{$annonce->type }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $annonce->categorie->nom }}
                                        </span>
                                    </div>
                                    <!-- Bouton de suppression -->
                                    <form action="{{ route('annonce.destroy', $annonce->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-100 text-white rounded hover:bg-red-600 transition">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $annonces->links() }}
                    </div>
                </main>
            </div>
            </body>
        </div>
    </div>
    <script>
        function showFilters() {
            const filters = document.getElementById('showFilters');
            filters.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
