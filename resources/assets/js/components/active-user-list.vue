<template :key="user.id" v-for="user in users.data">
    <router-link class="media" :to="{ name: 'users', params: { id: user.id }}">
        <div class="media-left media-middle">
            <img :src="user.avatar" width="24px" height="24px" class="img-circle media-object">
        </div>
        <div class="meida-body">
            <span class="media-heading">{{ user.name }}</span>
        </div>
    </router-link>
</template>

<script>
export default {
    name: 'active-user-list',
    props: {
        users: {
            default() {
                return {
                    data: [],
                    meta: {
                        total: 1
                    }
                }
            }
        }
    },
    created() {
        console.log('???')
    }
}
</script>
