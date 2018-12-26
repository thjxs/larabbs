import { Message } from 'element-ui'
import store from '../../store'

export default http => {
    http.interceptors.request.use(
        config => {
            // config.withCredentials = true
            return config
        },
        error => {
            return Promise.reject(error)
        }
    )

    http.interceptors.response.use(
        response => {
            return response.data
        },

        error => {
            let originalRequest = error.config
            if (error.response.status === 401 && ! originalRequest._retry) {
                originalRequest._retry = true
                const refreshToken = window.localStorage.getItem('refresh_token')
                return http.post('/oauth/token', {
                        client_id: process.env.MIX_CLIENT_ID,
                        client_secret: process.env.MIX_CLIENT_SECRET,
                        grant_type: 'refresh_token',
                        refresh_token: refreshToken,
                        scope: ''
                    }).then((response) => {
                        window.localStorage.setItem('refresh_token', response.refresh_token)
                        window.localStorage.setItem('user_access_token', response.access_token)
                        originalRequest.headers.Authorization = `Bearer ${response.access_token}`
                        http.request(originalRequest)
                    })
            }
            if (! error['response']) {
                return Promise.reject(error)
            }
            switch (error.response.status) {
                case 422: {
                    let data = error.response.data.errors
                    let content = ''
                    Object.keys(data).map(function (key) {
                        let value = data[key]
                        content = value[0]
                    })
                    Message.error(content)
                    break
                }
                case 403: {
                    Message.error(error.response.data.message || 'You are not authorize for this!')
                    break
                }
                case 401: {
                    // if (window.location.pathname !== '/login') {
                    //     window.location.href = '/login'
                    // }
                    Promise.reject(error)
                    break
                }

            }
        }
    )
}
