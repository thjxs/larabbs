<template>
    <div class="col-lg-3 col-md-3 sidebar">
        <div class="panel panel-default">
            <div class="panel-body">
                <a class="btn btn-success btn-block" aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencli" aria-hidden="true"></span> New Topic
                </a>
            </div>
        </div>

        <div class="panel panel-defualt">
            <div class="panel-body active-users">
                <div class="text-center">active user</div>
                <hr>
                    <router-link class="media" :to="{ name: 'users', params: { id: user.id }}" :key="user.id" v-for="user in activedUsers">
                        <div class="media-left media-middle">
                            <img :src="user.avatar" width="24px" height="24px" class="img-circle media-object">
                        </div>
                        <div class="media-body">
                            <span class="media-heading">{{ user.name }}</span>
                        </div>
                    </router-link>
                <!-- <active-user-list :users="activedUsers"/> -->
            </div>
        </div>
    </div>
</template>

<script>
// import ActiveUserList from './active-user-list'
export default {
    name: 'side-bar',
    props: {
        activedUsers: {}
    }
    // data() {
    //     return {
    //         activedUsers: []
    //     }
    // },
    // methods: {
    //     async getActiveUsers() {
    //         this.activedUsers = await this.$http.get('/api/actived/users').catch(() => {

    //         })
    //     console.log(this.activedUsers)
    //     }
    // },
    // created() {
    //     this.getActiveUsers()
    // },
    // components: {
    //     ActiveUserList
    // }
}
</script>
