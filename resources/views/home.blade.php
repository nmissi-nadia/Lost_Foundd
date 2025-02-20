<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{
        searchQuery: '',
        selectedCategory: 'all',
        selectedType: 'all',
        showFilters: false,
        items: [
            {
                id: 1,
                type: 'lost',
                title: 'Téléphone iPhone perdu',
                description: 'iPhone 13 Pro noir perdu vers la gare',
                category: 'electronics',
                date: '2024-02-15',
                location: 'Gare Centrale',
                image: '/api/placeholder/300/200',
                contact: 'john@email.com',
                phone: '0123456789'
            },
            {
                id: 2,
                type: 'found',
                title: 'Clés trouvées',
                description: 'Trousseau de clés avec porte-clés rouge',
                category: 'keys',
                date: '2024-02-16',
                location: 'Parc Municipal',
                image: '/api/placeholder/300/200',
                contact: 'jane@email.com',
                phone: '0987654321'
            }
        ]
    }">
        <!-- Header avec barre de recherche -->
        <header class="bg-white shadow-md py-4 mb-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h1 class="text-2xl font-bold text-blue-600">Lost & Found</h1>
                    
                    <div class="flex-1 max-w-2xl">
                        <div class="relative">
                            <input 
                                type="text" 
                                x-model="searchQuery"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Rechercher un objet..."
                            >
                        </div>
                    </div>

                    <button 
                        @click="showFilters = !showFilters"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                    >
                        Filtres
                    </button>
                </div>

                <!-- Filtres -->
                <div x-show="showFilters" x-transition class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <select 
                                x-model="selectedType"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="all">Tous</option>
                                <option value="lost">Objets perdus</option>
                                <option value="found">Objets trouvés</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select 
                                x-model="selectedCategory"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="all">Toutes</option>
                                <option value="electronics">Électronique</option>
                                <option value="keys">Clés</option>
                                <option value="clothing">Vêtements</option>
                                <option value="documents">Documents</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4">
            <!-- Statistiques -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total des annonces</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        <span x-text="items.length"></span>
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Objets perdus</h3>
                    <p class="text-2xl font-bold text-red-600">
                        <span x-text="items.filter(item => item.type === 'lost').length"></span>
                    </p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Objets trouvés</h3>
                    <p class="text-2xl font-bold text-green-600">
                        <span x-text="items.filter(item => item.type === 'found').length"></span>
                    </p>
                </div>
            </div>

            <!-- Grid des annonces -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="item in items.filter(item => {
                    const matchesSearch = item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                                        item.description.toLowerCase().includes(searchQuery.toLowerCase());
                    const matchesType = selectedType === 'all' || item.type === selectedType;
                    const matchesCategory = selectedCategory === 'all' || item.category === selectedCategory;
                    return matchesSearch && matchesType && matchesCategory;
                })" :key="item.id">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img :src="item.image" :alt="item.title" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-semibold" x-text="item.title"></h2>
                                <span 
                                    class="px-2 py-1 text-sm rounded-full"
                                    :class="item.type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'"
                                    x-text="item.type === 'lost' ? 'Perdu' : 'Trouvé'"
                                ></span>
                            </div>
                            <p class="text-gray-600 mb-2" x-text="item.description"></p>
                            <div class="text-sm text-gray-500">
                                <p><span class="font-semibold">Lieu:</span> <span x-text="item.location"></span></p>
                                <p><span class="font-semibold">Date:</span> <span x-text="item.date"></span></p>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button 
                                    class="flex-1 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                                    x-text="item.type === 'lost' ? 'Je l\'ai trouvé!' : 'C\'est à moi!'"
                                >
                                </button>
                                <button 
                                    class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-50 transition"
                                >
                                    Commenter
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <button class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Précédent
                    </button>
                    <button class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-blue-600">
                        1
                    </button>
                    <button class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Suivant
                    </button>
                </nav>
            </div>
        </main>
    </div>
</body>
</html>