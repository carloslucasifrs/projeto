<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';

import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    laboratorialexamValues: Array,
});

let editItem = ref([]);

const form = useForm({
    'exam': '',
    'value': '',
    'laboratoryexam_id': ''
});

const update = () => {
    let index = props.laboratorialexamValues.indexOf(editItem)
    props.laboratorialexamValues.splice(index, 1);
    props.laboratorialexamValues.push(
        {
            'laboratoryexam_id': form.laboratoryexam_id,
            'exam': form.exam,
            'value': form.value,
        }
    );
    form.reset()
};

const edit = (exam) => {
    editItem = props.laboratorialexamValues.find(laboratoryexam => laboratoryexam.laboratoryexam_id == exam.laboratoryexam_id);
    form.exam = editItem.exam;
    form.value = editItem.value;
    form.laboratoryexam_id = editItem.laboratoryexam_id;
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
        <hr>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex md:flex-row flex-col gap-10 mb-6">
                        <input type="hidden" id="laboratoryexam_id" name="laboratoryexam_id"
                            v-model="form.laboratoryexam_id">

                        <div class="md:basis-4/6 basis-full">
                            <InputLabel for="exam" value="Exame Laboratorial" />
                            <TextInput id="exam" name="exam" type="text" class="mt-1  bg-gray-200 block w-full" disabled
                                autofocus v-model="form.exam" />
                        </div>

                        <div class="md:basis-1/6 basis-full">
                            <InputLabel for="value" value="Valor" />
                            <TextInput id="value" type="text" class="mt-1 block w-full" v-model="form.value" required
                                autofocus autocomplete="value" />
                            <InputError class="mt-2" :message="form.errors.value" />
                        </div>
                        <div class="md:basis-1/6 basis-full mt-6">
                            <button type="button"
                                class="items-center px-4 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                v-on:click="update()">
                                Salvar
                            </button>
                        </div>
                    </div>
                    <div class="grid justify-items-end m-4">
                        <button type="button"
                            class="items-center px-2 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            v-on:click="update()">
                            Adicionar
                        </button>
                    </div>
                    <table class="table-fixed border-separate border-solid borde border w-full">
                        <thead>
                            <tr class="text-left">
                                <th>#</th>
                                <th>Exame Laboratorial</th>
                                <th>Valor</th>
                                <th class=" text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody v-for="(exam, index) in laboratorialexamValues">

                            <tr class="">
                                <td class="w-1/5">{{ exam.laboratoryexam_id }}</td>
                                <td class="w-2/5">{{ exam.exam }}</td>
                                <td class="w-1/5">{{ exam.value }}</td>
                                <td class="w-1/5">
                                    <button type="button" v-on:click="(edit(exam))"
                                        class="items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-nonefocus:shadow-outline-gray transition ease-in-out duration-150">
                                        Editar
                                    </button>
                                    <button type="button" v-on:click="remove"
                                        class="ml-2 items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600  focus:outline-none  focus:shadow-outline-gray transition ease-in-out duration-150">
                                        Apagar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
