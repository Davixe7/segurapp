<template>
    <div id="bills">
        <q-table
            square
            title="Facturas"
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
                <q-td :props="props" class="q-gutter-x-xs text-grey">
                    <q-btn size="12px" flat round icon="edit" @click="()=>{bill=props.row;}"></q-btn>
                    <q-btn size="12px" flat round icon="delete"></q-btn>
                </q-td>
            </template>
        </q-table>

        <q-page-sticky position="bottom-right" :offset="[18, 18]">
            <Link href="/bills/create">
                <q-btn fab icon="add" color="primary">
            </q-btn>
            </Link>
        </q-page-sticky>

        <!-- <CreateBill :bill="bill" :apartment="apartment">
        </CreateBill> -->
    </div>
</template>

<script setup>
// import CreateBill from './CreateBill.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
const props = defineProps({
    bills: Array,
})
const dialog = ref(true)
const bill = ref({})
const rows = ref([])
const columns = [
    { name: 'created_at', field: 'created_at', label: 'Fecha de registro', align: 'left' },
    { name: 'title', field: 'title', label: 'Concepto', align: 'left' },
    { name: 'amount', field: 'amount', label: 'Monto', align: 'left' },
    { name: 'starts_at', field: 'starts_at', label: 'Empieza el', align: 'left' },
    { name: 'expires_at', field: 'expires_at', label: 'Vence el', align: 'left' },
    { name: 'actions', label: '' },
]
const search = ref('')

watch(() => props.bills, (newVal) => {rows.value = [...newVal]})
onMounted(() => rows.value = props.bills)
</script>
