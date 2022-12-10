<script setup>
import AuthenticatedLayoutVue from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ButtonLink from '@/Components/ButtonLink.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { onBeforeMount, reactive } from 'vue';
import SearchZipcode from '@/Service/SearchZipcode.js';
import moment from 'moment';


const props = defineProps({
    user: Object,
});

const zipcodeAPI = reactive({
    address: '',
    city: '',
    district: '',
    state: ''
});

onBeforeMount(async () => {
    if (props.user.zipcode != null) {
        const zipcode = await searchZipcode(props.user.zipcode);
    }
    props.user.birth_date = moment(props.user.birth_date).format('DD/MM/YYYY')
});

const searchZipcode = async (zipcode) => await SearchZipcode(zipcode)
    .then((result) => {
        zipcodeAPI.address = result.logradouro
        zipcodeAPI.district = result.bairro
        zipcodeAPI.state = result.uf
        zipcodeAPI.city = result.localidade
    }).catch((error) => {
        alert(error)
    })

</script>

<template>

    <AuthenticatedLayoutVue>


        <Head title="Minha Conta" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Minha Conta
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text text-xl pb-10">Meus Dados </h1>
                    <div class="grid gap-6 lg:grid-cols-3">
                        <div class="col-span-2">
                            <InputLabel value="Name" />
                            {{ user.name }}
                        </div>

                        <div>
                            <InputLabel value="Data de Nascimento" />
                            {{ user.birth_date }}
                        </div>

                        <div class="col-span-2">
                            <InputLabel value="Email" />
                            {{ user.email }}
                        </div>

                        <div>
                            <InputLabel value="Genero" />
                            {{ user.genre }}
                        </div>

                        <div>
                            <InputLabel value="Sexo Biologico" />
                            {{ user.biologic_sex }}
                        </div>

                        <div>
                            <InputLabel value="Nacionalidade" />
                            {{ user.nationality }}
                        </div>

                        <div>
                            <InputLabel value="País de Nascimento" />
                            {{ user.place_of_birth }}
                        </div>

                        <div>
                            <InputLabel value="CEP" />
                            {{ user.zipcode }}
                        </div>

                        <div class="col-span-2">
                            <InputLabel value="Endereço" />
                            {{ zipcodeAPI.address }}
                        </div>

                        <div>
                            <InputLabel value="Bairro" />
                            {{ zipcodeAPI.district }}
                        </div>

                        <div>
                            <InputLabel value="Estado" />
                            {{ zipcodeAPI.state }}
                        </div>

                        <div>
                            <InputLabel value="Cidade" />
                            {{ zipcodeAPI.city }}
                        </div>

                        <div>
                            <InputLabel value="Número" />
                            {{ user.number }}
                        </div>

                        <div>
                            <InputLabel value="Complemento" />
                            {{ user.complement }}
                        </div>
                    </div>
                    <div class="flex justify-end justify-items-end justify-self-end justify ">
                        <ButtonLink class="mt-4 ml-4" :href="route('profile.edit', user.id)">
                            Atualizar Dados
                        </ButtonLink>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text text-xl pb-10">Remover</h1>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
