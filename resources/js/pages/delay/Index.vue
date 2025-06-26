<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    vehicles: {
        type: Array,
    },
    reasons: {
        type: Array,
    },
});

const form = useForm({
    status: 0,
    vehicle_id: 0,
    start_time: '',
    end_time: '',
    reason_id: 0,
    user_id: 0,
});

const showReasonDialog = ref(false);
const selectedAction = ref('');

const registerDelay = (delayType: number) => {
    /* if (delayType !== 3) {
        selectedAction.value = delayType === 1 ? 'Iniciar Demora' : delayType === 2 ? 'Reanudar Demora' : 'Pausar Demora';
        showReasonDialog.value = true;
        return;
    } */

    confirmAction(delayType);
};

const confirmAction = (delayType: number) => {
    form.status = delayType;
    form.user_id = 1;
    form.start_time = new Date().toISOString();

    if (delayType === 3) {
        form.end_time = new Date().toISOString();
    }

    form.post(route('delay.store'), {
        onFinish: () => form.reset(),
    });

    showReasonDialog.value = false;
    console.log('Demora registrada', delayType);
};
</script>

<template>
    <AppLayout>
        <div
            class="delay-container"
            style="
                max-width: 42rem;
                margin-left: auto;
                margin-right: auto;
                padding: 1.5rem;
                background: white;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            "
        >
            <header class="delay-header" style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937">{{ title }}</h1>
                <p style="color: #4b5563; margin-top: 0.5rem">{{ description }}</p>
            </header>

            <div class="delay-controls">
                <div class="vehicle-selector" style="margin-bottom: 1rem">
                    <label for="vehicle" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem"
                        >Vehículo</label
                    >
                    <select
                        id="vehicle"
                        v-model="form.vehicle_id"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #000"
                    >
                        <option value="" disabled>Seleccione un vehículo</option>
                        <option v-for="(vehicle, index) in props.vehicles" :key="index" :value="vehicle.id">
                            {{ vehicle.code }}
                        </option>
                    </select>
                </div>

                <div class="reason-selector" style="margin-bottom: 1rem">
                    <label for="reason" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem"
                        >Motivo</label
                    >
                    <select
                        id="vehicle"
                        v-model="form.reason_id"
                        style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #000"
                    >
                        <option value="" disabled>Seleccione un vehículo</option>
                        <option v-for="(reason, index) in props.reasons" :key="index" :value="reason.id">
                            {{ reason.description }}
                        </option>
                    </select>
                </div>

                <div class="action-buttons" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.75rem; margin-top: 1rem">
                    <!-- Botón Iniciar Demora -->
                    <Button
                        @click="registerDelay(1)"
                        style="
                            padding: 0.75rem;
                            background-color: #3b82f6;
                            color: white;
                            border: none;
                            border-radius: 0.375rem;
                            font-weight: 500;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                        "
                        :disabled="form.status === 1"
                        :style="{
                            opacity: form.status === 1 ? '0.7' : '1',
                            'background-color': form.status === 1 ? '#93c5fd' : '#3b82f6',
                            cursor: form.status === 1 ? 'not-allowed' : 'pointer',
                        }"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Iniciar Demora
                    </Button>

                    <!-- Botón Pausar Demora -->
                    <Button
                        @click="registerDelay(2)"
                        style="
                            padding: 0.75rem;
                            background-color: #f59e0b;
                            color: white;
                            border: none;
                            border-radius: 0.375rem;
                            font-weight: 500;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                        "
                        :disabled="form.status !== 1"
                        :style="{
                            opacity: form.status !== 1 ? '0.7' : '1',
                            'background-color': form.status !== 1 ? '#fcd34d' : '#f59e0b',
                            cursor: form.status !== 1 ? 'not-allowed' : 'pointer',
                        }"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Pausar Demora
                    </Button>

                    <!-- Botón Finalizar Demora -->
                    <Button
                        @click="registerDelay(3)"
                        style="
                            padding: 0.75rem;
                            background-color: #10b981;
                            color: white;
                            border: none;
                            border-radius: 0.375rem;
                            font-weight: 500;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                        "
                        :disabled="form.status === 0"
                        :style="{
                            opacity: form.status === 0 ? '0.7' : '1',
                            'background-color': form.status === 0 ? '#a7f3d0' : '#10b981',
                            cursor: form.status === 0 ? 'not-allowed' : 'pointer',
                        }"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Finalizar Demora
                    </Button>

                    <!-- Botón Reanudar Demora -->
                    <Button
                        @click="registerDelay(4)"
                        style="
                            padding: 0.75rem;
                            background-color: #6366f1;
                            color: white;
                            border: none;
                            border-radius: 0.375rem;
                            font-weight: 500;
                            cursor: pointer;
                            transition: all 0.2s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                        "
                        :disabled="form.status !== 2"
                        :style="{
                            opacity: form.status !== 2 ? '0.7' : '1',
                            'background-color': form.status !== 2 ? '#a5b4fc' : '#6366f1',
                            cursor: form.status !== 2 ? 'not-allowed' : 'pointer',
                        }"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Reanudar Demora
                    </Button>
                </div>
            </div>

            <!-- Modal para ingresar motivo -->
            <div
                v-if="showReasonDialog"
                style="
                    position: fixed;
                    inset: 0;
                    background: rgba(0, 0, 0, 0.5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 1rem;
                    z-index: 50;
                "
            >
                <div style="background: white; border-radius: 0.5rem; padding: 1.5rem; width: 100%; max-width: 28rem">
                    <h3 style="font-size: 1.125rem; font-weight: 500; margin-bottom: 1rem">{{ selectedAction }}</h3>

                    <div style="margin-bottom: 1rem">
                        <label for="reason" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem"
                            >Motivo de la demora</label
                        >
                        <textarea
                            id="reason"
                            v-model="form.reason"
                            rows="3"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #000"
                            placeholder="Describa el motivo de la demora..."
                        ></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 0.75rem">
                        <Button variant="secondary" @click="showReasonDialog = false"> Cancelar </Button>
                        <Button style="background-color: #10b981" @click="confirmAction(form.status)"> Confirmar </Button>
                    </div>
                </div>
            </div>

            <!-- Estado actual -->
            <div
                class="status-indicator"
                style="margin-top: 1.5rem; padding: 1rem; border-radius: 0.375rem"
                :style="{
                    background: form.status === 1 ? '#dbeafe' : form.status === 2 ? '#fef3c7' : form.status === 3 ? '#d1fae5' : '#f3f4f6',
                    color: form.status === 1 ? '#1e40af' : form.status === 2 ? '#92400e' : form.status === 3 ? '#065f46' : '#374151',
                }"
            >
                <h3 style="font-weight: 500">Estado actual:</h3>
                <p style="margin-top: 0.25rem">
                    {{
                        form.status === 1
                            ? 'Demora en progreso'
                            : form.status === 2
                              ? 'Demora pausada'
                              : form.status === 3
                                ? 'Demora finalizada'
                                : 'Sin demora registrada'
                    }}
                </p>
                <p v-if="form.start_time" style="font-size: 0.875rem; margin-top: 0.5rem">
                    Iniciado: {{ new Date(form.start_time).toLocaleString() }}
                </p>
            </div>
        </div>
    </AppLayout>
</template>
