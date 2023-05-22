<template>
    <div id="porterias">
        <q-table
            bordered
            title="Porterias"
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
                    <q-btn size="12px" flat round icon="edit" @click="()=>{porteria=props.row; dialog=true;}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>

        <!-- <q-dialog v-model="dialog">
            <CreatePorteria :porteria="porteria" @porteriaCreated="dialog=false" @porteriaUpdated="dialog=false">
            </CreatePorteria>
        </q-dialog> -->

        <div style="position: fixed; bottom: 18px; right: 18px;">
            <q-btn fab icon="add" color="accent" @click="()=>{dialog=true; porteria={}}"></q-btn>
        </div>
    </div>
</template>

<script setup>
// import CreatePorteria from './CreatePorteria.vue'

import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    porterias: {type: Array, default:()=>[]},
})

const dialog          = ref(false)

const porteria = ref({})
const rows      = ref([])
const columns   = [
    {name: 'id', field: 'id', label: 'ID', align: 'left'},
    {name: 'name', field: 'name', label: 'Nombre', align: 'left'},
    {name: 'email', field: 'email', label: 'Email', align: 'left'},
    {name: 'actions', label: ''},
]
const search  = ref('')
watch(() => props.porterias, (newVal) => rows.value = [...newVal])
onMounted(()   => rows.value = props.porterias)
</script>
