<template>
    <div id="visits">
        <q-table title="Novedades" :filter="search" :columns="columns" :rows="rows" :pagination="{ rowsPerPage: 15 }">
            <template v-slot:top-right>
                <q-input borderless dense debounce="300" v-model="search" placeholder="Buscar">
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                </q-input>
            </template>
            <template v-slot:body-cell-status="props">
                <q-td>
                    <div class="flex">
                        <q-badge color="green" v-if="props.row.closed_at">Cerrado</q-badge>
                        <q-badge color="primary" v-else-if="props.row.read_at">Leído</q-badge>
                        <q-badge color="grey" v-else>Pendiente</q-badge>
                    </div>
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td class="text-grey q-gutter-x-xs">
                    <div class="flex justify-end">
                        <q-btn round flat icon="reply" @click="() => { setReport(props.row); dialog = true }"></q-btn>
                        <q-btn round flat icon="done_all"></q-btn>
                    </div>
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="dialog" :autoclose="false">
            <q-card flat style="width: 420px;">
                <form @submit.prevent="submit">
                <q-card-section>
                    Detalles la novedad
                </q-card-section>
                <q-list separator class="q-pa-none">
                    <q-item v-if="report.apartment_id">
                        <q-item-section>
                            <q-item-label>Apartamento</q-item-label>
                            <q-item-label caption>{{ report.apartment.name }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item class="q-gutter-col-x-md">
                        <q-item-section>
                            <q-item-label>Creada el</q-item-label>
                            <q-item-label caption>{{ report.created_at }}</q-item-label>
                        </q-item-section>
                        <q-item-section v-if="report.read_at">
                            <q-item-label>Leida el</q-item-label>
                            <q-item-label caption>{{ report.read_at }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item>
                        <q-item-section>
                            <q-item-label>Descripción</q-item-label>
                            <q-item-label caption>{{ report.description }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item v-if="report.response">
                        <q-item-section>
                            <q-item-label>Respuesta enviada</q-item-label>
                            <q-item-label caption>{{ report.response }}</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
                </form>
            </q-card>
        </q-dialog>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { ref, watch, onMounted } from 'vue';

function setReport(row){
    report.value = {...row}
    form.defaults({...report.value})
    form.reset()
}

const form = useForm({
    description: '',
    read_at: '',
})
const $q = useQuasar()
const dialog = ref(false)
const report = ref({})
const props = defineProps({ reports: Array })
const rows = ref([])
const columns = [
    { name: 'created_at', field: 'created_at', label: 'Fecha y hora', align: 'left' },
    { name: 'description', field: 'description', label: 'Descripción', align: 'left' },
    { name: 'status', label: 'Estado', align: 'left' },
    { name: 'actions', label: '', align: 'right' },
]
const search = ref('')
watch(() => props.reports, (newVal) => rows.value = JSON.parse(JSON.stringify(newVal)))
onMounted(() => rows.value = props.reports)

function submit(){
    form.put(`/reports/${report.value.id}`, {
        onSuccess: () => {$q.notify('Actualizado con éxito');dialog.value = false}
    })
}
</script>
