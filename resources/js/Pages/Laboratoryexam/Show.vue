<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, computed, onMounted } from 'vue';
import ChartLine from '@/Components/ChartLine.vue';

const filterExam = ref('')
const label = []
const dataChart = []

props.exam_laboratoryexam.forEach(function (item) {
    label.push(item.date)
    dataChart.push(item.value)
})

const props = defineProps({
    laboratoryexam: Object,
    exam_laboratoryexam: Object,
});

const chartData = {
    labels: label,
    datasets: [
        {
            label: 'Data One',
            data: dataChart,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }
    ]
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
        <!-- <pre>{{ exam_laboratoryexam }}</pre> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:basis-full basis-full bg-gray-100 ml-5 p-4">
                        <h1 class="text-xl text-center font-extrabold pb-5">
                            {{ laboratoryexam.exam }}
                        </h1>

                        <ChartLine :chart-data="chartData" />

                        <h3 class="font-bold mt-5 mb-3">Valores de Referência</h3>
                        <table class="table-auto border-collapse border w-full">
                            <thead>
                                <tr class="text-left">
                                    <th>Regra</th>
                                    <th>Sexo</th>
                                    <th>Idade</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody v-for="(referencevalue, id) in laboratoryexam.reference_values">

                                <tr>
                                    <td>{{ referencevalue.rule }}</td>
                                    <td>{{ referencevalue.biologic_sex }}</td>
                                    <td>de {{ referencevalue.age_min }} à {{ referencevalue.age_max }}</td>
                                    <td>entre {{ referencevalue.value_min }} e {{ referencevalue.value_max }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <h2 class="font-bold mt-5">
                            Descrição:
                        </h2>
                        <span>
                            {{ laboratoryexam.description }}
                        </span>
                        <h3 class="font-bold mt-2">
                            Material:
                        </h3>
                        {{ laboratoryexam.material }}
                        <h3 class="font-bold mt-2">
                            Metodo:
                        </h3>
                        {{ laboratoryexam.method }}
                        <h3 class="font-bold mt-2">
                            Uso:
                        </h3>
                        {{ laboratoryexam.use }}

                        <h3 class="font-bold mt-4">
                            Bibliografia :
                        </h3>
                        {{ laboratoryexam.source }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
