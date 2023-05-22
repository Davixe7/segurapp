<template>
    <div id="create-apartment">
        <form @submit.prevent="submit">
            <q-card>
                <q-card-section>
                    <div class="text-subtitle1">
                        Detalle del apartamento
                    </div>
                </q-card-section>
                <q-card-section>
                    <q-input stack-label v-model="form.name" label="Número de la vivienda" :error="form.errors.name"
                        :error-message="form.errors.name">
                    </q-input>
                </q-card-section>
                <q-card-actions>
                    <q-btn class="q-ml-auto" flat type="submit" :loading="form.processing">Guardar</q-btn>
                </q-card-actions>
            </q-card>
        </form>
    </div>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { onMounted, watch } from 'vue';

    const $q = useQuasar()
    const emit = defineEmits(['apartmentCreated', 'apartmentUpdated'])
    const props = defineProps({
        apartment: Object
    })

    const form = useForm({
        id: null,
        name: '',
        residence_id: null
    })

    function setApartment(){
        form.defaults({...props.apartment})
        form.reset()
    }

    function submit(){
        if( form.id ){
            form.put(`/apartments/${form.id}`, {onSuccess: () => $q.notify('Guardado exitosamente!')})
            emit('apartmentUpdated')
            return
        }
        form.post(`/apartments`, {onSuccess: () => $q.notify('Guardado exitosamente!')})
        emit('apartmentCreated')
    }

    watch(()     => props.apartment, (newVal) => setApartment())
    onMounted(() => setApartment())

</script>
