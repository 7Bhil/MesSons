<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    userName: String,
})
// Création du form avec useForm pour Inertia
const form = useForm({
    nom: '',
    fichier: null,
    couverture: null,
    auteur: ''
});
    form.auteur = props.userName
// Fonction d'envoi
function submit() {
    form.post(route('Enregistré'), {
        forceFormData: true, // important pour envoyer les fichiers
    });
}
</script>

<template>
    <Head title="Ajouter un son" />
    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gradient-to-r from-purple-600 to-blue-600 -mx-6 -mt-6 px-6 pt-6 pb-8 mb-6">
                <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                    </svg>
                    Ajouter un nouveau son
                </h2>
                <p class="text-purple-100 mt-2">Uploadez votre fichier audio avec ses métadonnées</p>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
                    <div class="p-8">
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-8">
                            <!-- Nom du son -->
                            <div class="group">
                                <label class=" text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    Nom du son
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.nom" 
                                    placeholder="Entrez le titre de votre son"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-colors duration-200 text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white"
                                />
                                <div v-if="form.errors.nom" class="mt-2 text-red-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                    {{ form.errors.nom }}
                                </div>
                            </div>

                            <!-- Fichier audio -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    Fichier audio
                                </label>
                                <div class="relative">
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-green-400 transition-colors duration-200 bg-gray-50 hover:bg-green-50">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <input 
                                            type="file" 
                                            @change="e => form.fichier = e.target.files[0]" 
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                            accept=".mp3,.wav" 
                                        />
                                        <p class="text-gray-600">
                                            <span class="font-medium text-green-600">Cliquez pour télécharger</span> ou glissez-déposez
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">MP3, WAV jusqu'à 50MB</p>
                                    </div>
                                </div>
                                <div v-if="form.errors.fichier" class="mt-2 text-red-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                    {{ form.errors.fichier }}
                                </div>
                            </div>

                            <!-- Image de couverture -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19M19,19H5V5H19M13.96,12.29L11.21,15.83L9.25,13.47L6.5,17H17.5L13.96,12.29Z"/>
                                    </svg>
                                    Image de couverture
                                </label>
                                <div class="relative">
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors duration-200 bg-gray-50 hover:bg-purple-50">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <input 
                                            type="file" 
                                            @change="e => form.couverture = e.target.files[0]" 
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                            accept="image/*" 
                                        />
                                        <p class="text-gray-600">
                                            <span class="font-medium text-purple-600">Cliquez pour télécharger</span> ou glissez-déposez
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG, GIF jusqu'à 10MB</p>
                                    </div>
                                </div>
                                <div v-if="form.errors.couverture" class="mt-2 text-red-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                    {{ form.errors.couverture }}
                                </div>
                            </div>

                            <!-- Auteur -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                    </svg>
                                    Artiste / Auteur
                                </label>
                                <input 
                                    type="text" 
                                    :disabled="true"
                                    :placeholder="`${form.auteur}`"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-0 transition-colors duration-200 text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white"
                                />
                                <div v-if="form.errors.auteur" class="mt-2 text-red-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                    </svg>
                                    {{ form.errors.auteur }}
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                <button 
                                    type="button" 
                                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors duration-200 flex items-center gap-2 font-medium"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Annuler
                                </button>
                                
                                <button 
                                    type="submit" 
                                    :disabled="form.processing"
                                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 flex items-center gap-2 font-semibold shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <svg v-if="!form.processing" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <svg v-else class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    {{ form.processing ? 'Enregistrement...' : 'Enregistrer le son' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>