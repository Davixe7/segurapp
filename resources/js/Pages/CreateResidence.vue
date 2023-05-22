<template>
    <div id="create-form">
        <form @submit.prevent="submit">
            <q-card style="width: 420px;">
                <q-card-section>
                    <div class="text-subtitle2">
                        Detalle de la residencia
                    </div>
                </q-card-section>
                <q-card-section class="q-gutter-y-md">
                    <q-input
                        stack-label
                        v-model="form.name"
                        label="Nombre"
                        :error="Boolean(form.errors.name)"
                        :error-message="form.errors.name">
                    </q-input>
                    <q-input stack-label v-model="form.phone" label="Teléfono"
                    :error="Boolean(form.errors.phone)"
                    :error-message="form.errors.phone">
                    </q-input>
                    <q-input stack-label v-model="form.address" label="Dirección"
                    :error="Boolean(form.errors.address)"
                    :error-message="form.errors.address">
                    </q-input>
                </q-card-section>
                <q-card-section>
                    <div class="text-subtitle2">Información del usuario</div>
                </q-card-section>
                <q-card-section v-if="form.user">
                    <div class="q-gutter-y-md">
                        <q-input stack-label v-model="form.user.name" label="Nombre"
                        :error="Boolean(form.errors['user.name'])"
                    :error-message="form.errors['user.name']">
                        </q-input>
                        <q-input stack-label v-model="form.user.email" label="Email"
                        :error="Boolean(form.errors['user.email'])"
                    :error-message="form.errors['user.email']">
                        </q-input>
                        <q-input stack-label v-model="form.user.password" label="Contraseña"
                        :error="Boolean(form.errors['user.password'])"
                    :error-message="form.errors['user.password']">
                        </q-input>
                    </div>
                </q-card-section>
                <q-card-actions>
                    <q-btn flat type="submit" class="q-ml-auto" :loading="form.processing">
                        Guardar
                    </q-btn>
                </q-card-actions>
            </q-card>
        </form>
    </div>
</template>

<script setup>
import { useQuasar } from 'quasar'
import { router, useForm } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';

const emit = defineEmits(['residenceCreated', 'residenceUpdated'])
const $q = useQuasar()

const props = defineProps({
    residence: Object
})

function submit(){
    if( form.id ){
        form.put(`/residences/${form.id}`,{onSuccess: () => emit('residenceUpdated')})
        $q.notify({type: 'positive', message: 'Guardado exitosamente'})
        return
    }
    form.post(`/residences`,{onSuccess: () => emit('residenceCreated')})
    $q.notify({type: 'positive', message: 'Guardado exitosamente'})
}

const form  = useForm({
    name: '',
    address: '',
    phone: '',
    user: {}
})

watch(()=>props.residence, (newVal) => {
    form.defaults({...newVal})
})

onMounted(() => {
    form.defaults({...props.residence})
    form.reset()
})
</script>
