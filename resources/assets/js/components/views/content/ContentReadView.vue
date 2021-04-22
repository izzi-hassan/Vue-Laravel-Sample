<template>
    <div class="view-container read-content-view" v-if="contentLoaded">
        <div class="row callout-container align-middle align-center">
            <div class="small-12 large-8 columns">
                <div class="row">
                    <div class="shrink columns">
                        <span>Your source for inspiration, stimulation &amp; imagination!</span>
                    </div>
                    <div class="columns text-right">
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row cover-image-container" v-if="content.cover_image" v-bind:style="{ 'background-image': 'url(' + content.cover_image + ')' }">
            <div class="small-12 columns"></div>
        </div>

        <div class="row align-center">
            <div class="small-12 large-10 columns content-container white-container">
                <div class="row subtitle-container align-center align-middle" v-if="content.subtitle">
                    <div class="shrink columns">
                        <h2 class="subtitle">{{ content.subtitle }}</h2>
                    </div>
                </div>
                <div class="row collapse title-container">
                    <div class="small-12 columns">
                        <h1 class="title">{{ content.title }}</h1>
                    </div>
                </div>

                <div class="row collapse content-data-container align-left">
                    <div class="shrink columns">
                        <span v-if="content.type.id == 1">Article published {{ content.time_passed }}</span>
                        <span v-if="content.type.id == 2">Question asked {{ content.time_passed }}</span>
                        <span v-if="content.type.id == 3">Discussion started {{ content.time_passed }}</span>
                        <span v-if="content.type.id == 4">Article shared {{ content.time_passed }}</span>
                        <span v-if="content.type.id == 5">Video shared {{ content.time_passed }}</span>
                        <span v-if="content.is_edited" class="italic">( edited )</span>
                        <span v-if="content.view_time">&middot; {{ content.view_time }} min read</span>

                        <channel-button :channel="content.channel"></channel-button>
                    </div>
                </div>

                <content-controls-widget :content="content"></content-controls-widget>

                <div class="row collapse content-description-container" v-if="content.description">
                    <div class="small-12 columns">
                        {{ content.description }}
                    </div>
                </div>

                <div class="row collapse content-text-container" v-if="content.text">
                    <div class="small-12 columns">
                        {{ content.text }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { eventBus } from '../../../eventBus.js';
import contentControlsWidget from '../../content/ContentControlsWidget';
import channelButton from '../../shared/ChannelButton';

    export default {
        data() {
            return {
                content: {
                },
                contentLoaded: false
            }
        },
        computed: {
        },
        beforeMount() {
        },
        mounted() {
            this.$store.commit('showAppMenu');

            const $this = this;
            const slug = this.$route.params.slug;

            axios.get('/api/content/get/' + slug)
                .then(function( response ) {
                    if (response.data.success) {
                        $this.content = response.data.contentPost;

                        console.log($this.content);

                        $this.contentLoaded = true;
                    } else {
                        showToast('Error: ' + response.data.message);
                    }
                }).catch(function (error) {
                showToast(error.message);
            });
        },
        components: {
            contentControlsWidget,
            channelButton
        }
    }
</script>