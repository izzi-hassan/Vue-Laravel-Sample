<template>
    <div class="announcement-container" id="page-announcement" v-if="announcement">
        <div class="row">
            <div class="small-10 columns"></div>
            <div class="small-2 columns">
                <div class="row align-center align-middle align-center shrink full-height">
                    <div class="shrink columns">
                        <button aria-label="Close Announcement" type="button" class="light-close" v-on:click="closeAnnouncement">
                            <i aria-hidden="true" class="fa fa-close"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-center align-middle full-height">
            <div class="shrink columns text-center">
                <p>{{ message }}</p>
                <button type="button" class="announcement-button">{{ action }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { eventBus } from '../../eventBus.js';

    export default {
        data() {
            return {
                message: '',
                action: '',
                storeIndex: -1,
                announcement: false
            }
        },
        beforeMount() {
            $(this.$el).hide();
        },
        mounted() {
            // check for announcements in state store
            this.announcement = this.$store.getters.lastUnreadAnnouncement;

            if (this.announcement !== false)
                this.showAnnouncement(this.announcement);

            // Realtime announcements
            eventBus.$on('showAnnouncement', this.showAnnouncement);
        },
        methods: {
            closeAnnouncement: function() {
                this.$store.commit('readLastAnnouncement');

                showSnackbar('Announcement Read', 'Undo', this.undoRead)
                $(this.$el).hide();
            },
            undoRead: function() {
                this.$store.commit('undoReadLastAnnouncement');
                showToast('Announcement Unread');
            },
            showAnnouncement: function(announcement) {
                let $this = $(this.$el);

                this.message = (this.announcement.message === undefined) ? "<p>No message. Please contact support</p>" : this.announcement.message;

                this.action = (this.announcement.action === undefined || this.announcement.actionHandler === undefined) ? '' : this.announcement.action;

                if (this.announcement.action !== undefined && this.announcement.actionHandler !== undefined)
                    $this.find('button.announcement-button:first').click(this.announcement.actionHandler);

                $this.show();
            }
        }
    }
</script>