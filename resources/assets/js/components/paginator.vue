<template>
    <ul class="pagination" v-if="pagination.total">
            <li :class="{active: i == pagination.current_page}" v-for="i in showingArray()" :key="i">
                <span @click.prevent="$emit('change', i)">{{ i }}</span>
            </li>
    </ul>
</template>

<script>
export default {
    name: "paginator",
    props: {
        pagination: {
            type: Object,
            default () {
                return {
                    "total": 0,
                    "count": 0,
                    "per_page": 0,
                    "current_page": 0,
                    "total_page": 0
                }
            }
        }
    },
    computed: {
        Start() {
            if (this.pagination.total_page <= 10) {
                return 1
            }

            return this.pagination.total_page/10
        }
    },
    methods: {
        showingArray() {
            return Array(end - start + 1).fill().map((c, idx) => start + idx)
        }
    }
}
</script>
