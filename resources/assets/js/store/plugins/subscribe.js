import { setToken as httpSetToken } from '../../utils/http'
import * as TYPES from '../modules/auth/mutations-types'

const subscribe = (store) => {
    store.subscribe((mutation, state) => {
        if (TYPES.SET_TOKEN === mutation.type) {
            httpSetToken(state.AuthUser.token);
            window.localStorage.setItem('access_token', state.AuthUser.token);
        }
    })
}

export default (store) => {
    subscribe(store)
}
