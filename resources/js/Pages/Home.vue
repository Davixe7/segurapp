<template>
    <div class="page-home">
        <QList bordered>
            <QItem>
                <QItemSection>
                    <div class="text-subtitle1 font-weight-medium">Visitas</div>
                </QItemSection>
                <QItemSection top side>
                    <div class="text-grey q-gutter-xs">
                        <QBtn size="12px" flat round icon="arrow_forward"></QBtn>
                        <QBtn size="12px" flat round icon="add"></QBtn>
                    </div>
                </QItemSection>
            </QItem>
            <QSeparator spaced></QSeparator>
            <QItem>
                <QItemSection>
                    <div class="text-subtitle1 font-weight-medium">Novedades</div>
                </QItemSection>
                <QItemSection top side>
                    <div class="text-grey q-gutter-xs">
                        <QBtn size="12px" flat round icon="arrow_forward"></QBtn>
                        <QBtn size="12px" flat round icon="add"></QBtn>
                    </div>
                </QItemSection>
            </QItem>
            <QSeparator spaced></QSeparator>
            <QItem>
                <QItemSection>
                    <div class="text-subtitle1 font-weight-medium">Enviar notificación</div>
                </QItemSection>
                <QItemSection top side>
                    <div class="text-grey q-gutter-xs">
                        <QBtn size="12px" flat round icon="arrow_forward"></QBtn>
                        <QBtn size="12px" flat round icon="add"></QBtn>
                    </div>
                </QItemSection>
            </QItem>
            <QSeparator spaced></QSeparator>
            <QItem>
                <QItemSection>
                    <div class="text-subtitle1 font-weight-medium">Visitas</div>
                </QItemSection>
                <QItemSection top side>
                    <div class="text-grey q-gutter-xs">
                        <QBtn size="12px" flat round icon="arrow_forward"></QBtn>
                        <QBtn size="12px" flat round icon="add"></QBtn>
                    </div>
                </QItemSection>
            </QItem>
        </QList>
    </div>
</template>

<script setup>
defineProps({ user: Object })
</script>
