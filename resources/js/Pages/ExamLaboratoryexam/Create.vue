<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';

import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    laboratoryexams: Object,
    exam: Object
});

const form = useForm({
    'laboratoryexam_id': '',
    'value': '',
});

const submit = () => {
    form.post(route('examLaboratoryexams.store', { exam: props.exam }));
};
</script>

<template>

    <AuthenticatedLayoutVue>

        <Head title="Meus Exames" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Exame Laboratorial
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="flex flex-col">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="laboratoryexam_id" value="Exame Laboratorial" required="true" />

                                <select name="laboratoryexam_id" id="laboratoryexam_id" v-model="form.laboratoryexam_id"
                                    class="mt-1 block w-full border-gray-400 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option v-for="(laboratoryexam, id) in laboratoryexams" :value="laboratoryexam.id">
                                        {{ laboratoryexam.exam }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.laboratoryexam_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="value" value="Valor" required="true" />
                                <TextInput id="value" type="text" class="mt-1 block w-full" v-model="form.value" />
                                <InputError class="mt-2" :message="form.errors.value" />
                            </div>

                            <PrimaryButton class="mt-5 py-3 w-full text-center justify-center" type="submit"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Enviar
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayoutVue>

</template>

