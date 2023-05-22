import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import { Quasar, Notify } from 'quasar'
import quasarLang from 'quasar/lang/es'
import quasarIconSet from 'quasar/icon-set/material-symbols-outlined'

import Base from './Layouts/Base.vue'

import '@quasar/extras/roboto-font/roboto-font.css'
import '@quasar/extras/material-icons/material-icons.css'
import '@quasar/extras/material-symbols-outlined/material-symbols-outlined.css'
import 'quasar/src/css/index.sass'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page  = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Base
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Quasar, {
        plugins: {Notify}, // import Quasar plugins and add here
        lang: quasarLang,
        iconSet: quasarIconSet,
        /*
        config: {
          brand: {
            // primary: '#e46262',
            // ... or all other brand colors
          },
          notify: {...}, // default set of options for Notify Quasar plugin
          loading: {...}, // default set of options for Loading Quasar plugin
          loadingBar: { ... }, // settings for LoadingBar Quasar plugin
          // ..and many more (check Installation card on each Quasar component/directive/plugin)
        }
        */
      })
      .mount(el)
  },
})
