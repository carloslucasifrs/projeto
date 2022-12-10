<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue,
    values: [{
        'id': String,
        'name': String
    }]
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>

    <!-- <input type="checkbox" :value="value" v-model="proxyChecked" -->

    <select v-model="modelValue" @input="$emit('update:modelValue', $event.target.value)" class=" mt-1 block w-full border-gray-400 focus:border-green-300 focus:ring focus:ring-green-200
        focus:ring-opacity-50 rounded-md shadow-sm">
        <option v-for="(value, id) in values" :value="value.id">
            {{ value.name }}
        </option>
    </select>

</template>
