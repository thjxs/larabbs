import Vue from 'vue'
import Vuex from 'vuex'
import AuthUser from './modules/auth'
import myPlugin from './plugins/subscribe'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        AuthUser
    },
    plugins: [ myPlugin ]
})

export default store
