import { setToken as httpSetToken } from '../../../utils/http'
import * as TYPES from './mutations-types'

const subscribe = (store) => {
    console.log('??')
    store.subscribe((mutation, state) => {
        if (TYPES.SET_TOKEN === mutation.type) {
            httpSetToken(state.token)
        }
    })
}

export default (store) => {
    subscribe(store)
}
