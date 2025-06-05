<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { useEcho } from '@laravel/echo-vue';
import { onMounted, ref } from 'vue';

const user = usePage().props.auth.user;

const notifications = ref([]);

onMounted(() => {
    const { listen } = useEcho(`delays.${user.id}`, 'UpdateDelay', (e) => {
        notifications.value.push(e.data);
    });

    listen();
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
