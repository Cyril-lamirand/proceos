import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
import './plugins/axios'
import './plugins/bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './i18n'
// FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUserCircle } from '@fortawesome/free-solid-svg-icons'
import { faSearch} from "@fortawesome/free-solid-svg-icons/faSearch"

library.add(faUserCircle)
library.add(faSearch)

Vue.component('font-awesome-icon', FontAwesomeIcon)
// Bootstrap
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
// Vue i18n

Vue.config.productionTip = false

// Route Guard
router.beforeEach((to, from, next) => {
  let language = to.params.lang
  if (!language) {
    language = 'fr'
  }
  i18n.locale = language
  next()
})

new Vue({
  router,
  store,
  i18n,
  render: h => h(App)
}).$mount('#app')
