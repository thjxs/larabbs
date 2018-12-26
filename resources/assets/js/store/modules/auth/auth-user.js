import { default as http } from '../../../utils/http'

export const postLogin = ({ username, password }) => {
    return http.post('/oauth/token', {
        client_id: process.env.MIX_CLIENT_ID,
        client_secret: process.env.MIX_CLIENT_SECRET,
        grant_type: 'password',
        username: username,
        password: password,
        scope: ''
    })
}

export const postRegister = payload => {
    return http.post('/auth/register', payload)
}

export const loadUserData = () => http.get('/api/user').catch(() => {})

export const revokeToken = token => http.post('/oauth/tokens/' + token)

export const refreshToken = token => {
    return http.post('/oauth/token/refresh', {
        client_id: process.env.MIX_CLIENT_ID,
        client_secret: process.env.MIX_CLIENT_SECRET,
        grant_type: 'refresh_token',
        refresh_token: token,
        scope: ''
    })
}
