<template>
    <div id="apartments">
        <q-table
            bordered
            title="Apartamentos"
            :filter="search"
            :columns="columns"
            :rows="rows"
            :pagination="{rowsPerPage: 10}">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props" class="q-gutter-x-xs text-grey">
                    <q-btn size="12px" flat round icon="directions_car" @click="()=>{apartment=props.row; vehiclesDialog=true;}"></q-btn>
                    <q-btn size="12px" flat round icon="supervisor_account" @click="()=>{apartment=props.row; residentsDialog=true;}"></q-btn>
                    <q-btn size="12px" flat round icon="edit" @click="()=>{apartment=props.row; dialog=true;}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="dialog">
            <CreateApartment :apartment="apartment" @apartmentCreated="dialog=false" @apartmentUpdated="dialog=false">
            </CreateApartment>
        </q-dialog>

        <q-dialog v-model="residentsDialog">
            <Residents :residents="apartment.residents" :apartment="apartment"></Residents>
        </q-dialog>

        <q-dialog v-model="vehiclesDialog">
            <Vehicles :vehicles="apartment.vehicles" :apartment="apartment"></Vehicles>
        </q-dialog>

        <div style="position: fixed; bottom: 18px; right: 18px;">
            <q-btn fab icon="add" color="accent" @click="()=>{dialog=true; apartment={}}"></q-btn>
        </div>
    </div>
</template>

<script setup>
import Residents from './Residents.vue';
import Vehicles from './Vehicles.vue';
import CreateApartment from './CreateApartment.vue'

import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    apartments: {type: Array, default:()=>[]},
    residents: {type: Array, default:()=>[]},
    vehicles: {type: Array, default:()=>[]},
})

const dialog          = ref(false)
const residentsDialog = ref(false)
const vehiclesDialog  = ref(false)

const apartment = ref({})
const rows      = ref([])
const columns   = [
    {name: 'name', field: 'name', label: 'Nombre', align: 'left'},
    {name: 'actions', label: ''},
]
const search  = ref('')

watch(() => props.vehicles, (newVal)   => apartment.value.vehicles = JSON.parse( JSON.stringify([...newVal]) ))
watch(() => props.apartments, (newVal) => rows.value = [...newVal])
watch(() => props.residents,  (newVal) => apartment.value.residents = JSON.parse( JSON.stringify([...newVal]) ))
onMounted(()   => rows.value = props.apartments)
</script>
