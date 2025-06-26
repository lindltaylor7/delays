<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { useEcho } from '@laravel/echo-vue';
import { computed, ref } from 'vue';

const user = usePage().props.auth.user;

const delays = ref([]);
const activeTab = ref('active');
const searchQuery = ref('');

// Mapeo de status numérico a texto
const statusMap = {
    0: 'pending',
    1: 'in_progress',
    2: 'paused',
    3: 'completed',
};

useEcho(`delays.${user.id}`, 'UpdateDelay', (e) => {
    delays.value.push(e.data);
});

const filteredDelays = computed(() => {
    const tabFiltered =
        activeTab.value === 'active' ? delays.value.filter((d) => d.status !== 'completed') : delays.value.filter((d) => d.status === 'completed');

    return tabFiltered.filter((delay) => {
        return (
            delay.vehicle.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            delay.reason?.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
});

const statusClasses = {
    pending: 'bg-yellow-100 text-yellow-800',
    in_progress: 'bg-blue-100 text-blue-800',
    paused: 'bg-orange-100 text-orange-800',
    completed: 'bg-green-100 text-green-800',
};

const formatDateTime = (dateString) => {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleString();
};

const calculateDuration = (start, end) => {
    if (!start) return 'N/A';
    const endTime = end ? new Date(end) : new Date();
    const diff = endTime - new Date(start);
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    return `${hours}h ${minutes}m`;
};
</script>

<template>
    <AppLayout>
        <div class="w-full px-5">
            <!-- Header -->
            <header class="delays-header">
                <h1 class="delays-title">Administración de Delays</h1>
                <div class="delays-controls">
                    <div class="search-box">
                        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <input v-model="searchQuery" type="text" placeholder="Buscar delays..." class="search-input" />
                    </div>
                </div>
            </header>

            <!-- Tabs -->
            <div class="tabs-container">
                <button @click="activeTab = 'active'" :class="['tab-btn', { active: activeTab === 'active' }]">
                    Delays Activos
                    <span class="badge">{{ delays.filter((d) => d.status !== 'completed').length }}</span>
                </button>
                <button @click="activeTab = 'completed'" :class="['tab-btn', { active: activeTab === 'completed' }]">
                    Histórico
                    <span class="badge">{{ delays.filter((d) => d.status === 'completed').length }}</span>
                </button>
            </div>

            <!-- Delays Table -->
            <div class="table-container">
                <div v-if="filteredDelays.length === 0" class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    <p>No hay delays {{ activeTab === 'active' ? 'activos' : 'completados' }}</p>
                </div>

                <table v-else class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehículo</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Duración</th>
                            <th>Estado</th>
                            <th>Motivo</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="delay in delays" :key="delay.id">
                            <td>{{ delay.user_id }}</td>
                            <td>{{ delay.vehicle }}</td>
                            <td>{{ formatDateTime(delay.start_time) }}</td>
                            <td>{{ formatDateTime(delay.end_time) }}</td>
                            <td>{{ calculateDuration(delay.start_time, delay.end_time) }}</td>
                            <td>
                                <span :class="['status-badge', statusClasses[delay.status]]">
                                    {{
                                        delay.status === 'pending'
                                            ? 'Pendiente'
                                            : delay.status === 'in_progress'
                                              ? 'En progreso'
                                              : delay.status === 'paused'
                                                ? 'Pausado'
                                                : 'Completado'
                                    }}
                                </span>
                            </td>
                            <td>{{ delay.reason || 'N/A' }}</td>
                            <td>{{ delay.user_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.delays-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Inter', sans-serif;
}

.delays-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.delays-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
}

.delays-controls {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-box {
    position: relative;
    width: 300px;
}

.search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    height: 1.25rem;
    width: 1.25rem;
    color: #9ca3af;
}

.search-input {
    width: 100%;
    padding: 0.5rem 0.75rem 0.5rem 2.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    transition: border-color 0.2s;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
}

.tabs-container {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
    margin-bottom: 1.5rem;
}

.tab-btn {
    position: relative;
    padding: 0.75rem 1.5rem;
    background: none;
    border: none;
    cursor: pointer;
    font-weight: 500;
    color: #6b7280;
    transition: all 0.2s;
}

.tab-btn.active {
    color: #3b82f6;
}

.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #3b82f6;
}

.badge {
    margin-left: 0.5rem;
    padding: 0.25rem 0.5rem;
    background-color: #3b82f6;
    color: white;
    border-radius: 9999px;
    font-size: 0.75rem;
}

.table-container {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    color: #6b7280;
}

.empty-icon {
    height: 3rem;
    width: 3rem;
    margin-bottom: 1rem;
    color: #d1d5db;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    padding: 1rem;
    text-align: left;
    background-color: #f9fafb;
    color: #374151;
    font-weight: 600;
    border-bottom: 1px solid #e5e7eb;
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
    color: #4b5563;
}

.data-table tr:hover {
    background-color: #f9fafb;
}

.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    display: inline-block;
}
</style>
