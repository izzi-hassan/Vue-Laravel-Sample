<template>
    <div class="view-container create-content-view">
        <cover-image-upload></cover-image-upload>
        <div class="row align-center">
            <div class="small-12 large-8 columns form-container white-container">

                <h1 class="section-title"><span>Create an article</span></h1>
                <form id="create-content-form" action="#">
                    <div class="row">
                        <div class="small-12 columns">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="title">
                                <input class="mdl-textfield__input" type="text" name="title" required v-model="title" />
                                <label class="mdl-textfield__label" for="title">Headline...</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-6 columns">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-bind:class="{ 'is-dirty': hasSlug }" v-mdl id="slug">
                                <input class="mdl-textfield__input" type="text" name="slug" required v-bind:value="slug" v-model="slug" />
                                <label class="mdl-textfield__label" for="slug">URL Slug</label>
                            </div>
                        </div>
                        <div class="small-6 columns">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <select class="mdl-textfield__input" id="channel" name="channel_id" require v-model="channel_id">
                                    <option value=""></option>
                                    <option v-for="channel in channels" v-bind:value="channel.id">{{ channel.label }}</option>
                                </select>
                                <label class="mdl-textfield__label" for="channel">Channel</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="optional-subtitle">
                                <input class="mdl-textfield__input" type="text" name="subtitle" v-model="subtitle" />
                                <label class="mdl-textfield__label" for="subtitle">optional subtitle</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="optional-short-description">
                                <textarea class="mdl-textfield__input" type="text" name="description" v-model="description"></textarea>
                                <label class="mdl-textfield__label" for="short_description">optional summary intro (textarea)</label>
                            </div>
                        </div>
                    </div>

                    <content-editor></content-editor>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import { eventBus } from '../../../eventBus.js';
import CoverImageUpload from '../../shared/CoverImageUpload.vue';
import ContentEditor from '../../content/ContentEditor.vue';

export default {
    data() {
        return {
            title: '',
            subtitle: '',
            channel_id: '',
            description: ''
        }
    },
    computed: {
        slug: function() {
            return slugify(this.title).toLowerCase();
        },
        hasSlug: function() {
            return (this.title != '');
        },
        channels: function() {
            return this.$store.state.channels.list;
        }
    },
    mounted() {
        this.$store.commit('showContentCreateMenu');

        const $this = this;
        eventBus.$on('saveContent', function(e) {
            console.log('saving');

            let text = '';
            $('.content-editor-container:first .medium-editable').each(function(index, elem) {
                text += $(elem).html();
            });

            let formData = {};

            formData.content_type_id = 1;
            formData.source = 'sparkhub';
            
            formData.profile_id = $this.$store.state.user.userData.profile.id;
            formData.channel_id = $this.channel_id;
            formData.title = $this.title;
            formData.slug = $this.slug;
            formData.subtitle = $this.subtitle;
            formData.cover_image = $('input[name="cover_image"]').val();
            formData.description = $this.description;
            formData.text = text;

            console.log('formData', formData);

           axios.post('/api/content/save', formData)
            .then(function(response) {
                $this.$store.commit('hideTopBarMessage');
                if (response.data.success) {
                    showToast('Content Published!');

                    console.log(response.data);
                    $this.$router.push('/app/' + response.data.content.slug);
                } else {
                    showToast('Error: Could not publish your content');
                }
            }).catch(function(response) {
                $this.$store.commit('hideTopBarMessage');
                showToast(response);
            });
        });

        console.log('channels', this.channels);
    },
    components: {
        coverImageUpload: CoverImageUpload,
        contentEditor: ContentEditor
    }
}
</script>