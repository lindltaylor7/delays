<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const user = usePage().props.auth.user;

const notifications = ref([]);

onMounted(() => {
    const channel = Echo.private(`delays.${user.id}`);

    channel.listen('.UpdateDelay', (e) => {
        notifications.value.push(e.data);
    });

    // Manejadores de eventos para debug
    channel.subscriptionSucceeded(() => {
        console.log('Suscripción exitosa al canal privado');
    });

    channel.subscriptionError((error) => {
        console.error('Error en suscripción:', error);
    });
});
</script>

<template>
    <div class="notifications-container">
        <h2>Admin de delays</h2>
        <div v-for="notification in notifications" :key="notification.id">
            {{ notification }}
        </div>
    </div>
</template>
