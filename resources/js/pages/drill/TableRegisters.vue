<script setup lang="ts">
import { ref } from 'vue';

const drills = ref([
    {
        hole_code: '',
        terrain: 'N',
        design_ht: '',
        real_ht: '',
        verified_ht: '',
        drill_types: [],
        rock_hardness: 'M',
        start_time: '',
        end_time: '',
        obs: 'R1',
        comments: '',
    },
]);

function addRow() {
    drills.value.push({
        hole_code: '',
        terrain: 'N',
        design_ht: '',
        real_ht: '',
        verified_ht: '',
        drill_types: [],
        rock_hardness: 'M',
        start_time: '',
        end_time: '',
        obs: 'R1',
        comments: '',
    });
}
</script>

<template>
    <div class="cards-container mt-3">
        <div v-for="(row, index) in drills" :key="index" class="drill-card">
            <h3>Taladro #{{ index + 1 }}</h3>

            <div class="form-row">
                <div class="form-group small">
                    <label>Código</label>
                    <input v-model="row.hole_code" />
                </div>
                <div class="form-group half">
                    <label>Terreno</label>
                    <select v-model="row.terrain">
                        <option value="N">Normal</option>
                        <option value="R">Relleno</option>
                        <option value="F">Fracturado</option>
                        <option value="V">Vacíos</option>
                        <option value="A">Agua</option>
                        <option value="M">Madera</option>
                    </select>
                </div>
                <div class="form-group small">
                    <label>Alt. Diseño</label>
                    <input type="number" step="0.1" v-model="row.design_ht" />
                </div>
                <div class="form-group small">
                    <label>Alt. Real</label>
                    <input type="number" step="0.1" v-model="row.real_ht" />
                </div>
                <div class="form-group small">
                    <label>Alt. Verif.</label>
                    <input type="number" step="0.1" v-model="row.verified_ht" />
                </div>
                <div class="form-group half">
                    <label>Tipos de Taladro</label>
                    <select v-model="row.drill_types">
                        <option value="P">P</option>
                        <option value="PC">PC</option>
                        <option value="SH">SH</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B3">B3</option>
                        <option value="B4">B4</option>
                        <option value="CT">CT</option>
                        <option value="FT">FT</option>
                        <option value="PS">PS</option>
                        <option value="EX">EX</option>
                        <option value="TS">TS</option>
                        <option value="TH">TH</option>
                        <option value="TCS">TCS</option>
                    </select>
                </div>
                <div class="form-group half">
                    <label>Dureza Roca</label>
                    <select v-model="row.rock_hardness">
                        <option value="S">Suave</option>
                        <option value="M">Medio</option>
                        <option value="D">Duro</option>
                    </select>
                </div>
                <div class="form-group small">
                    <label>Inicio</label>
                    <input type="time" v-model="row.start_time" />
                </div>
                <div class="form-group small">
                    <label>Fin</label>
                    <input type="time" v-model="row.end_time" />
                </div>
                <div class="form-group half">
                    <label>OBS</label>
                    <select v-model="row.obs">
                        <option value="R1">R1 (Original)</option>
                        <option value="R1(NO)">R1 (No Original)</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Comentarios</label>
                    <input v-model="row.comments" class="w-50" />
                </div>
            </div>
        </div>

        <button type="button" @click="addRow" class="btn-add">+ Agregar</button>
    </div>
</template>

<style scoped>
.cards-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.drill-card {
    border: 1px solid #dcdfe6;
    border-radius: 12px;
    padding: 16px;
    background: white;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    transition:
        transform 0.15s ease,
        box-shadow 0.15s ease;
}

.drill-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.drill-card h3 {
    margin-bottom: 14px;
    color: #1565c0;
    font-size: 1.15rem;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 6px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    margin-bottom: 10px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: 600;
    font-size: 0.75rem;
    margin-bottom: 3px;
    color: #616161;
}

input,
select {
    width: 100%;
    padding: 6px 8px;
    font-size: 0.85rem;
    border: 1px solid #cfd8dc;
    border-radius: 6px;
    background: #fafafa;
    transition: all 0.2s ease;
}

input:focus,
select:focus {
    outline: none;
    border-color: #42a5f5;
    background: white;
    box-shadow: 0 0 4px rgba(66, 165, 245, 0.3);
}

.btn-add {
    align-self: flex-start;
    background: #1565c0;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s ease;
}

.btn-add:hover {
    background: #0d47a1;
}
</style>
