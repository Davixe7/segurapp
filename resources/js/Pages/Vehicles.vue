<template>
    <div id="vehicles">
        <q-table
            square
            title="Vehículos"
            :filter="search"
            :columns="columns"
            :rows="rows"
            :hide-bottom="true"
            :pagination="{rowsPerPage: 15}">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props" class="q-gutter-x-xs text-grey">
                    <q-btn size="12px" flat round icon="edit" @click="()=>{vehicle=props.row;}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>

        <CreateVehicle :vehicle="vehicle" :apartment="apartment">
        </CreateVehicle>
    </div>
</template>

<script setup>
import CreateVehicle from './CreateVehicle.vue';
import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    apartment: Object,
    vehicles: Array,
})

const vehicle = ref({})
const rows = ref([])
const columns = [
    { name: 'plate', field: 'plate', label: 'Placa', align: 'left' },
    { name: 'type', field: 'type', label: 'Tipo', align: 'left' },
    { name: 'color', field: 'color', label: 'Color', align: 'left' },
    { name: 'brand', field: 'brand', label: 'Marca', align: 'left' },
    { name: 'model', field: 'model', label: 'Modelo', align: 'left' },
    { name: 'actions', label: '' },
]
const search = ref('')

watch(() => props.vehicles, (newVal) => {rows.value = JSON.parse(JSON.stringify([...newVal]))})
onMounted(() => rows.value = props.vehicles)
</script>
