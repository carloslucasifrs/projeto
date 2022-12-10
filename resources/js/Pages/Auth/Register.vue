<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import SearchZipcode from '@/Service/SearchZipcode.js';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    birth_date: '',
    genre: '',
    biologic_sex: '',
    nationality: '',
    place_of_birth: '',
    zipcode: '',
    district: '',
    state: '',
    city: '',
    number: '',
    complement: '',
});

const searchZipcode = async () => await SearchZipcode(form.zipcode)
    .then((result) => {
        form.address = result.logradouro
        form.district = result.bairro
        form.state = result.uf
        form.city = result.localidade
    }).catch((error) => {
        alert(error)
    })

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <GuestLayout>

        <Head title="Registro" />
        <div class="container  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <h1 class="text-2xl pb-8">Registro de Usuário</h1>
                <div class="grid gap-6 md:grid-cols-2 sm:grid-cols-1  lg:grid-cols-3">
                    <div class="col-span-2">
                        <InputLabel for="name" value="Name" required="true" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="birth_date" value="Data de Nascimento" required="true" />
                        <TextInput id="birth_date" type="date" class="mt-1 block w-full" v-model="form.birth_date"
                            required />
                        <InputError class="mt-2" :message="form.errors.birth_date" />
                    </div>

                    <div class="col-span-2">
                        <InputLabel for="email" value="Email" required="true" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>


                    <div>
                        <InputLabel for="genre" value="Genero" />
                        <TextInput id="genre" type="text" class="mt-1 block w-full" v-model="form.genre" />
                        <InputError class="mt-2" :message="form.errors.genre" />
                    </div>

                    <div>
                        <InputLabel for="biologic_sex" value="Sexo Biologico" />
                        <TextInput id="biologic_sex" type="text" class="mt-1 block w-full"
                            v-model="form.biologic_sex" />
                        <InputError class="mt-2" :message="form.errors.biologic_sex" />
                    </div>

                    <div>
                        <InputLabel for="nationality" value="Nacionalidade" />
                        <TextInput id="nationality" type="text" class="mt-1 block w-full" v-model="form.nationality" />
                        <InputError class="mt-2" :message="form.errors.nationality" />
                    </div>

                    <div>
                        <InputLabel for="place_of_birth" value="País de Nascimento" />
                        <TextInput id="place_of_birth" type="text" class="mt-1 block w-full"
                            v-model="form.place_of_birth" />
                        <InputError class="mt-2" :message="form.errors.place_of_birth" />
                    </div>

                    <div>
                        <InputLabel for="zipcode" value="CEP" />
                        <TextInput maxlength="8" minlength="8" id="zipcode" type="text" class="mt-1 block w-full"
                            v-model="form.zipcode" @blur="searchZipcode" />
                        <InputError class="mt-2" :message="form.errors.zipcode" />
                    </div>

                    <div class="col-span-2">
                        <InputLabel for="address" value="Endereço" />
                        <TextInput id="address" type="text" class="mt-1 block w-full bg-gray-100" v-model="form.address"
                            disabled />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>

                    <div class="col-span-2">
                        <InputLabel for="city" value="Cidade" />
                        <TextInput id="city" type="text" class="mt-1 block w-full bg-gray-100" v-model="form.city"
                            disabled />
                        <InputError class="mt-2" :message="form.errors.city" />
                    </div>

                    <div>
                        <InputLabel for="district" value="Estado" />
                        <TextInput id="district" type="text" class="mt-1 block w-full bg-gray-100"
                            v-model="form.district" disabled />
                        <InputError class="mt-2" :message="form.errors.district" />
                    </div>

                    <div>
                        <InputLabel for="state" value="Bairro" />
                        <TextInput id="state" type="text" class="mt-1 block w-full bg-gray-100 " v-model="form.state"
                            disabled />
                        <InputError class="mt-2" :message="form.errors.state" />
                    </div>

                    <div>
                        <InputLabel for="number" value="Número" />
                        <TextInput id="number" type="text" class="mt-1 block w-full" v-model="form.number" />
                        <InputError class="mt-2" :message="form.errors.number" />
                    </div>


                    <div>
                        <InputLabel for="complement" value="Complemento" />
                        <TextInput id="complement" type="text" class="mt-1 block w-full" v-model="form.complement" />
                        <InputError class="mt-2" :message="form.errors.complement" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Password" required="true" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div>
                        <InputLabel for="password_confirmation" value="Confirm Password" required="true" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="col-span-3 justify-self-end mt-4">
                        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Já Possui Cadastro?
                        </Link>

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Registrar
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
