<template>
    <button v-on:click="toggleBookmark" class="mdl-button content-button bookmarks-button" :class="{ active: content.is_bookmarked }" v-mdl>
        <i class="fa fa-bookmark-o"></i>
    </button>
</template>

<script>
export default {
    data() {
        return {}
    },
    props: ['content', 'apiPrefix'],
    computed: {
    },
    mounted() {
    },
    methods: {
        toggleBookmark() {
            const $this = this;

            console.log('bookmarkStatus:', this.content.is_bookmarked)
            if (this.content.is_bookmarked) {
                axios.get('/api/' + this.apiPrefix + '/un-bookmark/' + this.content.id)
                    .then(function(response) {
                        if (response.data.success) {
                            $this.content.is_bookmarked = false;
                            showToast('UnBookmarked this content');
                            console.log('bookmarkStatus:', $this.content.is_bookmarked);
                        } else {
                            showToast('Error' + response.data.message);
                        }
                    }).catch( function (error) {
                    showToast(error.message);
                });
            } else {
                axios.get('/api/' + this.apiPrefix + '/bookmark/' + this.content.id)
                    .then(function(response) {
                        if (response.data.success) {
                            $this.content.is_bookmarked = true;
                            showToast('Bookmarked this article');
                            console.log('bookmarkStatus:', $this.content.is_bookmarked);
                        } else {
                            showToast('Error' + response.data.message);
                        }
                    }).catch( function (error) {
                    showToast(error.message);
                });
            }
        }
    }
}
</script>