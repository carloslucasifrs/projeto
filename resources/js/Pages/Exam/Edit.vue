<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    exam: Object,
    laboratories: Object,
    examFile: String,
});

const form = useForm({
    'laboratory_id': props.exam.laboratory_id,
    'date': props.exam.date,
    'file': props.exam.file
});

const submit = () => {
    form.put(route('exams.update', props.exam.id), {
        onFinish: () => form.reset(),
    })
};

</script>

<template>

    <AuthenticatedLayoutVue>

        <Head title="Meus Exames" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Exame
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        {{ form }}
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="laboratory_id" value="Laboratorio" required="true" />

                                <select name="laboratory_id" id="laboratory_id" v-model="form.laboratory_id"
                                    class="mt-1 block w-full border-gray-400 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option v-for="(laboratory, id) in laboratories" :value="laboratory.id">
                                        {{ laboratory.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.laboratory_id" />


                            </div>
                            <div>
                                <InputLabel for="date" value="Data do Exame" required="true" />
                                <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date" />
                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>
                            <h1 class="text-xl font-extrabold pb-5">
                                File:
                            </h1>
                            <div v-if="examFile">
                                <h1 class="text-lg  pb-5">
                                    <a :href="examFile"> <svg xmlns="http://www.w3.org/2000/svg" height="48px"
                                            viewBox="0 0 24 24" width="48px" fill="#000000">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path
                                                d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                        </svg>
                                    </a>
                                </h1>
                                <Link :href="route('exams.destroyFile', exam.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-800">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                </Link>
                            </div>
                            <div class="flex flex-row items-center justify-center w-full mt-5">

                                <label for="file"
                                    class="flex flex-row items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">
                                                Clique aqui para enviar o arquivo
                                            </span>
                                            ou arraste e solte
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ou PDF</p>
                                    </div>
                                </label>
                                <input id="file" type="file" class="hidden" name="file"
                                    @input="form.file = $event.target.files[0]" />

                            </div>
                            <InputError class="mt-2" :message="form.errors.file" />
                            <progress class="mt-5 py-3 w-full text-center justify-center" v-if="form.progress"
                                :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>

                            <PrimaryButton class="mt-5 py-3 w-full text-center justify-center" type="submit"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Enviar Exame
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
