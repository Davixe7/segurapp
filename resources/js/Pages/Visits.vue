<template>
    <div id="visits">
        <q-table
            title="Visitas al conjunto"
            :filter="search"
            :columns="columns"
            :rows="rows"
            :pagination="{rowsPerPage: 15}">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({visits: Array})
const rows = ref([])
const columns = [
    { name: 'created_at', field: 'created_at', label: 'Fecha y hora', align: 'left' },
    { name: 'dni', field: 'dni', label: 'Cédula', align: 'left' },
    { name: 'name', field: 'name', label: 'Nombre', align: 'left' },
    { name: 'plate', field: 'plate', label: 'Placa', align: 'left' },
    { name: 'apartment', field: row => row.apartment ? row.apartment.name : '', label: 'Apartamento', align: 'right' },
    { name: 'actions', label: '' },
]
const search = ref('')
onMounted(() => rows.value = props.visits)
</script>
