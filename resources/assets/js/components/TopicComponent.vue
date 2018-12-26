<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-lg-9 topic-list">
<!--                     <div class="alert alert-info" role="alert">
                    </div> -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="">Last Reply</a></li>
                            <li role="presentation" class=""><a href="">Recent</a></li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <ul class="media-list">
                            <li v-for="topic in topics.data" :key="topic.id" class="media">
                                <router-link :to="{ name: 'users', params: { id: topic.user_id }}" class="media-left" tag="div">
                                    <a>
                                        <img :src="topic.user.avatar" title="" class="media-object img-thumbnail" style="width: 52px;height: 52px;">
                                    </a>
                                </router-link>
                                <div class="media-body">
                                    <router-link :to="{ name: 'topics', params: { id: topic.id }}" class="media-heading" tag="div">
                                        <a :title="topic.title">
                                            {{ topic.title }}
                                        </a>
                                        <a class="pull-right">
                                            <span class="badge">{{ topic.reply_count }}</span>
                                        </a>
                                    </router-link>
                                    <div class="media-body meta">
                                        <router-link :to="{ name: 'category', params: { id: topic.category.id }}" :title="topic.category.name">
                                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                                            {{ topic.category.name }}
                                        </router-link>
                                        <router-link :to="{ name: 'users', params: { id: topic.user.id }}" :title="topic.user.name">
                                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            {{ topic.user.name }}
                                        </router-link>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <paginator :pagination="topics.meta.pagination" @change="handlePageChanged"/>
                    </div>
                </div>
            </div>
            <side-bar :activedUsers="activedUsers.data"/>
        </div>
    </div>
</template>

<script>
import SideBar from './side-bar'
import Paginator from './paginator'
export default {
    created() {
        this.loadTopics()
        this.getActivedUsers()
    },
    data() {
        return {
            topics: {
                "meta": {}
            },
            activedUsers: [],
        }
    },
    methods: {
        async loadTopics(page = 1) {
            this.topics = await this.$http.get(`/api/topics?include=user,category&page=${page}`)
            .catch()
        },
        async getActivedUsers() {
            this.activedUsers = await this.$http.get('/api/actived/users').catch(() => {

            })
        },
        handlePageChanged(page) {
            this.loadTopics(page)
        }
    },
    components: {
        SideBar,
        Paginator
    }
}
</script>
