<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, CategoryScale, PointElement, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale)

// const chartData = {
//     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//     datasets: [
//         {
//             label: 'Data One',
//             backgroundColor: '#f87979',
//             data: [40, 39, 10, 40, 39, 80, 40]
//         }
//     ]
// }

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false
}

const props = defineProps({
    chartData: {
        type: Object,
        default: null
    },
    chartId: {
        type: String,
        default: 'line-chart'
    },
    datasetIdKey: {
        type: String,
        default: 'label'
    },
    width: {
        type: Number,
        default: 400
    },
    height: {
        type: Number,
        default: 300
    },
    cssClasses: {
        default: '',
        type: String
    },
    styles: {
        type: Object,
        default: () => { }
    },
    plugins: {
        type: Array,
        default: () => []
    }
});

</script>

<template>
    <Line :chart-options="chartOptions" :chart-data="props.chartData" :chart-id="props.chartId"
        :dataset-id-key="props.datasetIdKey" :plugins="props.plugins" :css-classes="props.cssClasses"
        :styles="props.styles" :width="props.width" :height="props.height" />

</template>
