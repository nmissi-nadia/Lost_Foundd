<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une annonce - Lost & Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{
        type: 'lost',
        imagePreview: null,

        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }">
        <div class="min-h-screen py-8">
            <div class="container mx-auto px-4">
                <!-- En-tête -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Publier une annonce</h1>
                    <p class="mt-2 text-gray-600">Remplissez les informations ci-dessous pour publier votre annonce</p>
                </div>

                <!-- Formulaire -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <form method="POST" action="/annonce/publier" enctype="multipart/form-data" class="space-y-6">
                        <!-- Token CSRF -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <!-- Type d'annonce -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Type d'annonce</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="type" value="lost" class="form-radio text-blue-600" checked>
                                    <span class="ml-2">Objet perdu</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="type" value="found" class="form-radio text-blue-600">
                                    <span class="ml-2">Objet trouvé</span>
                                </label>
                            </div>
                        </div>

                        <!-- Titre -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Titre de l'annonce</label>
                            <input 
                                type="text" 
                                name="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description détaillée</label>
                            <textarea 
                                name="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            ></textarea>
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select 
                                name="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="electronics">Électronique</option>
                                <option value="clothing">Vêtements</option>
                                <option value="documents">Documents</option>
                                <option value="keys">Clés</option>
                                <option value="accessories">Accessoires</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>

                        <!-- Date et Lieu -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date</label>
                                <input 
                                    type="date" 
                                    name="date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lieu</label>
                                <input 
                                    type="text" 
                                    name="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Photo de l'objet (optionnel)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <template x-if="!imagePreview">
                                        <div>
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                    <span>Télécharger une photo</span>
                                                    <input type="file" name="image" class="sr-only" @change="handleImageUpload" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG jusqu'à 5MB</p>
                                        </div>
                                    </template>
                                    <template x-if="imagePreview">
                                        <div class="relative">
                                            <img :src="imagePreview" class="max-h-48 mx-auto">
                                            <button 
                                                @click="imagePreview = null" 
                                                type="button"
                                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Informations de contact -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Informations de contact</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input 
                                        type="email" 
                                        name="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                    <input 
                                        type="tel" 
                                        name="phone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Bouton -->
                        <div>
                            <button 
                                type="submit"
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700"
                            >
                                Publier l'annonce
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
