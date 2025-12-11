<script setup lang="ts">
import Input from '@/components/Input.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{ result?: { meters: number; kilometers: number } }>();

const form = useForm<{ latA: string; longA: string; latB: string; longB: string }>({
    latA: '',
    longA: '',
    latB: '',
    longB: '',
});

const submit = () => {
    form.post('/');
};
</script>

<template>
    <Head title="Geo Distance Calculator"></Head>
    <div class="flex min-h-screen items-center justify-center bg-gray-50 p-4">
        <div class="w-full max-w-2xl rounded-xl bg-white p-8 shadow-lg">
            <h1 class="mb-8 text-center text-3xl font-bold text-gray-800">Geo Distance Calculator</h1>

            <form @submit.prevent="submit">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div class="rounded-lg border border-blue-100 bg-blue-50 p-6">
                        <h2 class="mb-4 border-b border-blue-200 pb-2 text-xl font-bold text-blue-800">📍 Point A</h2>
                        <div class="flex flex-col gap-4">
                            <Input id="latA" label="Latitude" v-model="form.latA" :error="form.errors.latA" placeholder="52.227977" />
                            <Input id="longA" label="Longitude" v-model="form.longA" :error="form.errors.longA" placeholder="20.946015" />
                        </div>
                    </div>
                    <div class="rounded-lg border border-green-100 bg-green-50 p-6">
                        <h2 class="mb-4 border-b border-green-200 pb-2 text-xl font-bold text-green-800">📍 Point B</h2>
                        <div class="flex flex-col gap-4">
                            <Input id="latB" label="Latitude" v-model="form.latB" :error="form.errors.latB" placeholder="52.173793" />
                            <Input id="longB" label="Longitude" v-model="form.longB" :error="form.errors.longB" placeholder="20.831292" />
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full cursor-pointer rounded-lg bg-indigo-600 px-6 py-3 font-bold text-white hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ form.processing ? 'Calculating...' : 'Calculate Distance' }}
                </button>
            </form>

            <div v-if="result" class="mt-8 rounded border-indigo-500 bg-indigo-50 p-6 text-center">
                <p class="text-xs font-bold text-gray-600">DISTANCE</p>
                <p class="my-2 text-4xl font-extrabold text-indigo-900">{{ result.kilometers }} km</p>
                <p class="font-medium text-indigo-600">({{ result.meters }} m)</p>
            </div>
        </div>
    </div>
</template>
