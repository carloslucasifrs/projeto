<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

const filterExam = ref('')

const props = defineProps({
    exams: Object,
    laboratories: Object
});

const filteredExam = computed(() => {
    let filter = filterExam.value
    if (!filter.length) return props.exams
    return props.exams.filter(exam =>
        exam.exam.toLowerCase().includes(filter.toLowerCase())
    )
})

const form = useForm({
    file: '',
    date: '',
    laboratory_id: ''
});

const submit = () => {
    form.post(route('exams.create'), {
        onFinish: () => form.reset(),
    })
};

</script>

<template>

    <AuthenticatedLayoutVue>

        <Head title="Meus Exames" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Exames
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex md:flex-row flex-col">
                        <div class="md:basis-80 basis-full bg-gray-100">
                            <TextInput id="search" type="text" class="m-3 mb-8 block" v-model="filterExam" autofocus
                                autocomplete="Search" placeholder="Procurar ...." />
                            <div class="divide-y divide-dashed  divide-gray-400">
                                <div class="mx-5" v-for="(exam, laboratoryexam_id) in filteredExam">
                                    <div class="py-2 flex justify-between ">
                                        <Link :href="route('exams.show', exam.laboratoryexam_id)">
                                        {{ exam.exam }}
                                        </Link>
                                        <span
                                            class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-800 text-white rounded-full">
                                            {{
                                                    exam.qtd
                                            }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:basis-full basis-full bg-gray-100 ml-5 p-4">


                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel for="laboratory" value="Laboratorio" required="true" />

                                    <select name="laboratory_id" id="laboratory_id" v-model="form.laboratory_id"
                                        class="mt-1 block w-full border-gray-400 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option v-for="(laboratory, id) in laboratories" :value="laboratory.id">
                                            {{ laboratory.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.laboratory_id" />


                                </div>
                                <div class="mt-5">
                                    <InputLabel for="date" value="Data do Exame" required="true" />
                                    <TextInput id="date" type="date" class="mt-1 block w-full" v-model="form.date" />
                                    <InputError class="mt-2" :message="form.errors.date" />
                                </div>
                                {{ form.date }}

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

                                <PrimaryButton class="mt-5 py-3 w-full text-center justify-center"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Enviar Exame
                                </PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
