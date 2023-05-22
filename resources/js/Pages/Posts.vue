<template>
    <div id="posts">
        <q-table
            title="Cartelera"
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
            <template v-slot:body-cell-actions="props">
                <q-td class="flex q-gutter-x-xs text-grey">
                    <div class="q-ml-auto">
                        <q-btn size="12px" flat round icon="edit"></q-btn>
                        <q-btn size="12px" flat round icon="delete"></q-btn>
                    </div>
                </q-td>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({posts: Array})
const rows = ref([])
const columns = [
    { name: 'created_at', field: 'created_at', label: 'Fecha y hora', align: 'left' },
    { name: 'title', field: 'title', label: 'Título', align: 'left' },
    { name: 'description', field: row => row.description.substr(0,40), label: 'Cuerpo', align: 'left' },
    { name: 'status', field: 'status', label: 'Status', align: 'left' },
    { name: 'actions', label: '', align: 'right' },
]
const search = ref('')
onMounted(() => rows.value = props.posts)
</script>
