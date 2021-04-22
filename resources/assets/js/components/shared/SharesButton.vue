<template>
    <button v-on:click="toggleShare" class="mdl-button content-button shares-button" :class="{ active: content.is_shared }" v-mdl>
        <i class="fa fa-share-square-o"></i>
        <span v-if="showNum">{{ content.num_shares }}</span>
    </button>
</template>

<script>
export default {
    name: 'sharesButton',
    data() {
        return {}
    },
    props: ['content', 'apiPrefix', 'showNum'],
    computed: {
    },
    mounted() {

        console.log('shareStatus:', this.content.is_shared)
    },
    methods: {
        toggleShare() {
            const $this = this;

            console.log('shareStatus:', this.content.is_shared)
            if (this.content.is_shared) {
                axios.get('/api/' + this.apiPrefix + '/un-share/' + this.content.id)
                    .then(function(response) {
                        if (response.data.success) {
                            $this.content.isShared = false;
                            showToast('Unshared this content');
                            console.log('shareStatus:', $this.content.is_shared)
                            $this.content.num_shares--;
                        } else {
                            showToast('Error' + response.data.message);
                        }
                    }).catch( function (error) {
                    showToast(error.message);
                });
            } else {
                axios.get('/api/' + this.apiPrefix + '/share/' + this.content.id)
                .then(function(response) {
                        if (response.data.success) {
                            $this.content.is_shared = true;
                            showToast('Shared this content');
                            console.log('shareStatus:', $this.content.is_shared);
                            $this.content.num_shares++;
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