<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

import Input from '@/Components/ui/input/Input.vue';
import Button from '@/Components/ui/button/Button.vue';

const page = usePage();
const isConverted = ref(false);
const decimalNumber = ref(0);

const form = useForm({
    binaryNumber: '',
});

const submit = () => {
    form.post(route('convert'), {
        onSuccess: () => {
            decimalNumber.value = Number(page.props.response.decimalNumber);
            isConverted.value = true;
        },
    });
};

const clear = () => {
    form.reset();
    form.binaryNumber = '';
    decimalNumber.value = 0;
    isConverted.value = false;
};
</script>

<template>
    <Head title="Home" />

    <div class="container">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-5xl font-bold text-center mt-10">
                <span class="text-blue-500">Bin</span><span class="text-red-500">2</span><span class="text-green-500">Dec</span>
            </h1>
            <p class="text-2xl text-center mt-5">Uma forma <span class="text-pink-400">divertida</span> de converter de <span class="text-blue-500">binário</span> para <span class="text-green-500">decimal</span>!</p>

            <div class="flex items-center mt-10 w-full max-w-xl">
                <form @submit.prevent="submit" class="flex items-center w-full">
                    <Input type="text" placeholder="Digite um número binário" class="w-full" v-model="form.binaryNumber" :class="{ 'border-red-500': form.errors.binaryNumber }" />
                    <Button class="ml-2 bg-blue-500 hover:bg-blue-600 text-white" @click="submit">
                        Converter
                    </Button>
                    <Button variant="destructive" class="ml-2" v-if="isConverted" @click="clear">
                        Limpar
                    </Button>
                </form>
            </div>
            <span class="text-red-500" v-if="form.errors.binaryNumber">{{ form.errors.binaryNumber }}</span>

            <div class="mt-10">
                <p class="text-2xl text-center">Resultado:</p>
                <p class="text-4xl text-center font-bold text-blue-500">{{ decimalNumber }}</p>
            </div>
        </div>
    </div>
</template>

<style>
</style>
