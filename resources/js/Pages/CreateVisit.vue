<template>
    <div id="visits-form">
        <form @submit.prevent="submit">
            <q-card>
                <q-card-section>
                    <div class="card-title">
                        Registrar visita
                    </div>
                </q-card-section>
                <q-card-section class="q-gutter-y-md">
                    <q-input stack-label v-model="visit.dni" label="Número de Cédula" :error="Boolean(errors.dni)"
                        :error-message="errors.dni">
                        <template v-slot:append>
                            <q-icon name="search" />
                        </template>
                    </q-input>
                    <q-input stack-label v-model="visit.name" label="Nombre y apellidos" :error="Boolean(errors.name)"
                        :error-message="errors.name">
                    </q-input>
                    <q-input stack-label v-model="visit.plate" label="Número de placa" :error="Boolean(errors.plate)"
                        :error-message="errors.plate">
                    </q-input>
                    <q-file stack-label v-model="visit.picture" label="Foto del visitante" :error="Boolean(errors.picture)"
                        :error-message="errors.picture">
                        <template v-slot:append>
                            <q-btn round flat icon="camera"></q-btn>
                        </template>
                    </q-file>
                </q-card-section>
                <q-card-actions>
                    <q-btn flat type="submit" class="q-ml-auto">
                        Enviar
                    </q-btn>
                </q-card-actions>
            </q-card>
        </form>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
const props = defineProps(
    {
        visit: Object,
        errors: Object
    }
)
const visit = ref({})
onMounted(() => visit.value = { ...props.visit })
</script>
