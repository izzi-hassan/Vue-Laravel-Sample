<template>
    <button v-on:click="toggleFollow" class="mdl-button profile-button follow-button" :class="{ active: profile.is_followed }" v-mdl v-if="notOwnProfile">
        <i class="fa" :class="followStatusIcon"></i>
        <span v-if="profile.is_followed">Following</span>
        <span v-else>Follow</span>
    </button>
</template>

<script>
    export default {
        name: 'followButton',
        data() {
            return {}
        },
        props: ['profile'],
        computed: {
            notOwnProfile: function() {
                return (this.profile.id != this.$store.state.user.userData.id);
            },
            followStatusIcon: function() {
                return (this.profile.is_followed) ? 'fa-check': 'fa-user-plus';
            }
        },
        mounted() {
            console.log('followStatus:', this.profile.is_followed)
        },
        methods: {
            toggleFollow() {
                const $this = this;

                console.log('followStatus:', this.profile.is_followed)
                if (this.profile.is_followed) {
                    axios.get('/api/profile/un-follow/' + this.profile.id)
                        .then(function(response) {
                            if (response.data.success) {
                                $this.profile.is_followed = false;
                                showToast('Unfollowed this author');
                            } else {
                                showToast('Error' + response.data.message);
                            }
                        }).catch( function (error) {
                            showToast(error.message);
                        });
                } else {
                    axios.get('/api/profile/follow/' + this.profile.id)
                        .then(function(response) {
                            if (response.data.success) {
                                 $this.profile.is_followed = true;
                                showToast('Following this author');
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