<template>
    <div class="view-container view-profile-view" v-if="profileLoaded">
            <div class="row cover-image-container" v-bind:style="{ 'background-image': 'url(' + profile.cover_image + ')' }" v-if="profile.cover_image">
                <div class="gradient-container">
                    <div class="small-12 columns"></div>
                </div>
            </div>
            <div class="row cover-image-container" v-else>
                <div class="gradient-container">
                    <div class="small-12 columns"></div>
                </div>
            </div>

            <div class="row align-center profile-info-container">
                <div class="small-12 large-10 columns">
                    <div class="row">
                        <div class="small-12 large-8 columns">
                            <img :src="profile.avatar" class="float-left avatar" />

                            <h1>{{ profile.user.username }}</h1>
                            <div class="tagline" v-if="profile.tagline">{{ profile.tagline }}</div>
                            <div class="city-join-date">

                                <span class="city" v-if="profile.city">
                                    <i class="fa fa-map-marker"></i> {{ profile.city.name }}
                                </span>

                                <span class="join-date">
                                    <i class="sparkhub-icon"></i>Joined {{ profile.joined_since }}
                                </span>
                            </div>
                        </div>

                        <div class="small-12 large-4">
                            <div class="text-right container">
                                <button class="mdl-button mdl-js-button mdl-button--icon show-for-large notifications-button" data-toggle="profile-dropdown-menu">
                                    <i class="material-icons">more_horiz</i>
                                </button>

                                <hr class="clear" />

                                <div class="dropdown-pane top" id="profile-dropdown-menu" data-dropdown>
                                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect">
                                        <li class="mdl-menu__item">
                                            <i class="fa fa-link"></i> Copy Link
                                        </li>
                                        <li class="mdl-menu__item">
                                            <i class="fa fa-share"></i> Share
                                        </li>
                                        <li class="mdl-menu__item">
                                            <i class="fa fa-flag"></i> Report This
                                        </li>
                                    </ul>
                                </div>
                                <follow-button :profile="profile"></follow-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-center profile-container">
                <div class="small-12 large-10 columns white-container">
                    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect" v-mdl>
                        <div class="mdl-tabs__tab-bar">
                            <a href="#overview-panel" class="mdl-tabs__tab is-active">Overview</a>
                            <a href="#shares-panel" class="mdl-tabs__tab" v-if="shares">Shares</a>
                            <a href="#discussions-panel" class="mdl-tabs__tab" v-if="profile.discussions">Discussions</a>
                            <a href="#mentions-panel" class="mdl-tabs__tab" v-if="profile.mentions">Mentions</a>
                            <a href="#following-panel" class="mdl-tabs__tab" v-if="profile.following">Following</a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="overview-panel">
                            <div class="row">
                                <div class="small-12 medium-8 columns">
                                    <div class="row collapse profile-box overview-about">
                                        <div class="small-12 columns">
                                            <h2>Meet {{ profile.user.username }}</h2>
                                            <span class="about" v-if="profile.about">{{ profile.about }}</span>
                                        </div>
                                    </div>
                                    <div class="row collapse profile-box overview-children-interests-other" v-if="profile.children || profile.interests || profile.other_info">
                                        <div class="small-12 medium-6 columns overview-children" v-if="profile.children">
                                            <h4 class="profile-details-heading" v-if="profile.children.list.length === 1">Has 1 Child</h4>
                                            <h4 class="profile-details-heading" v-else>Has {{ profile.children.list.length }} Children</h4>
                                            
                                            <ul id="children-list">
                                                <li v-for="child in profile.children.list">
                                                    <i class="fa fa-mars child-gender" v-if="child.gender === 'male'"></i>
                                                    <i class="fa fa-venus child-gender" v-else-if="child.gender == 'female'"></i>
                                                    <i class="fa fa-neuter child-gender" v-else-if="child.gender == 'neutral'"></i>
                                                    <i class="fa fa-transgender child-gender" v-else-if="child.gender == 'trans'"></i>
                                                    <span class="child-age" v-if="child.age === 1">{{ child.age }} yr</span>
                                                    <span class="child-age" v-if-else>{{ child.age }} yrs</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="small-12 medium-4 columns overview-interests" v-if="profile.interests">
                                            <h4 class="profile-details-heading">Enjoys</h4>

                                            <span><template v-for="interest in profile.interests.list">
                                                {{ interest }}, 
                                            </template></span>
                                        </div>

                                        <template v-for="info in profile.other_info.list" v-if="profile.other_info">
                                            <div class="small-12 medium-6 columns overview-generic-info" :class="info.short_name">
                                                <h4 class="profile-details-heading">{{ info.title }}</h4>

                                                <span class="generic-info-text" v-if="info.text">{{ info.text }}</span>

                                                <ul class="generic-info-list" v-if="info.list">
                                                    <li v-for="item in info.list">
                                                        {{ item }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </template>
                                    </div>

                                    <h3 v-if="profile.badges.length > 0">Badges</h3>
                                    <div class="row collapse profile-box profile-badges" v-if="profile.badges.length > 0">
                                        <div class="small-12 columns">
                                            <div class="row">
                                                <div class="small-12 columns badges-container">
                                                    <ul class="badges">
                                                        <li v-for="badge in profile.badges" class="badge">
                                                            <img :src="badge.badge_image" class="badge-icon" />
                                                            <span class="badge-label">{{ badge.label }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 v-if="profile.favorite_quote">Favorite Quote</h3>
                                    <div class="row collapse align-center quote-container" v-if="profile.favorite_quote">
                                        <div class="small-11 large-8 columns">
                                            <img src="/images/profile/quotations.png" class="profile-quote-icon" />
                                            <span class="quote-text">{{ profile.favorite_quote.text }}</span>
                                            <hr class="clear" />
                                            <span class="quote-author">- {{ profile.favorite_quote.author }}</span>

                                            <span class="quote-hashtags">
                                                <template v-for="hashtag in profile.favorite_quote.hashtags">
                                                        #{{ hashtag }}&nbsp;
                                                </template>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="medium-4 show-for-medium columns">
                                    Activity Feed
                                </div>
                            </div>
                        </div>
                        <div class="mdl-tabs__panel" id="shares-panel" v-if="shares">
                            <div class="feed-container">
                                <card-feed :feed="shares"></card-feed>
                            </div>
                        </div>
                        <div class="mdl-tabs__panel" id="discussions-panel" v-if="profile.discussions">
                        </div>
                        <div class="mdl-tabs__panel" id="mentions-panel" v-if="profile.mentions">
                        </div>
                        <div class="mdl-tabs__panel" id="following-panel" v-if="profile.following">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { eventBus } from '../../../eventBus.js';
import followButton from '../../shared/FollowButton';
import cardFeed from '../../feed/CardFeed';

export default {
    data() {
        return {
            profile: {},
            shares: {},
            profileLoaded: false
        }
    },
    computed: {
        
    },
    mounted() {
        this.$store.commit('showAppMenu');

        const $this = this;
        let id = this.$route.params.id;

        if (id == undefined)
            id = this.$store.state.user.userData.id;

        axios.get('/api/profile/get/' + id)
        .then(function( response ) {
            if (response.data.success) {
                $this.profile = response.data.profile;

                $this.profileLoaded = true;
                showToast('Profile Loaded');

                console.log('profile', $this.profile);
            } else {
                showToast('Error: ' + response.data.message);
            }    
        }).catch(function (error) {
            showToast(error.message);
        });



        axios.get('/api/feed/profile-feed/' + id)
        .then(function( response ) {
            if (response.data.success) {
                $this.shares = response.data.feed;

                console.log($this.shares);
            } else {
                showToast('Error: ' + response.data.message);
            }   
        }).catch(function (error) {
            showToast(error.message);
        });
    },
    components: {
        followButton,
        cardFeed
    }
}
</script>