<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'annonce - Lost & Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
 
        <div class="min-h-screen py-8">
            <div class="container mx-auto px-4">
                <!-- Fil d'Ariane -->
                <nav class="mb-8">
                    <ol class="flex items-center space-x-2 text-gray-600">
                        <li><a href="dashboard" class="hover:text-blue-600">Accueil</a></li>
                        <li class="flex items-center space-x-2">
                            <span>/</span>
                            <a href="#" class="hover:text-blue-600">Annonces</a>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span>/</span>
                            <span class="text-gray-900" x-text="announcement.title"></span>
                        </li>
                    </ol>
                </nav>

                <!-- Contenu Principal -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Colonne Gauche - Image et Détails -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Statut et Actions -->
                        <div class="flex justify-between items-center">
                            <span 
                                class="px-3 py-1 rounded-full text-sm font-medium"
                                :class="announcement.type === 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'"
                                x-text="announcement.type === 'lost' ? 'Objet Perdu' : 'Objet Trouvé'"
                            ></span>
                            <button class="text-gray-500 hover:text-gray-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Image -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img :src="announcement.image" :alt="announcement.title" class="w-full h-96 object-cover">
                        </div>

                        <!-- Informations détaillées -->
                        <div class="bg-white rounded-lg shadow-lg p-6 space-y-4">
                            <h1 class="text-2xl font-bold text-gray-900" x-text="announcement.title"></h1>
                            
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span x-text="announcement.date"></span>
                                </span>
                                <span class="flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span x-text="announcement.location"></span>
                                </span>
                            </div>

                            <div class="prose max-w-none" x-text="announcement.description"></div>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-4 pt-4">
                                <button 
                                    @click="showContactInfo = !showContactInfo"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                                >
                                    Contacter l'annonceur
                                </button>
                                <button 
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition"
                                    x-text="announcement.type === 'lost' ? 'Je l\'ai trouvé!' : 'C\'est à moi!'"
                                >
                                </button>
                            </div>
                        </div>

                        <!-- Informations de contact (Modal) -->
                        <div 
                            x-show="showContactInfo" 
                            @click.away="showContactInfo = false"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center"
                            style="display: none;"
                        >
                            <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold">Informations de contact</h3>
                                    <button @click="showContactInfo = false" class="text-gray-500 hover:text-gray-700">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-3">
                                    <p><span class="font-semibold">Nom:</span> <span x-text="announcement.contact.name"></span></p>
                                    <p><span class="font-semibold">Email:</span> <span x-text="announcement.contact.email"></span></p>
                                    <p><span class="font-semibold">Téléphone:</span> <span x-text="announcement.contact.phone"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Section Commentaires -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-xl font-semibold mb-4">Commentaires</h2>
                            
                            <!-- Formulaire de commentaire -->
                            <div class="mb-6">
                                <form @submit.prevent="submitComment" class="space-y-3">
                                    <textarea 
                                        x-model="newComment"
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        rows="3"
                                        placeholder="Ajouter un commentaire..."
                                    ></textarea>
                                    <button 
                                        type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                                    >
                                        Publier
                                    </button>
                                </form>
                            </div>

                            <!-- Liste des commentaires -->
                            <div class="space-y-4">
                                <template x-for="comment in announcement.comments" :key="comment.id">
                                    <div class="flex space-x-4">
                                        <img :src="comment.avatar" :alt="comment.author" class="w-10 h-10 rounded-full">
                                        <div class="flex-1">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex justify-between items-start mb-1">
                                                    <span class="font-medium" x-text="comment.author"></span>
                                                    <span class="text-sm text-gray-500" x-text="comment.date"></span>
                                                </div>
                                                <p class="text-gray-700" x-text="comment.content"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne Droite - Informations complémentaires -->
                    <div class="space-y-6">
                        <!-- Carte de l'auteur -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Publié par</h3>
                            <div class="flex items-center space-x-4">
                                <img :src="announcement.author.avatar" :alt="announcement.author.name" class="w-12 h-12 rounded-full">
                                <div>
                                    <p class="font-medium" x-text="announcement.author.name"></p>
                                    <p class="text-sm text-gray-500" x-text="announcement.author.date"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Annonces similaires -->
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Annonces similaires</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <img src="/api/placeholder/100/100" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h4 class="font-medium">iPhone 12 trouvé</h4>
                                        <p class="text-sm text-gray-500">Trouvé près de la gare</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <img src="/api/placeholder/100/100" class="w-20 h-20 object-cover rounded">
                                    <div>
                                        <h4 class="font-medium">Samsung Galaxy perdu</h4>
                                        <p class="text-sm text-gray-500">Perdu dans le bus</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>