<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted } from 'vue';


const props = defineProps({
    exam: Object,
});


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
                        <h1 class="text-xl text-center font-extrabold pb-5">
                            {{ exam.laboratory.name }}
                        </h1>
                        <h1 class="text-xl text-center font-extrabold pb-5">
                            {{ exam.date }}
                        </h1>
                        <div class="grid justify-items-end my-5 mr-1">

                            <!-- <ButtonLink :href="route('examLaboratoryexams.create')">
                                Adicionar Exame Laboratorial
                            </ButtonLink> -->


                        </div>
                        <h3 class="font-bold mt-5 mb-3">Resultado dos Exames Realizados</h3>
                        <table class="table-fixed border-separate border-solid borde border w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="w-1/6">#</th>
                                    <th class="w-2/6">Exame Laboratorial</th>
                                    <th class="w-1/6">Valor</th>

                                </tr>
                            </thead>
                            <tbody v-for="(exam, index) in exam.laboratoryexams">

                                <tr>
                                    <td class="w-1/6">{{ exam.id }}</td>
                                    <td class="w-2/6">{{ exam.exam }}</td>
                                    <td class="w-1/6">{{ exam.pivot.value }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
