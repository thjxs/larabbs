import axios from 'axios'
import interceptors from './interceptors'

const http = axios.create({
    baseURL: 'http://larabbs.test',
    timeout: 10000
})

interceptors(http)

export function setToken (token) {
    http.defaults.headers.common.Authorization = `Bearer ${token}`
}

export default http
