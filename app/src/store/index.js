import Vue from 'vue'
import Vuex from 'vuex'
// Modules
import settings from './modules/settings'
// Plugins
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    settings
  },
  plugins: [createPersistedState({
    paths: ['settings']
  })]
})
