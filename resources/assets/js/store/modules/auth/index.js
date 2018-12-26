import * as actions from './actions'
import mutations from './mutations'

export default {
    state: {
        user: {},
        token: null
    },
    actions,
    getters: {
        authToken: ({ token }) => token,
        currentUser: ({ user }) => user
    },
    mutations,
}
