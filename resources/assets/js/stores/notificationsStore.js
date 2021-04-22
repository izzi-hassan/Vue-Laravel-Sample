export default {
    state: {
        announcements: [
            {
                name: 'learn-more-about-sparkhub',
                category: 'informative',
                message: 'Learn more about SparkHub by taking this quick tour.',
                action: 'Take the tour',
                actionHandler: function() { showToast('Announcement button clicked'); },
                read: true
            }
        ],
        community: {
            mentions: {

            },
            comments: {

            },
            shares: {

            }
        },
        system: {

        },
        checked: false
    },
    getters: {
        lastUnreadAnnouncement (state) {
            const unread = state.announcements.filter(function(an) {
                return (an.read == false);
            });

            if (unread.length > 0)
                return unread[0];
            else {
                return false;
            }
        },
        numNotifications (state) {
            return state.community.mentions.length + state.community.comments.length + state.community.shares.length + state.system.length;
        },
        isChecked (state) {
            return state.checked;
        }
    },
    mutations: {
        readLastAnnouncement (state) {
            //TODO: Store cookie and update database.
            const unread = state.announcements.filter(function(an) {return (an.read == false);});

            showSnackbar('Announcement Read', 'Undo', function() {
                showToast('Announcement Unread');
                unread[0].read = false;
            });

            unread[0].read = true;
        },
        undoReadLastAnnouncement(state) {
            const unread = state.announcements.filter(function(an) {return (an.read == false);});

            showToast('Announcement Unread');
            unread[0].read = false;
        },
        notificationsMenuChecked (state) {
            state.checked = true;
        },
        addAnnouncement (state, announcement) {
            state.announcements.push(announcement);
            state.checked = false;
        },
        addMention (state, mention) {
            state.community.mentions.push(mention);
            state.checked = false;
        },
        addComment (state, comment) {
            state.community.comments.push(comment);
            state.checked = false;
        },
        addShare (state, share) {
            state.community.shares.push(shares);
            state.checked = false;
        }
    }
}