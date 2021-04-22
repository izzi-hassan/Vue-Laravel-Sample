<template>
    <div class="content-control-widget-container row collapse align-middle align-left">
        <div class="shrink columns no-padding">
        <router-link :to="{name: 'profile-view', params: { id: content.author.id}}">
            <img :src="avatar" class="avatar" />
        </router-link>
        </div>
        <div class="columns no-padding">
            <span class="author-name">
                <router-link :to="{name: 'profile-view', params: { id: content.author.id}}">
                    {{ content.author.first_name }} {{ content.author.last_name }}
                </router-link>
            </span>
            <follow-button :profile="content.author"></follow-button><br />
            <span class="author-description">Placeholder tagline{{ content.author.tagline }}</span>
        </div>
        <div class="shrink columns end text-right">
            <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
            <shares-button :content="content" api-prefix="content" show-num="true"></shares-button>
            <comments-button :content="content" api-prefix="content" show-num="true"></comments-button>
            <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
        </div>
    </div>
</template>

<script>
import followButton from '../shared/FollowButton';
import favoritesButton from '../shared/FavoritesButton';
import sharesButton from '../shared/SharesButton';
import commentsButton from '../shared/CommentsButton';
import bookmarksButton from '../shared/BookmarksButton';

export default {
    data() {
        return {
        }
    },
    props: ['content'],
    computed: {
        avatar: function() {
            return this.content.author.avatar;
        }
    },
    mounted() {
        console.log(this.content.author);
    },
    components: {
        followButton,
        favoritesButton,
        sharesButton,
        commentsButton,
        bookmarksButton
    }
}
</script>