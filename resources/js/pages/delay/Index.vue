<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3';
// Define las props que esperas recibir
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
});

const form = useForm({
    status: 0,
    vehicle: '',
    start_time: '',
    end_time: '',
    reason: '',
    user_id: 0, // Inicializa el tipo de demora
});

const registerDelay = (delayType: number) => {
    form.status = delayType;
    form.vehicle = 'Vehículo 1';
    form.reason = 'Motivo de la demora';

    form.user_id = 1;

    form.post(route('delay.store'), {
        onFinish: () => form.reset(),
    });
    console.log('Demora registrada', delayType);
};
</script>

<template>
    <h1>{{ title }}</h1>
    <p>{{ description }}</p>

    <div class="flex w-full">
        <Button class="ml-2" @click="registerDelay(1)">Iniciar Demora</Button>
        <Button class="ml-2" @click="registerDelay(1)">Pausar Demora</Button>
        <Button class="ml-2" @click="registerDelay(2)">Reanudar Demora</Button>
        <Button class="ml-2" @click="registerDelay(3)">Detener Demora</Button>
    </div>
</template>
