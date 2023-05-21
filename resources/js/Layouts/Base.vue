<template>
    <div id="main-layout">
        <QToolbar>
            <QToolbarTitle>InertiaJS</QToolbarTitle>
            <QSpace></QSpace>
            <QTabs>
                <QTab name="hello" label="Hello"/>
            </QTabs>
        </QToolbar>
        <div class="q-px-md">
            <slot></slot>
        </div>
    </div>
</template>
