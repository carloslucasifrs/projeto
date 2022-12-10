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
    laboratorialexamValues: Array,
    laboratoryexams: Array
});


let isActiveModalEdit = ref(false);
let isActiveModalAdd = ref(false);
let editItem = ref([]);
let filterLaboratoryExams = ref(Object);

onMounted(() => {
    updateListLaboratoryexams();
    console.log(filterLaboratoryExams)
});

const updateListLaboratoryexams = () => {

    const laboratorialexamValuesId = props.laboratorialexamValues.map(laboratorialexamValues => {
        return laboratorialexamValues.laboratoryexam_id
    });

    filterLaboratoryExams.value = props.laboratoryexams.filter(laboratoryexams => {
        return laboratorialexamValuesId.indexOf(laboratoryexams.laboratoryexam_id) == -1
    });

}

const form = useForm({
    'exam': '',
    'value': '',
    'laboratoryexam_id': ''
});

const validForm = () => {
    let isValid = true;

    form.clearErrors()

    if (form.value == '' || form.value == '0') {
        form.setError("value", "Campo Requerido");
        isValid = false;
    }
    if (form.laboratoryexam_id == '') {
        form.setError("laboratoryexam_id", "Selecione um Exame Laboratorial, campo Requerido");
        isValid = false;
    }

    return isValid;

}

const saveAdd = () => {
    if (validForm()) {
        props.laboratorialexamValues.push(
            {
                'laboratoryexam_id': form.laboratoryexam_id,
                'exam': form.exam,
                'value': form.value,
            }
        );
        updateListLaboratoryexams();
        isActiveModalAdd.value = false;
        form.reset()
    }

};

const saveEdit = () => {
    if (validForm()) {
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
        isActiveModalEdit.value = false;
        updateListLaboratoryexams();

    }
};

const edit = (exam) => {

    isActiveModalEdit.value = !isActiveModalEdit.value;
    editItem = props.laboratorialexamValues.find(
        laboratoryexam =>
            laboratoryexam.laboratoryexam_id == exam.laboratoryexam_id
    );
    form.exam = editItem.exam;
    form.value = editItem.value;
    form.laboratoryexam_id = editItem.laboratoryexam_id;
};

const remove = (exam) => {
    const index = props.laboratorialexamValues.indexOf(exam);
    if (index > -1) {
        props.laboratorialexamValues.splice(index, 1);
    }
    updateListLaboratoryexams();
};

const closeModalEdit = () => {
    isActiveModalEdit.value = false;
}

const closeModalAdd = () => {
    isActiveModalAdd.value = false;
}
</script>

<template>

    <AuthenticatedLayoutVue>

        <Head title="Meus Exames" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Exames
            </h2>
        </template>
        <div class="flex flex-col">
            <div class="w-1/2">

                <pre>{{ laboratorialexamValues }}</pre>
            </div>
            <div class="w-1/2">
                <pre>
                   {{ form }}
               </pre>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="grid justify-items-end my-5 mr-1">
                        <button type="button"
                            class="items-center px-2 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            @click="isActiveModalAdd = !isActiveModalAdd">
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
                                    <button type="button" @click="edit(exam)"
                                        class="items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-nonefocus:shadow-outline-gray transition ease-in-out duration-150">
                                        Editar
                                    </button>
                                    <button type="button" @click="remove(exam)"
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
    <Modal v-if="isActiveModalEdit" @closeModal="closeModalEdit" header="Editar ">
        <template #bodyModal>
            <div class="flex md:flex-row flex-col gap-10 mb-6">
                <input type="hidden" id="laboratoryexam_id" name="laboratoryexam_id" v-model="form.laboratoryexam_id">

                <div class="md:w-4/5 w-full">
                    <InputLabel for="exam" value="Exame Laboratorial" />
                    <TextInput id="exam" name="exam" type="text" class="mt-1  bg-gray-200 block w-full" disabled
                        autofocus v-model="form.exam" />
                </div>

                <div class="md:w-1/5 w-full">
                    <InputLabel for="value" value="Valor" required="true" />
                    <TextInput id="value" type="text" class="mt-1 block w-full" v-model="form.value" required autofocus
                        autocomplete="value" />
                    <InputError class="mt-2" :message="form.errors.value" />
                </div>
            </div>
        </template>
        <template #footerModal>
            <PrimaryButton class="mt-5 py-3 text-center justify-center" @click="saveEdit">Salvar
            </PrimaryButton>
        </template>
    </Modal>

    <Modal v-if="isActiveModalAdd" @closeModal="closeModalAdd" header="Adicionar ">
        <template #bodyModal>
            <div class="flex md:flex-row flex-col gap-10 mb-6">
                <div class="md:w-4/5 w-full">
                    <InputLabel for="laboratoryexam_id" value="Exame Laboratorial" required="true" />

                    <select name="laboratoryexam_id" id="laboratoryexam_id" v-model="form.laboratoryexam_id"
                        class="mt-1 block w-full border-gray-400 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option v-for="(laboratoryexam, id) in filterLaboratoryExams"
                            :value="laboratoryexam.laboratoryexam_id">
                            {{ laboratoryexam.exam }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.laboratoryexam_id" />
                </div>

                <div class="md:w-1/5 w-full">
                    <InputLabel for="value" value="Valor" required="true" />
                    <TextInput id="value" type="text" class="mt-1 block w-full" v-model="form.value" required autofocus
                        autocomplete="value" />
                    <InputError class="mt-2" :message="form.errors.value" />
                </div>
            </div>
        </template>
        <template #footerModal>
            <PrimaryButton class="mt-5 py-3 text-center justify-center" @click="saveAdd" :disabled="form.processing">
                Salvar
            </PrimaryButton>
        </template>
    </Modal>
</template>
<style scoped>
#modal {
    transition: opacity 0.25s ease;
}
</style>
