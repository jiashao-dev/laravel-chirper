<script setup>
    import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
    import ChirpVue from '@/Components/Chirp.vue';
    import InputErrorVue from '@/Components/InputError.vue';
    import PrimaryButtonVue from '@/Components/PrimaryButton.vue';
    import { useForm, Head } from '@inertiajs/inertia-vue3';

    defineProps(['chirps']);

    const form = useForm({
        message: '',
    });
</script>

<template>
    <Head title="Chirps"></Head>

    <AuthenticatedLayoutVue>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('chirps.store'), { onSuccess: () => form.reset() })">
                <textarea 
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputErrorVue :message="form.errors.message" class="mt-2"></InputErrorVue>
                <PrimaryButtonVue class="mt-4">Chirp</PrimaryButtonVue>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <ChirpVue
                    v-for="chirp in chirps"
                    :key="chirp.id"
                    :chirp="chirp"
                ></ChirpVue>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>