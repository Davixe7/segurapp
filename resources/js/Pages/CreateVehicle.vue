<template>
    <div id="create-resident">
        <q-card>
            <form @submit.prevent="submit">
                <q-card-section>
                    <div class="text-subtitle1">
                        Detalle del vehículo
                    </div>
                </q-card-section>
                <q-card-section class="q-gutter-y-md">
                    <q-input stack-label v-model="form.plate" label="Placa" :error="form.errors.plate"
                        :error-message="form.errors.plate">
                    </q-input>
                    <div class="row q-gutter-x-md">
                        <div class="col">
                            <q-select
                                stack-label
                                v-model="form.type"
                                label="Tipo"
                                :emit-value="true"
                                option-value="value"
                                :map-options="true"
                                :error="form.errors.type"
                                :error-message="form.errors.type"
                                :options="[{label: 'Moto', value: 'bike'}, {label:'Carro', value:'car'}, {label:'Camioneta', value:'truck'}]"
                            >
                            </q-select>
                        </div>
                        <div class="col">
                            <q-input stack-label v-model="form.color" label="Color" :error="form.errors.color" :error-message="form.errors.color"></q-input>
                        </div>
                    </div>
                    <div class="row q-gutter-x-md">
                        <div class="col">
                            <q-input stack-label v-model="form.brand" label="Marca" :error="form.errors.brand"
                                :error-message="form.errors.brand"></q-input>
                        </div>
                        <div class="col">
                            <q-input stack-label v-model="form.model" label="Modelo" :error="form.errors.model"
                                :error-message="form.errors.model"></q-input>
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

function setVehicle() {
    form.defaults({ ...props.vehicle, apartment_id: props.apartment.id })
    form.reset()
}

watch(() => props.vehicle, (newVal) => setVehicle())
onMounted(() => setVehicle())

const $q = useQuasar()
const emit = defineEmits(['vehicleCreated', 'vehicleUpdated'])
const props = defineProps({
    vehicle: Object,
    apartment: Object
})

const form = useForm({
    id: null,
    plate: null,
    type: null,
    brand: null,
    model: null,
    color: null,
    apartment_id: null
})

function submit() {
    if (form.id) {
        form.put(`/vehicles/${form.id}`,{
            onSuccess: ()=>$q.notify('Guardado exitosamente!'),
            only: ['residents', 'vehicles'],
            preserveState: true
        })
        return
    }
    form
    .transform(data => ({ ...data, apartment_id: props.apartment.id }))
    .post('/vehicles',{
        onSuccess: ()=> $q.notify('Guardado exitosamente!'),
        only: ['residents', 'vehicles'],
        preserveState: true
    })
}
</script>
