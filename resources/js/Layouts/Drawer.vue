<template>
    <q-scroll-area class="fit">
        <q-list class="text-grey drawer">
            <q-item clickable v-ripple :active="link === 'dashboard'" @click="link = 'dashboard'" active-class="active">
                <q-item-section avatar>
                    <q-icon name="dashboard" />
                </q-item-section>
                <q-item-section>
                    <Link href="/home">Inicio</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'apartments'" @click="link = 'apartments'" active-class="active">
                <q-item-section avatar>
                    <q-icon name="meeting_room" />
                </q-item-section>
                <q-item-section>
                    <Link href="/apartments">Apartamentos</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'porterias'" @click="link = 'porterias'" active-class="active"
                bordered>
                <q-item-section avatar>
                    <q-icon name="door_sliding" />
                </q-item-section>
                <q-item-section>
                    <Link href="/porterias">Porterias</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'novelties'" @click="link = 'novelties'" active-class="active">
                <q-item-section avatar>
                    <q-icon name="assignment" />
                </q-item-section>
                <q-item-section>
                    <Link href="/reports">Novedades</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'visits'" @click="link = 'visits'" active-class="active" bordered>
                <q-item-section avatar>
                    <q-icon name="directions_walk" />
                </q-item-section>
                <q-item-section>
                    <Link href="/visits">Visitas</Link>
                </q-item-section>
            </q-item>
            <q-separator class="q-my-sm"></q-separator>
            <q-item clickable v-ripple :active="link === 'billboard'" @click="link = 'billboard'" active-class="active"
                bordered>
                <q-item-section avatar>
                    <q-icon name="newspaper" />
                </q-item-section>
                <q-item-section>
                    <Link href="/posts">Noticias</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'documents'" @click="link = 'documents'" active-class="active"
                bordered>
                <q-item-section avatar>
                    <q-icon name="book" />
                </q-item-section>
                <q-item-section>
                    <Link href="/documents">Manuales & Docs</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'bill'" @click="link = 'bill'" active-class="active"
                bordered>
                <q-item-section avatar>
                    <q-icon name="receipt_long" />
                </q-item-section>
                <q-item-section>
                    <Link href="/bills">Facturas</Link>
                </q-item-section>
            </q-item>
            <q-separator class="q-my-sm"></q-separator>
            <q-item clickable v-ripple :active="link === 'contacts'" @click="link = 'contacts'" active-class="active" bordered>
                <q-item-section avatar>
                    <q-icon name="import_contacts" />
                </q-item-section>
                <q-item-section>
                    <Link href="/contacts">Directorio</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'message'" @click="link = 'message'" active-class="active"
                bordered>
                <q-item-section avatar>
                    <q-icon name="message" />
                </q-item-section>
                <q-item-section>
                    <Link href="/messages">Mensajeria</Link>
                </q-item-section>
            </q-item>
            <q-item clickable v-ripple :active="link === 'pqrs'" @click="link = 'pqrs'" active-class="active" bordered>
                <q-item-section avatar>
                    <q-icon name="hearing" />
                </q-item-section>
                <q-item-section>
                    <Link href="/complaints">PQRS</Link>
                </q-item-section>
            </q-item>
        </q-list>
    </q-scroll-area>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'
const link = ref('')
</script>

<style lang="scss">
.q-list {
    padding: 12px 24px 0 12px;
}

.q-drawer .q-item {
    padding: 0 12px;
    min-height: 40px;
    border-radius: 10px;
}

.q-item__section--avatar {
    min-width: 24px !important;
}

.q-item__section--side {
    padding-right: 24px !important;
}

.q-item.q-router-link--active,
.q-item--active {
    font-weight: 500;
    color: var(--q-primary);
    background: #f1f7fc;
}</style>
