<template>
    <div id="create-resident">
        <q-card style="width: 420px">
            <form @submit.prevent="submit">
                <q-card-section>
                    <div class="text-subtitle1">
                        Detalle del residente
                    </div>
                </q-card-section>
                <q-card-section class="q-gutter-y-md">
                    <q-input stack-label v-model="form.dni" label="Cédula de identidad" :error="form.errors.dni"
                        :error-message="form.errors.dni">
                    </q-input>
                    <q-input stack-label v-model="form.name" label="Nombre" :error="form.errors.name"
                        :error-message="form.errors.name">
                    </q-input>
                    <div class="row q-gutter-x-md">
                        <div class="col">
                            <q-input stack-label v-model="form.age" label="Edad" :error="form.errors.age"
                                :error-message="form.errors.age"></q-input>
                        </div>
                        <div class="col">
                            <q-select stack-label v-model="form.gender" :options="['m', 'f']" label="Género"
                                :error="form.errors.gender" :error-message="form.errors.gender"></q-select>
                        </div>
                    </div>
                </q-card-section>
                <q-card-actions>
                    <q-btn class="q-ml-auto" flat type="submit" :loading="form.processing">Guardar</q-btn>
                </q-card-actions>
                <q-input type="hidden" class="hidden" v-model="form.apartment_id" value="apartment.id"></q-input>
            </form>
        </q-card>

    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { onMounted, watch } from 'vue';

function setResident() {
    form.defaults({ ...props.resident, apartment_id: props.apartment.id })
    form.reset()
}

watch(() => props.resident, (newVal) => setResident())
onMounted(() => setResident())

const $q = useQuasar()
const emit = defineEmits(['residentCreated', 'residentUpdated'])
const props = defineProps({
    resident: Object,
    apartment: Object
})

const form = useForm({
    id: null,
    dni: null,
    gender: null,
    age: null,
    name: '',
    apartment_id: null
})

function submit() {
    if (form.id) {
        form.put(`/residents/${form.id}`,{
            onSucces: ()=>$q.notify('Guardado exitosamente!'),
            only: ['residents'],
            preserveState: true
        })
        return
    }
    form
    .transform(data => ({ ...data, apartment_id: props.apartment.id }))
    .post('/residents',{
        onSuccess: ()=> $q.notify('Guardado exitosamente!'),
        only: ['residents'],
        preserveState: true
    })
}
</script>
