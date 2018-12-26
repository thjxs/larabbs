<template>    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form class="form-horizontal" @submit.prevent="login">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input type="email" v-model="email" name="email" required class="form-control" id="email">
                                    <span class="help-block" v-if="errors.email">
                                        <strong>{{ errors.email }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" v-model="password" name="password" required class="form-control" id="password">
                                    <span class="help-block" v-if="errors.password">
                                        <strong>{{ errors.password }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <router-link class="btn btn-link" to="/">
                                        Forgot Your Password?
                                    </router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapActions } from 'vuex'
export default {
    data () {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        ...mapActions(['attemptLogin']),
        login() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    const payload = {
                        username: this.email,
                        password: this.password
                    }

                    this.attemptLogin(payload)
                    this.$router.push({ name: 'home' })
                }
            })

            // axios.post('/oauth/token', payload).then(response => {
            //     window.localStorage.setItem('user_access_token', response.data.access_token);
            //     axios.defaults.headers.common.Authorization = `Bearer ${response.data.access_token}`;
            //     this.$store.state.AuthUser.authenticated = true;
            //     this.$router.push({ name: 'users', params: { id: 1} });
            //     console.log(response.data);
            // }).catch(error => {
            //     console.log(error)
            // })
        }
    }
}
</script>
