import * as TYPES from './mutations-types'
import * as authUser from './auth-user'

export const attemptLogin = ({ dispatch }, payload) =>
    authUser.postLogin(payload)
    .then(response => {
        dispatch('setToken', response.access_token)
        window.localStorage.setItem('refresh_token', response.refresh_token)
        window.localStorage.setItem('access_token', response.access_token)
        return Promise.resolve()
    })
    .then(() => dispatch('loadUser'))

export const attemptRegister = ({ dispatch }, payload) =>
    authUser.postRegister(payload)
    .then(response => {
        dispatch('setToken', response.access_token)

        return Promise.resolve()
    })
    .then(() => dispatch('loadUser'))

export const logout = ({ dispatch }) => {
    window.localStorage.removeItem('refresh_token');
    dispatch('setToken', null);
    dispatch('setUser', {})
}

export const setUser = ({ commit }, user) => {
    commit(TYPES.SET_USER, user)

    Promise.resolve(user)
}

export const setToken = ({ commit }, token) => {
    commit(TYPES.SET_TOKEN, token)

    return Promise.resolve(token)
}

export const loadUser = ({ dispatch }) =>
    authUser.loadUserData()
    .then(user => dispatch('setUser', user))
    .catch(logout)
