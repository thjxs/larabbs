<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div align="center">
                                <img :src="user.avatar" class="thumbnail img-responsive" width="120px">
                            </div>

                            <div class="media-body">
                                <h4><strong>Profile</strong></h4>
                                <p>{{ user.introduction }}</p>
                                <hr>
                                <h4><strong>Created_at</strong></h4>
                                <p>{{ user.created_at }}</p>
                                <hr>
                                <h4><strong>Last actived_at</strong></h4>
                                <p>{{ user.last_actived_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="panle-title pull-left">{{ user.name }}</span>
                    </div>
                </div>
                <hr>
                <div class="panel panel-default">
                    <ul class="nav nav-tabs">
                        <router-link to="/" class="active" tag="li"><a>Topic</a></router-link>
                        <router-link to="/" class="" tag="li"><a>Reply</a></router-link>
                    </ul>
                    <topic-list-item :topics="userTopics.data"/>
                    <paginator :pagination="userTopics.meta.pagination" @change="handleChange"/>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import TopicListItem from './topic-list-item'
import Paginator from '../paginator'
import { mapGetters } from 'vuex'

export default {
    mounted() {

    },
    created() {
        this.loadUser()
    },
    data() {
        return {
            user: {},
            userRepies: {},
            userTopics: {
                "meta": {}
            }
        }
    },
    methods: {
        async loadUser() {
            this.user = await this.$http.get('/api/user').catch(() => {
                this.$router.replace({ name: '404-page' })
            });
            this.loadTopics()
        },
        async loadTopics(page = 1) {
            this.userTopics = await this.$http.get(`/api/users/${this.user.id}/topics?include=user,category&page=${page}`)
            .catch(() => {
                this.$router.replace({ name: '404-page' })
            })
        },
        handleChange (page) {
            this.loadTopics(page)
        }
    },
    computed: {
        ...mapGetters(['currentUser'])
    },
    components: {
        TopicListItem,
        Paginator
    }
}
</script>
