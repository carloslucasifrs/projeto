<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const filterExam = ref('');

let exam_id = ref(0);

let isActiveModal = ref(false);

const props = defineProps({
    exams: Object,
    examUser: Object
});

const filteredExam = computed(() => {
    let filter = filterExam.value
    if (!filter.length) return props.exams
    return props.exams.filter(exam =>
        exam.exam.toLowerCase().includes(filter.toLowerCase())
    )
})

const form = useForm({

});

const closeModal = () => {
    isActiveModal.value = false;
}

const deleteExam = (id) => {
    isActiveModal.value = true;
    exam_id.value = id;
}

const destroy = () => {
    form.delete(route('exams.destroy', exam_id.value), {
        preserveScroll: true,
        onSuccess: () => {
            isActiveModal.value = false;
            exam_id.value = 0;
        }
    });
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
                                        <Link :href="route('laboratoryexams.show', exam.laboratoryexam_id)">
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
                            <div class="grid justify-items-end my-5 mr-1">

                                <ButtonLink :href="route('exams.create')">
                                    Adicionar Exame
                                </ButtonLink>

                            </div>
                            <table class="table-fixed border-separate border-solid borde border w-full bg-white">
                                <thead>
                                    <tr class="text-left">
                                        <th class="w-3/8">Exame</th>
                                        <th class="w-1/8">Data</th>
                                        <th class="w-2/8">Listar Valores</th>
                                        <th class="w-1/8 text-center">Editar</th>
                                        <th class="w-1/8 text-center">Remover</th>
                                    </tr>
                                </thead>
                                <tbody v-for="(exam, index) in examUser">

                                    <tr class="">
                                        <td class="w-3/8">
                                            <Link :href="route('exams.show', exam.id)">{{ exam.laboratory.name }}</Link>
                                        </td>
                                        <td class="w-1/8">{{ exam.date }}</td>
                                        <td class="w-2/8">
                                            <Link :href="route('examLaboratoryexams.index', { exam: exam })">
                                            Listar
                                            </Link>
                                        </td>
                                        <td class="w-1/8 text-center">
                                            <Link :href="route('exams.edit', exam.id)"
                                                class="text-indigo-800 inline-block">
                                            <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            </Link>
                                        </td>
                                        <td class="w-1/8 text-center">

                                            <button @click="deleteExam(exam.id)"
                                                class="text-red-700 inline-block cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal v-if="isActiveModal" @closeModal="closeModal" header="Exclusão">
            <template #bodyModal>
                <div class="flex md:flex-row text-center">
                    <h1 class="text-2xl text-center">Confirma exlusão do Exame?</h1>
                </div>
            </template>
            <template #footerModal>
                <Link @click="destroy()" class="mt-5 py-3 text-center justify-center" type="button" as="button"
                    :disabled="form.processing">
                Sim
                </Link>
            </template>
        </Modal>
    </AuthenticatedLayoutVue>
</template>
