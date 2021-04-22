<template>
	<div class="content-card small-12 columns" :class="extraClasses">
        <template v-if="content.type.id == 1">
            <template v-if="content.score >= 2">
                <div class="row collapse">
                    <div class="small-4 columns cover-image" v-if="content.cover_image" v-on:click="navigateMe(content.slug)" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                    </div>

                    <div class="content-info columns" :class="coverImageClass">
                        <div class="row collapse" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns author-info">
                                <img :src="content.author.avatar" class="avatar float-left">
                                <span class="author-name">Published by {{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                                <span class="time-passed">{{ content.time_passed }}</span>
                            </div>
                            <div class="columns view-time">
                                <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                            </div>
                        </div>
                        <div class="row collapse title-info" v-on:click="navigateMe(content.slug)">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-12 author-info" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                        <img :src="content.author.avatar" class="avatar float-left">
                        <span class="author-name">{{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                        <span class="time-passed">{{ content.time_passed }}</span>
                    </div>
                    <div class="columns view-time">
                        <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-12 content-info" v-on:click="navigateMe(content.slug)">
                        <div class="row title-info">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>

        <template v-if="content.type.id == 2">
            <template v-if="content.score >= 2">
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-4 cover_image" v-if="content.cover_image">
                        <img :src="content.cover_image">
                    </div>

                    <div class="small-8 content-info">
                        <div class="row collapse" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns author-info">
                                <img :src="content.author.avatar" class="avatar float-left">
                                <span class="author-name">Published by {{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                                <span class="time-passed">{{ content.time_passed }}</span>
                            </div>
                            <div class="columns view-time">
                                <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                            </div>
                        </div>
                        <div class="row collapse title-info" v-on:click="navigateMe(content.slug)">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-12 author-info" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                        <img :src="content.author.avatar" class="avatar float-left">
                        <span class="author-name">{{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                        <span class="time-passed">{{ content.time_passed }}</span>
                    </div>
                    <div class="columns view-time">
                        <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-12 content-info" v-on:click="navigateMe(content.slug)">
                        <div class="row title-info">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>

        <template v-if="content.type.id == 3">
            <template v-if="content.score >= 2">
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-4 cover_image" v-if="content.cover_image">
                        <img :src="content.cover_image">
                    </div>

                    <div class="small-8 content-info">
                        <div class="row collapse" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns author-info">
                                <img :src="content.author.avatar" class="avatar float-left">
                                <span class="author-name">Published by {{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                                <span class="time-passed">{{ content.time_passed }}</span>
                            </div>
                            <div class="columns view-time">
                                <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                            </div>
                        </div>
                        <div class="row collapse title-info" v-on:click="navigateMe(content.slug)">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-12 author-info" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                        <img :src="content.author.avatar" class="avatar float-left">
                        <span class="author-name">{{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                        <span class="time-passed">{{ content.time_passed }}</span>
                    </div>
                    <div class="columns view-time">
                        <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-12 content-info" v-on:click="navigateMe(content.slug)">
                        <div class="row collapse title-info">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>

        <template v-if="content.type.id == 4">
            <template v-if="content.score >= 2">
                <div class="row collapse">
                    <div class="small-4 cover_image" v-if="content.cover_image" v-on:click="navigateMe(content.slug)">
                        <img :src="content.cover_image">
                    </div>

                    <div class="small-8 content-info">
                        <div class="row collapse" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns author-info">
                                <img :src="content.author.avatar" class="avatar float-left">
                                <span class="author-name">Published by {{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                                <span class="time-passed">{{ content.time_passed }}</span>
                            </div>
                            <div class="columns view-time">
                                <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                            </div>
                        </div>
                        <div class="row collapse title-info" v-on:click="navigateMe(content.slug)">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-12 author-info" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                        <img :src="content.author.avatar" class="avatar float-left">
                        <span class="author-name">{{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                        <span class="time-passed">{{ content.time_passed }}</span>
                    </div>
                    <div class="columns view-time">
                        <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-12 content-info" v-on:click="navigateMe(content.slug)">
                        <div class="row collapse title-info">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>

        <template v-if="content.type.id == 5">
            <template v-if="content.score >= 2">
                <div class="row collapse">
                    <div class="small-4 cover_image" v-if="content.cover_image" v-on:click="navigateMe(content.slug)">
                        <img :src="content.cover_image">
                    </div>

                    <div class="small-8 content-info">
                        <div class="row collapse" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns author-info">
                                <img :src="content.author.avatar" class="avatar float-left">
                                <span class="author-name">Published by {{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                                <span class="time-passed">{{ content.time_passed }}</span>
                            </div>
                            <div class="columns view-time">
                                <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                            </div>
                        </div>
                        <div class="row collapse title-info" v-on:click="navigateMe(content.slug)">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="row collapse" v-on:click="navigateMe(content.slug)">
                    <div class="small-12 author-info" :style="{ 'background-image': 'url(' + content.cover_image + ')' }">
                        <img :src="content.author.avatar" class="avatar float-left">
                        <span class="author-name">{{ content.author.first_name }} {{ content.author.last_name }}</span><br>
                        <span class="time-passed">{{ content.time_passed }}</span>
                    </div>
                    <div class="columns view-time">
                        <i class="fa fa-clock-o"></i> {{ content.view_time }} mins
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-12 content-info" v-on:click="navigateMe(content.slug)">
                        <div class="row collapse title-info">
                            <div class="small-12 columns">
                                <span class="title">{{ content.title }}</span>
                                <span class="subtitle">{{ content.subtitle }}</span>
                            </div>
                        </div> 
                        <div class="row collapse action-row" v-on:click="navigateMe(content.slug)">
                            <div class="shrink columns">
                                <favorites-button :content="content" api-prefix="content" show-num="true"></favorites-button>
                                <comments-button :content="content"></comments-button>
                            </div>
                            <div class="columns">
                                <bookmarks-button :content="content" api-prefix="content"></bookmarks-button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </template>
	</div>
</template>

<script>
    import FavoritesButton from '../shared/FavoritesButton';
    import CommentsButton from '../shared/CommentsButton';
    import BookmarksButton from '../shared/BookmarksButton';

    export default {
        name: 'Card',
        props: ['content'],
        data() {
            return {
                extraClasses: ''
            }
        },
        computed: {
            hasCoverImage: function() {
                return (this.content.cover_image);
            },
            coverImageClass: function() {
                return (this.content.cover_image) ? 'small-8' : 'small-12';
            }
        },
        mounted() {
        	let scoreClass = 'medium-4';
                let typeClass = '';
                let channelClass = '';

                if (this.content.score >= 2) {
                    scoreClass = 'medium-8'
                }

                switch(this.content.type.id) {
                    case 1:
                        typeClass = 'article-card';
                        break;
                    case 2:
                        typeClass = 'question-card';
                        break;
                    case 3:
                        typeClass = 'discussion-card';
                        break;
                    case 4:
                        typeClass = 'article-card';
                        break;
                    case 5:
                        typeClass = 'video-card'
                        break;
                }

                if (this.content.type.is_original)
                    typeClass += ' original-content-card';
                else
                    typeClass += ' shared-content-card';

                channelClass = this.content.channel.slug + '-card';
                
                this.extraClasses =  scoreClass + ' ' + typeClass + ' ' + channelClass;
        },
        components: {
            FavoritesButton,
            CommentsButton,
            BookmarksButton
        },
        methods: {
            navigateMe: function(slug) {
                this.$router.push('/app/' + slug);
            }
        }
    }
</script>