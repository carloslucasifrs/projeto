<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps(['header']);

defineEmits(['closeModal']);

</script>

<template>
    <div id="modal" class="fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div id="modal-overlay" class="absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="bg-white w-full md:max-w-screen-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div id="modal-content" class="py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">{{ header }}</p>
                    <div class="cursor-pointer z-50">
                        <svg class=" fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18" @click="$emit('closeModal')">
                            <path d=" M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9
                            10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <slot name="bodyModal" />
                <!--Footer-->
                <div class="flex justify-end pt-2 gap-4">
                    <slot name="footerModal" />
                    <PrimaryButton class="mt-5 py-3 text-center justify-center bg-red-800" @click="$emit('closeModal')">
                        Fechar
                    </PrimaryButton>

                </div>

            </div>
        </div>
    </div>

</template>
