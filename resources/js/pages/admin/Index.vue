<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { useEcho } from '@laravel/echo-vue';
import { ref } from 'vue';

const user = usePage().props.auth.user;

const notifications = ref([]);

useEcho(`delays.${user.id}`, 'UpdateDelay', (e) => {
    console.log(e);
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
