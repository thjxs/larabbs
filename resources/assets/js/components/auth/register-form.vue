<template>
    <form class="form-horizontal" @submit.prevent="register">

    <div class="form-group">
        <label for="username" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input v-validate="'required|min:3'" v-model="username" id="username" type="text" class="form-control" name="username" required autofocus>
            <span v-show="errors.has('username')" class="help-block">
                <strong>{{ errors.first('username') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input v-validate="'required|email'" v-model="email" id="email" type="email" class="form-control" name="email" required>
            <span v-show="errors.has('email')" class="help-block">
                <strong>{{ errors.first('email') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input v-validate="'required|min:6'" v-model="password" id="password" type="password" class="form-control" name="password" required>
            <span v-show="errors.has('password')" class="help-block">
                <strong>{{ errors.first('password') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input v-validate="'required|confirmed:password'" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            <span v-show="errors.has('password_confirmation')" class="help-block">
                <strong>{{ errors.first('password_confirmation') }}</strong>
            </span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </div>
</form>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    data() {
        return {
            username: '',
            email: '',
            password: ''
        }
    },
    methods: {
        ...mapActions(['attemptRegister']),
        register() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    const payload = {
                        username: this.username,
                        password: this.password,
                        email: this.email
                    }

                    this.attemptRegister(payload)
                }
            })
        }
    }
}
</script>
