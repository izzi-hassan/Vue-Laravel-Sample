<template>
    <button v-on:click="toggleFavorite" class="mdl-button content-button favorites-button" :class="{ active: content.is_favorited }" v-mdl>
        <i class="fa fa-heart-o"></i>
        <span v-if="showNum">{{ content.num_favorites }}</span>
    </button>
</template>

<script>
    export default {
        name: 'favoritesButton',
        data() {
            return {}
        },
        props: ['content', 'apiPrefix', 'showNum'],
        computed: {
        },
        mounted() {

            console.log('favoriteStatus:', this.content.is_favorited)
        },
        methods: {
            toggleFavorite() {
                const $this = this;

                console.log('favoriteStatus:', this.content.is_favorited)
                if (this.content.is_favorited) {
                    axios.get('/api/' + this.apiPrefix + '/un-favorite/' + this.content.id)
                        .then(function(response) {
                            if (response.data.success) {
                                $this.content.is_favorited = false;
                                showToast('Unfavorited this content');
                                console.log('favoriteStatus:', $this.content.is_favorited);
                                $this.content.num_favorites--;
                            } else {
                                showToast('Error' + response.data.message);
                            }
                        }).catch( function (error) {
                            showToast(error.message);
                        });
                } else {
                    axios.get('/api/' + this.apiPrefix + '/favorite/' + this.content.id)
                        .then(function(response) {
                            if (response.data.success) {
                                 $this.content.is_favorited = true;
                                showToast('Favorited this content');
                                console.log('favoriteStatus:', $this.content.is_favorited);
                                $this.content.num_favorites++;
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