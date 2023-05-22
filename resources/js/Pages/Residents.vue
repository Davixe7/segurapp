<template>
    <div id="residents">
        <q-table square title="Residentes" :filter="search" :columns="columns" :rows="rows" :hide-bottom="true" :pagination="{rowsPerPage: 15}">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props" class="q-gutter-x-xs text-grey">
                    <q-btn size="12px" flat round icon="edit" @click="()=>{resident=props.row;}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>

        </q-table>

        <CreateResident :resident="resident" :apartment="apartment">
        </CreateResident>
    </div>
</template>

<script setup>
import CreateResident from './CreateResident.vue';
import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    apartment: Object,
    residents: Array,
})
const dialog = ref(true)
const resident = ref({})
const rows = ref([])
const columns = [
    { name: 'dni', field: 'dni', label: 'Cédula', align: 'left' },
    { name: 'gender', field: 'gender', label: 'Sexo', align: 'left' },
    { name: 'name', field: 'name', label: 'Nombre', align: 'left' },
    { name: 'actions', label: '' },
]
const search = ref('')

watch(() => props.residents, (newVal) => {rows.value = [...newVal]})
onMounted(() => rows.value = props.residents)
</script>
