<template>
    <ul class="list-group">
        <router-link :to="{name: 'topics', params: { id: topic.id}}" class="list-group-item" :key="topic.id" v-for="topic in topics" tag="li">
            <a>{{ topic.title }}</a>
            <span class="meta pull-right">
                {{ topic.reply_count }} Reply
                <span> ~ </span>
                {{ topic.created_at }}
            </span>
        </router-link>
    </ul>
</template>

<script>
export default {
    name: 'topic-list-item',
    props: {
        topics: {}
    }
}
</script>
