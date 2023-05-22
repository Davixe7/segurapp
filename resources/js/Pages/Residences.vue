<template>
    <div id="residences">
        <q-table bordered title="Unidades residenciales" :filter="search" :columns="columns" :rows="rows"
            :pagination="{ rowsPerPage: 20 }">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props" class="q-gutter-x-xs text-grey">
                    <q-btn size="12px" flat round icon="edit" @click="()=>{residence=props.row; dialog=true}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>

        <div class="q-mb-md">
            <q-btn @click="()=>{dialog=true; residence= {}}" fab icon="add" color="accent" style="position: fixed; bottom: 18px; right: 18px; z-index: 1000;" />
        </div>

        <q-dialog v-model="dialog">
            <CreateResidence :residence="residence" @residenceCreated="dialog=false" @residenceUpdated="dialog=false"></CreateResidence>
        </q-dialog>
    </div>
</template>

<script setup>
import CreateResidence from './CreateResidence.vue';
import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    residences: Array,
})
const dialog = ref(true)
const residence = ref({})
const rows = ref([])
const columns = [
    { name: 'admin', field: row => row.user.name, label: 'Administrador', align: 'left' },
    { name: 'name', field: 'name', label: 'Nombre', align: 'left' },
    { name: 'address', field: 'address', label: 'Dirección', align: 'left' },
    { name: 'actions', label: '' },
]
const search = ref('')

watch(() => props.residences, (newVal) => {rows.value = [...newVal]})
onMounted(() => rows.value = props.residences)
</script>
