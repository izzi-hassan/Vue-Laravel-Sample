<template>
    <button v-on:click="showDiscussion" class="mdl-button content-button comments-button" v-mdl>
        <i class="fa fa-comment-o"></i>
        <span>{{ content.num_comments }}</span>
    </button>
</template>

<script>
    export default {
        data() {
            return {}
        },
        props: ['content'],
        computed: {
        },
        mounted() {
        },
        methods: {
            showDiscussion: function() {
                this.$router.push('/app/' + this.content.slug + '#discussion');
            }
        }
    }
</script>