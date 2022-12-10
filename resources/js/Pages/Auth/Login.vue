<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="backgroundimage h-screen  bg-cover opacity-100">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

                <Head title="Login" />

                <div
                    class="w-full md:max-w-md mx-6 px-6 py-4 bg-blue shadow-2xl overflow-hidden sm:rounded-lg bg-gray-100">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Email" required="true" />
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="username" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Senha" required="true" />
                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="current-password" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ml-2 text-sm text-gray-600">Lembrar</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="underline text-sm text-gray-600 hover:text-gray-900">
                            Esqueceu sua senha?
                            </Link>

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Login
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.backgroundimage {
    background-image: url('/images/fundo.jpg');
    background-repeat: no-repeat;
    background-position: center;
}
</style>

<!-- <a href="https://br.freepik.com/fotos-gratis/amigavel-flebotomista-do-hospital-coletando-amostra-de-sangue-do-paciente-no-laboratorio-preparacao-para-exame-de-sangue-pelo-uniforme-medico-feminino-na-mesa-na-sala-branca-brilhante_28001948.htm#query=exame%20sangue&position=0&from_view=search&track=sph">Imagem de stefamerpik</a> no Freepik -->