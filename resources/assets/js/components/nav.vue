<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <router-link to="/" class="navbar-brand">
                    Laravel
                </router-link>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <router-link class="" to="/" tag="li"><a>Topics</a></router-link>
                    <router-link class="" to="" tag="li"><a>Share</a></router-link>
                    <router-link class="" to="" tag="li"><a>cursor</a></router-link>
                    <router-link class="" to="" tag="li"><a>board</a></router-link>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <template v-if="! user.token">
                        <router-link :to="{ name: 'login' }" tag="li"><a>Login</a></router-link>
                        <router-link :to="{ name: 'register' }" tag="li"><a>Register</a></router-link>
                    </template>
                    <template v-else>
                        <router-link :to="{ name: 'me' }" tag="li"><a>Center</a></router-link>
                        <li><a href="#" @click.prevent="logoutUser">Logout</a></li>
                    </template>

<!--                         <router-link :to="{ name: 'topics' }" tag="li">
                            <a><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        </router-link>
                        <router-link to="/" tag="li">
                            <a class="notifications-badge" style="margin-top: -2px;">
                                <span class="badge badge-hint" title="notification">
                                </span>
                            </a>
                        </router-link>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <span class="user-avatar pull-left" style="margin-right: 8px; margin-top: -5px;">
                                    <img src="" class="img-responsive img-circle" width="30px" height="30px">
                                </span>
                                {{ user.name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <router-link :to="{ name: 'users', params: { id: 1 }}" tag="li">
                                    <a>
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        Center
                                    </a>
                                </router-link>
                                <router-link to="/" tag="li">
                                    <a>
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        Edit
                                    </a>
                                </router-link>
                                <router-link to="" tag="li">
                                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="" method="POST" style="display: none;">
                                    </form>
                                </router-link>
                            </ul>
                        </li> -->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapActions, mapState} from 'vuex'
    export default {
        computed: {
            ...mapState({
                user: state => state.AuthUser
            })
        },
        methods: {
            ...mapActions(['logout']),
            logoutUser() {
                this.logout(),
                this.$router.push({name: 'home'})
            }
        }
    }
</script>
