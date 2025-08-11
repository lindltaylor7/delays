<script setup lang="ts">
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TableRegisters from './TableRegisters.vue';

const today = new Date().toLocaleDateString('en-CA', { timeZone: 'America/Lima' });
const isoDate = ref(today);
const formDate = today.split('-').reverse().join('/'); // Para mostrar dd/mm/yyyy

const form = useForm({
    area: '',
    zone: '',
    bank: '',
    project: '',
    hour: '',
    operator: '',
    helper: '',
    hour_meter_diesel: '',
    fuel: '',
    shift: '',
    supervisor_owm: '',
    supervisor_client: '',
    equipment: '',
    hour_start: '',
    hour_end: '',
    hours_worked: '',
    total_hours: '',
    total_drills: '',
    total_real_meters: '',
    total_reconciled_meters: '',
});

const saveReport = () => {
    form.post(route('drill.store'), {
        onFinish: () => {
            form.reset();
            alert('Registro Exitoso');
        },
    });
};

const resetForm = () => {
    form.reset();
};
</script>

<template>
    <AppLayout>
        <div class="full-width-drill-report">
            <!-- Encabezado -->
            <div class="report-header">
                <div class="header-content container-wide">
                    <h1>REPORTE DE PERFORADORA</h1>
                    <div class="report-meta">
                        <div class="meta-item">
                            <span class="meta-label">Código:</span>
                            <span class="meta-value">OWM-OP-FOR-002</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Versión:</span>
                            <span class="meta-value">04</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Fecha:</span>
                            <span class="meta-value">{{ formDate }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="report-content container-wide">
                <!-- Formulario -->
                <form class="report-form" @submit.prevent="saveReport">
                    <div class="form-columns">
                        <!-- Columna 1 -->
                        <div class="form-column">
                            <div class="form-group">
                                <label for="area">Área <span class="required">*</span></label>
                                <Input id="area" placeholder="Ingrese el área" v-model="form.area" required />
                            </div>

                            <div class="form-group">
                                <label for="operator">Operador <span class="required">*</span></label>
                                <Input id="operator" placeholder="Nombre del operador" v-model="form.operator" required />
                            </div>

                            <div class="form-group">
                                <label for="supervisorOwm">Supervisor OWM</label>
                                <Input id="supervisorOwm" placeholder="Nombre del supervisor" v-model="form.supervisor_owm" />
                            </div>

                            <div class="form-group">
                                <label for="hourStart">Horómetro Inicio</label>
                                <Input id="hourStart" placeholder="Horas iniciales" v-model="form.hour_start" />
                            </div>
                        </div>

                        <!-- Columna 2 -->
                        <div class="form-column">
                            <div class="form-group">
                                <label for="zone">Zona</label>
                                <Input id="zone" placeholder="Ingrese la zona" v-model="form.zone" />
                            </div>

                            <div class="form-group">
                                <label for="helper">Ayudante</label>
                                <Input id="helper" placeholder="Nombre del ayudante" v-model="form.helper" />
                            </div>

                            <div class="form-group">
                                <label for="supervisorClient">Supervisor Cliente</label>
                                <Input id="supervisorClient" placeholder="Nombre del supervisor" v-model="form.supervisor_client" />
                            </div>

                            <div class="form-group">
                                <label for="hourEnd">Horómetro Fin</label>
                                <Input id="hourEnd" placeholder="Horas finales" v-model="form.hour_end" />
                            </div>
                        </div>

                        <!-- Columna 3 -->
                        <div class="form-column">
                            <div class="form-group">
                                <label for="bank">Banco</label>
                                <Input id="bank" placeholder="Ingrese el banco" v-model="form.bank" />
                            </div>

                            <div class="form-group">
                                <label for="shift">Turno</label>
                                <select id="shift" v-model="form.shift" class="styled-select">
                                    <option value="" disabled selected>Seleccione turno</option>
                                    <option value="DIA">DÍA</option>
                                    <option value="NOCHE">NOCHE</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="equipment">Equipo</label>
                                <Input id="equipment" placeholder="Código del equipo" v-model="form.equipment" />
                            </div>

                            <div class="form-group">
                                <label for="hoursWorked">Horas Trabajadas</label>
                                <Input id="hoursWorked" placeholder="Total horas" v-model="form.hours_worked" />
                            </div>
                        </div>
                    </div>

                    <!-- Fila inferior (campos que ocupan ancho completo) -->
                    <div class="full-width-fields">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="project">Proyecto</label>
                                <Input id="project" placeholder="Nombre del proyecto" v-model="form.project" />
                            </div>

                            <div class="form-group">
                                <label for="hour">Hora</label>
                                <Input id="hour" type="time" v-model="form.hour" />
                            </div>

                            <div class="form-group">
                                <label for="hourMeterDiesel">Horómetro Motor Diesel</label>
                                <Input id="hourMeterDiesel" placeholder="Horas Motor Diesel" v-model="form.hour_meter_diesel" type="number" />
                            </div>

                            <div class="form-group">
                                <label for="fuel">Combustible (Galones)</label>
                                <Input id="fuel" placeholder="Cantidad en galones" v-model="form.fuel" type="number" />
                            </div>
                        </div>
                    </div>

                    <div class="full-width-fields">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="totalHours">Total Horas Perforación</label>
                                <Input id="totalHours" type="text" placeholder="Total Horas Perforación" v-model="form.total_hours" />
                            </div>

                            <div class="form-group">
                                <label for="totalDrills">Total taladros</label>
                                <Input id="totalDrills" placeholder="Total taladros" type="text" v-model="form.total_drills" />
                            </div>

                            <div class="form-group">
                                <label for="totalRealMeters">Total Metros Reales</label>
                                <Input id="totalRealMeters" placeholder="Total Metros Reales" type="text" v-model="form.total_real_meters" />
                            </div>

                            <div class="form-group">
                                <label for="totalReconciledMeters">Total Metros Conciliados</label>
                                <Input
                                    id="totalReconciledMeters"
                                    placeholder="Total Metros Conciliados"
                                    v-model="form.total_reconciled_meters"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>

                    <TableRegisters class="table-container" />

                    <!-- Acciones del formulario -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" @click="resetForm"><i class="icon-reset"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Guardar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.full-width-drill-report {
    width: 100%;
    min-height: 100vh;
    background: #f5f5f5;
}

.container-wide {
    width: 100%;
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 2rem;
}

.report-header {
    background: #d32f2f;
    color: white;
    padding: 1.5rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.report-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: 0.5px;
}

.report-meta {
    display: flex;
    gap: 2rem;
}

.meta-item {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: 0.8rem;
    opacity: 0.9;
}

.meta-value {
    font-weight: 600;
    font-size: 0.95rem;
}

.report-content {
    padding: 2rem 0;
}

.report-form {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-columns {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

.form-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.full-width-fields {
    margin-top: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-size: 0.9rem;
    font-weight: 500;
    color: #424242;
}

.styled-select {
    padding: 0.75rem;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 0.9rem;
    background-color: white;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
}

.styled-select:focus {
    outline: none;
    border-color: #d32f2f;
    box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
}

.table-container {
    margin: 2rem 0;
    width: 100%;
    overflow-x: auto;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eeeeee;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary {
    background-color: #d32f2f;
    color: white;
    border: none;
}

.btn-primary:hover {
    background-color: #b71c1c;
    transform: translateY(-1px);
}

.btn-secondary {
    background-color: white;
    color: #616161;
    border: 1px solid #e0e0e0;
}

.btn-secondary:hover {
    background-color: #f5f5f5;
}

.required {
    color: #d32f2f;
    font-weight: bold;
}

/* Efectos de hover y focus para inputs */
:deep(.input-container) {
    transition: all 0.2s ease;
}

:deep(.input-container:hover) {
    border-color: #bdbdbd;
}

:deep(.input-container:focus-within) {
    border-color: #d32f2f;
    box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
}

/* Responsive design */
@media (max-width: 1200px) {
    .container-wide {
        padding: 0 1.5rem;
    }

    .form-columns {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .report-header h1 {
        font-size: 1.5rem;
    }

    .report-meta {
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .report-meta {
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .form-columns {
        grid-template-columns: 1fr;
    }

    .report-form {
        padding: 1.5rem;
    }
}

@media (max-width: 576px) {
    .container-wide {
        padding: 0 1rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }

    .report-header h1 {
        font-size: 1.3rem;
    }
}
</style>
