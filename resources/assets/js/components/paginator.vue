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

    },
    methods: {
        showingArray() {
            if (this.pagination.total_pages <= 5) {
                return Array(this.pagination.total_pages).fill().map((c, idx) => 1 + idx)
            } else if (this.pagination.current_page + 2 > this.pagination.total_pages) {
                return Array(5).fill().map((c, idx) => this.pagination.total_pages - 4 + idx)
            } else if (this.pagination.current_page - 2 <= 0) {
                return Array(5).fill().map((c, idx) => 1 + idx)
            } else {
                return Array(5).fill().map((c, idx) => this.pagination.current_page - 2 + idx)
            }
        }
    }
}
</script>
