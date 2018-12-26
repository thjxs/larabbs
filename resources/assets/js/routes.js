import store from './store'

const requiresGuest = (to, from, next) => {
    if (! store.getters.authToken) {
        next()
    } else {
        next('/')
    }
}

const requiresAuth = (to, from, next) => {
    if (store.getters.authToken) {
        next()
    } else {
        next({'name': 'login'})
    }
}

export default [
    {
        path: '/',
        name: 'home',
        component: require('./components/TopicComponent')
    },
    {
        path: '/topics/:id',
        name: 'topics',
        component: require('./components/TopicDetailComponent')
    },
    {
        path: '/category/:id',
        name: 'category'
    },
    {
        path: '/users/:id',
        name: 'users'
    },
    {
        path: '/me',
        name: 'me',
        component: require('./components/user/user-profile'),
        beforeEnter: requiresAuth
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/auth/login-form'),
        beforeEnter: requiresGuest
    },
    {
        path: 'register',
        name: 'register',
        component: require('./components/auth/register'),
        beforeEnter: requiresGuest
    },
    {
        path: '404-page',
        name: '404-page'
    }
];
