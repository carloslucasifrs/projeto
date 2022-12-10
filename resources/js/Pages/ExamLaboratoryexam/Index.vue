<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import Modal from '@/Components/Modal.vue';

let isActiveModal = ref(false);

const props = defineProps({
    exam: Object,
    examFile: String
});

const form = useForm({
    laboratoryexamId: ''
});

const closeModal = () => {
    isActiveModal.value = false;
}

const deleteExamLaboratoryexam = (id) => {
    isActiveModal.value = true;
    console.log(id)
    form.laboratoryexamId = id;
}

const destroy = () => {
    form.delete(route('examLaboratoryexams.destroy', { exam: props.exam, laboratoryexamId: form.laboratoryexamId }), {
        preserveScroll: true,
        onSuccess: () => {
            isActiveModal.value = false;
            form.reset();
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
        <hr>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:basis-full basis-full bg-gray-100 ml-5 p-4">
                        <h1 class="text-xl font-extrabold pb-5">
                            Laboratório:
                        </h1>
                        <h1 class="text-lg  pb-5">
                            {{ exam.laboratory.name }}
                        </h1>
                        <h1 class="text-xl font-extrabold pb-5">
                            Data:
                        </h1>
                        <h1 class="text-lg  pb-5">{{ exam.date }}
                        </h1>
                        <h1 class="text-xl font-extrabold pb-5">
                            File:
                        </h1>
                        <h1 class="text-lg  pb-5">
                            <a :href="examFile"> <svg xmlns="http://www.w3.org/2000/svg" height="48px"
                                    viewBox="0 0 24 24" width="48px" fill="#000000">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path
                                        d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                </svg>
                            </a>
                        </h1>
                        <div class="grid justify-items-end my-5 mr-1">

                            <ButtonLink :href="route('examLaboratoryexams.create', { exam: exam })">
                                Adicionar Exame Laboratorial
                            </ButtonLink>


                        </div>
                        <h3 class="font-bold mt-5 mb-3">Exames Realizados</h3>
                        <table class="table-fixed border-separate border-solid borde border w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="w-2/4">Exame Laboratorial</th>
                                    <th class="w-1/4">Valor</th>
                                    <th class="w-1/4 text-center">Remover</th>
                                </tr>
                            </thead>
                            <tbody v-for="(laboratoryexam, index) in exam.laboratoryexams">
                                <tr>
                                    <td class="w-2/4">{{ laboratoryexam.exam }}</td>
                                    <td class="w-1/4">{{ laboratoryexam.pivot.value }}</td>
                                    <td class="w-1/4 text-center">
                                        <button @click="deleteExamLaboratoryexam(laboratoryexam.id)"
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
