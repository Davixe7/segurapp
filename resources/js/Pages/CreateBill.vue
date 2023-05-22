<template>
    <div id="create-bill">
        <q-card>
            <form @submit.prevent="submit">
                <q-card-section>
                    <div class="text-h6 text-weight-regular">Registrar factura</div>
                </q-card-section>
                <q-card-section class="q-gutter-y-md">
                    <q-input stack-label v-model="form.title" label="Concepto" :error="form.errors.title"
                        :error-message="form.errors.title">
                    </q-input>

                    <q-input stack-label v-model="form.description" label="Descripción" :error="form.errors.description"
                        :error-message="form.errors.description">
                    </q-input>

                    <q-input stack-label v-model="form.amount" label="Importe" :error="form.errors.amount"
                        :error-message="form.errors.amount">
                    </q-input>

                    <div class="row q-col-gutter-x-md">
                        <div class="col">
                            <q-input stack-label v-model="form.starts_at" label="Inicia el">
                                <template v-slot:append>
                                    <q-icon name="event" class="cursor-pointer">
                                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                            <q-date v-model="form.starts_at" mask="YYYY-MM-DD">
                                                <div class="row items-center justify-end">
                                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                                </div>
                                            </q-date>
                                        </q-popup-proxy>
                                    </q-icon>
                                </template>
                            </q-input>
                        </div>
                        <div class="col">
                            <q-input stack-label v-model="form.expires_at" label="Expíra el">
                                <template v-slot:append>
                                    <q-icon name="event" class="cursor-pointer">
                                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                            <q-date v-model="form.expires_at" mask="YYYY-MM-DD">
                                                <div class="row items-center justify-end">
                                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                                </div>
                                            </q-date>
                                        </q-popup-proxy>
                                    </q-icon>
                                </template>
                            </q-input>
                        </div>
                    </div>
                </q-card-section>
                <q-card-actions class="flex">
                    <q-btn type="submit" flat class="q-ml-auto" :loading="form.processing">
                        Guardar
                    </q-btn>
                </q-card-actions>
            </form>
        </q-card>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
const $q = useQuasar()
const props = defineProps({ bill: Object })
const form = useForm({
    title: '',
    description: '',
    amount: 0,
    starts_at: new Date(),
    expires_at: new Date(),
})
function submit() {
    form.post('/bills', { onSuccess() { $q.notify('Guardado exitosamente') } })
}
</script>
