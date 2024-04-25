<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    quotes: string[]
}>();

const error = ref<string>("");

const loading = ref<boolean>(false);

const quoteList = ref<string[]>(props.quotes);

const classes: string[] = ['Tomato', 'DodgerBlue', 'Orange', 'MediumSeaGreen', 'Violet'];

async function refreshQuotes() {
    loading.value = true;
    try {
        const response = await fetch(route('quote.api', { limit: 5 }));
        quoteList.value = await response.json();
        if (!quoteList.value.length) {
            throw new Error('');
        }
    }
    catch (e: any) {
        error.value = "No quotes found!";
        setTimeout(() => {
            error.value = "";
        }, 2000);
    }
    finally {
        loading.value = false;
    }
}
</script>
<style scoped>
.fade-move,
.fade-enter-active,
.fade-leave-active {
    transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: scaleX(0.01) translate(30px, 0);
}

.fade-leave-active {
    position: absolute;
}
</style>

<template>
    <div>

        <Head title="Kanye West's Quotes" />
        <div
            class="relative bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter min-h-screen dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="text-gray-300 p-4 text-2xl text-center border-b border-b-gray-700 mb-24">
                Kanye West's Quotes
            </div>
            <div v-if="quoteList.length" class="sm:flex sm:justify-center sm:items-center ">
                <TransitionGroup tag="div" name="fade" id="quote-list"
                    class="relative quote-board w-full m-auto p-8 flex flex-col gap-y-12">
                    <div v-for="(quote, index) in quoteList" :key="index + Math.random()"
                        class="chat text-3xl px-8 w-9/12" :class="[index % 2 ? 'chat-end self-end' : 'chat-start']">
                        <div class="chat-bubble w-full pt-6 text-black"
                            :style="{ 'background-color': classes[index % 5] }">
                            {{ quote }}
                            <span class="block text-lg italic mb-2 mt-6">Kanye West</span>
                        </div>
                    </div>
                </TransitionGroup>
            </div>
            <div v-else class="w-auto flex justify-center">
                <div class="chat text-3xl px-8 w-1/2 chat-start">
                    <div class="chat-bubble w-full py-8 text-black text-center chat-bubble-error">No quotes found!
                    </div>
                </div>
            </div>
            <div class="mt-48 text-center">
                <button id="refresh-button" :disabled="loading" @click.prevent="refreshQuotes"
                    class=" btn btn-warning w-auto text-2xl px-16 h-20 min-w-60">
                    <span v-if="loading" class="loading loading-spinner"></span>
                    <span v-else>Refresh</span>
                </button>
            </div>
            <div v-show="error" class="toast toast-end">
                <div class="alert alert-error">
                    <span>{{ error }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
