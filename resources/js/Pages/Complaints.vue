<template>
    <div id="visits">
        <q-table title="PQRS" :filter="search" :columns="columns" :rows="rows" :pagination="{ rowsPerPage: 15 }">
            <template v-slot:top-right>
                <q-btn color="primary" flat rounded size="12px" icon="qr_code" class="q-mr-lg active bg-blue-1">Descargar Código QR</q-btn>
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
                        <q-btn round flat icon="reply" @click="() => { setComplaint(props.row); dialog = true }"></q-btn>
                        <q-btn round flat icon="done_all"></q-btn>
                    </div>
                </q-td>
            </template>
        </q-table>

        <q-dialog v-model="dialog" :autoclose="false">
            <q-card flat style="width: 420px;">
                <form @submit.prevent="submit">
                <q-card-section>
                    Detalles del PQRS
                </q-card-section>
                <q-list separator class="q-pa-none">
                    <q-item v-if="complaint.apartment_id">
                        <q-item-section>
                            <q-item-label>Apartamento</q-item-label>
                            <q-item-label caption>{{ complaint.apartment.name }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item class="q-gutter-col-x-md">
                        <q-item-section>
                            <q-item-label>Creado el</q-item-label>
                            <q-item-label caption>{{ complaint.created_at }}</q-item-label>
                        </q-item-section>
                        <q-item-section v-if="complaint.closed_at">
                            <q-item-label>Cerrado el</q-item-label>
                            <q-item-label caption>{{ complaint.closed_at }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item>
                        <q-item-section>
                            <q-item-label>Nombre</q-item-label>
                            <q-item-label caption>{{ complaint.name }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item>
                        <q-item-section>
                            <q-item-label>Teléfono</q-item-label>
                            <q-item-label caption>{{ complaint.phone }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item>
                        <q-item-section>
                            <q-item-label>Asunto</q-item-label>
                            <q-item-label caption>{{ complaint.title }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item>
                        <q-item-section>
                            <q-item-label>Descripción</q-item-label>
                            <q-item-label caption>{{ complaint.description }}</q-item-label>
                        </q-item-section>
                    </q-item>
                    <q-item v-if="complaint.response">
                        <q-item-section>
                            <q-item-label>Respuesta enviada</q-item-label>
                            <q-item-label caption>{{ complaint.response }}</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>

                <q-card-actions class="bg-grey-2" v-if="!complaint.response">
                    <div class="row" style="width: 100%;">
                        <q-input filled dense standout autogrow bg-color="white" v-model="form.response"
                            style="width: 70%;"></q-input>
                        <q-btn type="submit" flat class="q-ml-auto" style="width: 30%;">Responder</q-btn>
                    </div>
                </q-card-actions>

                </form>
            </q-card>
        </q-dialog>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { ref, watch, onMounted } from 'vue';

function setComplaint(row){
    complaint.value = {...row}
    form.defaults({...complaint.value})
    form.reset()
}

const form = useForm({
    name: '',
    phone: '',
    title: '',
    description: '',
    response: '',
})
const $q = useQuasar()
const dialog = ref(false)
const complaint = ref({})
const props = defineProps({ complaints: Array })
const rows = ref([])
const columns = [
    { name: 'created_at', field: 'created_at', label: 'Fecha y hora', align: 'left' },
    { name: 'name', field: 'name', label: 'Nombre', align: 'left' },
    { name: 'phone', field: 'phone', label: 'Teléfono', align: 'left' },
    { name: 'subject', field: 'title', label: 'Asunto', align: 'left' },
    { name: 'status', label: 'Estado', align: 'left' },
    { name: 'actions', label: '', align: 'right' },
]
const search = ref('')
watch(() => props.complaints, (newVal) => rows.value = JSON.parse(JSON.stringify(newVal)))
onMounted(() => rows.value = props.complaints)

function submit(){
    form.put(`/complaints/${complaint.value.id}`, {
        onSuccess: () => {
            $q.notify('Actualizado con éxito')
            dialog.value = false
        }
    })
}
</script>
