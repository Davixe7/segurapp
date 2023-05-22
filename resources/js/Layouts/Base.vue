<template>
    <div id="main-layout">
        <QLayout view="hHh lpR lff">
            <q-header>
                <QToolbar>
                    <QBtn icon="menu" flat round @click="drawerLeft = !drawerLeft"></QBtn>
                    <QToolbarTitle>Segurapp</QToolbarTitle>
                    <QSpace></QSpace>
                    <QBtn flat rounded>Hello</QBtn>
                </QToolbar>
            </q-header>

            <q-drawer v-model="drawerLeft" :width="240" bordered>
                <Drawer></Drawer>
            </q-drawer>

            <q-page-container>
                <q-page class="q-pa-md">
                    <slot></slot>
                </q-page>
            </q-page-container>
        </QLayout>
    </div>
</template>

<style>
    a {
        text-decoration: none;
        color: inherit;
    }
</style>

<script setup>
import Drawer from './Drawer.vue';
import { ref } from 'vue';

const drawerLeft = ref(false)
const link = ref('porterias')
</script>
