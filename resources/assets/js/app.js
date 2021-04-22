/* Load libraries */
require('./bootstrap');

import router from './routes.js';
import VueRouter  from 'vue-router';


Vue.use(VueRouter);
Vue.use(VueMeta);

import { eventBus } from './eventBus.js';
import { store } from './store.js'
import { sync } from 'vuex-router-sync';

/* Foundation JS Init / Config
$(document).ready(function() {
    console.log('foundation');
    $(document).foundation();
});
*/
// App scripts
require('./shared/functions.js');

require('./shared/interact.js');

require('./shared/layout.js');

require('./shared/notifications.js');

require('./shared/medium.js');

require('./pages/pages.js');

require('./home/home.js');

// TODO: Figure out why MDL library is still conflicting
if ($('#vue-onboarding').length > 0) {
    Vue.component('channel-subscriber', require('./components/profile/ChannelSubscriber.vue'));

    let ov = new Vue({
        el: '#vue-onboarding',
        data: {
            isWorking: false,
            isValid: false
        },
        methods: {
            checkUsername: function (event) {
                ov.isWorking = true;

                axios.get('/api/user/check-username-availability/' + $(event.currentTarget).val())
                .then(function(response) {
                    ov.isWorking = false;
                    ov.isValid = response.data.available;
                });
            }
        }
    });
}

// App Vue
if ($('#vue-app').length > 0) {
    // Asynchronously Initialize Store
    // TODO: Redirect if can't get user after three attempts
    initStore();

    // Register Components
    Vue.component('top-bar', require('./components/shared/TopBar.vue'));
    Vue.component('offcanvas-menu', require('./components/shared/OffcanvasMenu.vue'));
   // Vue.component('offcanvas-search', require('./components/shared/OffcanvasSearch.vue'));
    Vue.component('snackbar', require('./components/notifications/Snackbar'));
    Vue.component('announcement', require('./components/notifications/Announcement'));
    Vue.component('activity-feed', require('./components/notifications/ActivityFeed'));
    Vue.component('app-footer', require('./components/shared/AppFooter'));

    // Fix for MDL components not rendering properly
    Vue.directive('mdl', {
        bind: function(el) {
            componentHandler.upgradeElement(el);
            if ($(el).hasClass('getmdl-select'))
                getmdlSelect.init(el);
        }
    });

    Vue.directive('medium', {
        bind: function(el) {
            new medium(el, window.editorTypes[$(el).data('editor-type')]);
        }
    });

    // Vuex Router Sync
    // TODO: Fix refreshes
    sync(store, router);

    console.log(store);

    $('dialog').each(function(index, elem) {
        if (! dialog.showModal) {
          dialogPolyfill.registerDialog(dialog);
        }
    });

    new Vue({
        el: '#vue-app',
        store,
        router,
        bus: eventBus
    });

}

function initStore() {
    console.log('initing User store');
    axios.get('/api/user')
        .then(function(response) {
            if (response.data.success) {
                store.state.user.userData = response.data.userData;
                store.state.user.userData.avatar = store.state.user.userData.profile.avatar;

                eventBus.$emit('userInitialized');
            } else {
                showToast('User not initialized');
            }
        }).catch(function (error) {
        showToast('User not initialized');
    });

    axios.get('/api/channel/get-list')
    .then(function( response ) {
        store.state.channels.list = response.data;
    }).catch(function (error) {
        showToast('Channels not initialized');
        console.log(error.message);
    });
}