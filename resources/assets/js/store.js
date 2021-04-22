// state storage init
import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

import userStore from './stores/userStore.js';
import notificationsStore from './stores/notificationsStore.js';
import topBarStore from './stores/topBarStore.js';
import channelsStore from './stores/channelsStore.js';
import contentStore from './stores/contentStore.js';

// Setup App State Store
export const store = new Vuex.Store({
    state: {},
    modules: {
        topBar: topBarStore,
        user: userStore,
        notifications: notificationsStore,
        channels: channelsStore,
        contentStore: contentStore
    },
    mutations: {
    }
});