<template>
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        Author: {{ user.name }}
                    </div>
                    <hr>
                    <div class="media">
                        <router-link :to="{ name: 'users', params: { id: topic.user_id }}" align="center" tag="div">
                            <a>
                                <img src="" class="thumbanil img-responsive">
                            </a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 class="text-center">
                        {{ topic.title }}
                    </h1>

                    <div class="article-meta text-center">
                        {{ topic.created_at }}
                        .
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        {{ topic.reply_count }}
                    </div>

                    <div class="topic-body">
                         {{ topic.body }}
                    </div>
                </div>
            </div>

            <div class="panel panel-default topic-reply">
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/topics/' + this.$route.params.id + '?include=user.roles,category').then(response => {
                this.topic = response.data,
                this.user = response.data.user
            })
        },
        data() {
            return {
                topic: {},
                user: {}
            }
        }
    }
</script>
