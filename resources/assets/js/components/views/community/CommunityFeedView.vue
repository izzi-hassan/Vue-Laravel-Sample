<template>
    <div class="view-container feed-container community-feed-view">
        <h1 class="section-title"><span>Trending...</span></h1>
        <card-feed :feed="feed"></card-feed>
    </div>
</template>

<script>
    import CardFeed from '../../feed/CardFeed';

    export default {
        name: 'ComunityFeedView',
        data() {
            return {
                feed: {}
            }
        },
        mounted() {
            this.$store.commit('showAppMenu');
            const $this = this;

            axios.get('/api/feed/user-feed')
            .then(function (response) {
                if (response.data.success) {
                    $this.feed = response.data.feed;
                } else {
                    showToast('Error: Problem loading feed');
                }
            }).catch(function(error) {
                showToast(error.message);
            });
        },
        components: {
            CardFeed
        }
    }
</script>