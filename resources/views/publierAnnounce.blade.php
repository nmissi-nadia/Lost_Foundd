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
        title: '',
        description: '',
        category: '',
        date: '',
        location: '',
        imagePreview: null,
        contact: {
            email: '',
            phone: ''
        },
        errorMessages: {},
        
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        
        validateForm() {
            this.errorMessages = {};
            let isValid = true;
            
            if (!this.title.trim()) {
                this.errorMessages.title = 'Le titre est requis';
                isValid = false;
            }
            
            if (!this.description.trim()) {
                this.errorMessages.description = 'La description est requise';
                isValid = false;
            }
            
            if (!this.category) {
                this.errorMessages.category = 'La catégorie est requise';
                isValid = false;
            }
            
            if (!this.date) {
                this.errorMessages.date = 'La date est requise';
                isValid = false;
            }
            
            if (!this.location.trim()) {
                this.errorMessages.location = 'Le lieu est requis';
                isValid = false;
            }
            
            if (!this.contact.email.trim()) {
                this.errorMessages.email = 'L\'email est requis';
                isValid = false;
            }
            
            return isValid;
        },
        
        submitForm() {
            if (this.validateForm()) {
                // Ici, on simule l'envoi du formulaire
                console.log('Formulaire soumis', {
                    type: this.type,
                    title: this.title,
                    description: this.description,
                    category: this.category,
                    date: this.date,
                    location: this.location,
                    contact: this.contact
                });
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
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <!-- Type d'annonce -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Type d'annonce</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" x-model="type" value="lost" class="form-radio text-blue-600">
                                    <span class="ml-2">Objet perdu</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" x-model="type" value="found" class="form-radio text-blue-600">
                                    <span class="ml-2">Objet trouvé</span>
                                </label>
                            </div>
                        </div>

                        <!-- Titre -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Titre de l'annonce</label>
                            <input 
                                type="text" 
                                x-model="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{'border-red-500': errorMessages.title}"
                            >
                            <p x-show="errorMessages.title" x-text="errorMessages.title" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description détaillée</label>
                            <textarea 
                                x-model="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{'border-red-500': errorMessages.description}"
                            ></textarea>
                            <p x-show="errorMessages.description" x-text="errorMessages.description" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select 
                                x-model="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{'border-red-500': errorMessages.category}"
                            >
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="electronics">Électronique</option>
                                <option value="clothing">Vêtements</option>
                                <option value="documents">Documents</option>
                                <option value="keys">Clés</option>
                                <option value="accessories">Accessoires</option>
                                <option value="other">Autre</option>
                            </select>
                            <p x-show="errorMessages.category" x-text="errorMessages.category" class="mt-1 text-sm text-red-600"></p>
                        </div>

                        <!-- Date et Lieu -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date</label>
                                <input 
                                    type="date" 
                                    x-model="date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    :class="{'border-red-500': errorMessages.date}"
                                >
                                <p x-show="errorMessages.date" x-text="errorMessages.date" class="mt-1 text-sm text-red-600"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lieu</label>
                                <input 
                                    type="text" 
                                    x-model="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    :class="{'border-red-500': errorMessages.location}"
                                    placeholder="Ex: Gare centrale, Parc municipal..."
                                >
                                <p x-show="errorMessages.location" x-text="errorMessages.location" class="mt-1 text-sm text-red-600"></p>
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
                                                    <input type="file" class="sr-only" @change="handleImageUpload" accept="image/*">
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
                                        x-model="contact.email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        :class="{'border-red-500': errorMessages.email}"
                                    >
                                    <p x-show="errorMessages.email" x-text="errorMessages.email" class="mt-1 text-sm text-red-600"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Téléphone (optionnel)</label>
                                    <input 
                                        type="tel" 
                                        x-model="contact.phone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4 justify-end pt-4">
                            <button 
                                type="button"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                Annuler
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
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