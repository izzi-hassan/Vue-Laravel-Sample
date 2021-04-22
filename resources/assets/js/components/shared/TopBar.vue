<template>

    <div data-sticky-container id="sticky-top-bar-container">
        <div class="top-bar sticky" id="sticky-top-bar" data-sticky data-sticky-on="small" data-anchor="1" data-margin-top="0">
            <div class="top-bar-title">
                <router-link :to="{name: 'app-home'}">
                    <img src="/images/shared/logo-dark.png" alt="SparkHub Logo" class="logo dark-logo" />
                </router-link>
            </div>
            <div class="top-bar-right">
                <div class="message-container menu-container show">{{ message }}</div>

                <div class="menu-container show-for-large" v-bind:class="{ show: appMenuActive }" id="app-menu">
                    <button class="mdl-button mdl-js-button add-new-button" v-on:click="showAddNewDialog">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </button>
                </div>
                <div class="menu-container show-for-large" v-bind:class="{ show: profileEditMenuActive }" id="edit-profile-menu">
                    <button class="mdl-button mdl-js-button show-for-medium save-button">
                        Save <i class="fa fa-chevron-down"></i>
                    </button>
                </div>
                <div class="menu-container show-for-large" v-bind:class="{ show: contentCreateMenuActive }" id="create-content-menu">
                    <button class="mdl-button mdl-js-button show-for-medium share-button">
                        Share
                    </button>
                    <button class="mdl-button mdl-js-button show-for-medium publish-button" v-on:click="publishContent">
                        Publish <i class="fa fa-chevron-down"></i>
                    </button>
                </div>
                <div class="menu-container show-for-large" v-bind:class="{ show: contentEditMenuActive }" id="edit-content-menu">
                    <button class="mdl-button mdl-js-button show-for-medium publish-button">
                        Publish <i class="fa fa-chevron-down"></i>
                    </button>
                </div>
                <span class="nav-button-separator show-for-large">|</span>
                <div class="menu-container show" id="permanent-menu">
                    <button class="mdl-button mdl-js-button mdl-button--icon show-for-large notifications-button"  data-toggle="notifications-dropdown-menu">
                        <div class="material-icons mdl-badge mdl-badge--overlap" data-badge="0">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </div>
                    </button>
                    <div class="dropdown-pane top" id="notifications-dropdown-menu" data-dropdown>
                    </div>
                    <button class="mdl-button mdl-js-button user-button" data-toggle="user-dropdown-menu">
                        <img :src="avatar" class="avatar"></img>
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-pane top" id="user-dropdown-menu" data-dropdown>
                        <h6>@{{ username }}</h6>
                        <ul class="vertical menu">
                            <li>
                                <router-link :to="{name: 'profile-self'}">Profile</router-link>
                                <ul class="nested vertical menu">
                                    <li>
                                        <router-link :to="{name: 'profile-edit'}">Edit Profile</router-link>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <router-link :to="{name: 'settings-view'}">Settings</router-link>
                                <ul class="nested vertical menu">
                                    <li><router-link :to="{name: 'settings-profile'}">Profile Settings</router-link></li>
                                    <li><router-link :to="{name: 'settings-privacy'}">Privacy Settings</router-link></li>
                                    <li><router-link :to="{name: 'settings-account'}">Account Settings</router-link></li>
                                </ul>
                            </li>
                        </ul>
                        <button class="mdl-button sign-in-button" data-href="/sign-out">Sign Out</button>
                    </div>
                    <button class="mdl-button mdl-js-button mdl-button--icon menu-button" data-toggle="offcanvas-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <dialog class="mdl-dialog add-new-dialog">
            <h4 class="mdl-dialog__title">Share Something New</h4>
            <div class="mdl-dialog__content">
                <p>
                    Lorem Ipsum.
                </p>
                <div class="dialog-options">
                    <router-link :to="{name: 'article-create'}">Create Article</router-link>
                    <router-link :to="{name: 'question-create'}">Ask a Question</router-link>
                    <router-link :to="{name: 'discussion-create'}">Discuss a Topic</router-link>
                </div>
            </div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button close">Close</button>
            </div>
        </dialog>
    </div>
</template>

<script>
    import { eventBus } from '../../eventBus.js';

    export default {
        data() {
            return {
            }
        },
        computed: {
            message: function() {
                return this.$store.state.topBar.message;
            },
            avatar: function() {
                return this.$store.state.user.userData.avatar;
            },
            username: function() {
                return this.$store.state.user.userData.username;
            },
            appMenuActive: function() {
                return (this.$store.state.topBar.menu.current == 'app-menu');
            },
            contentCreateMenuActive: function() {
                return (this.$store.state.topBar.menu.current == 'content-create-menu');
            },
            contentEditMenuActive: function() {
                return (this.$store.state.topBar.menu.current == 'content-edit-menu');
            },
            profileEditMenuActive: function() {
                return (this.$store.state.topBar.menu.current == 'profile-edit-menu');
            },
            numNotifications: function() {
                console.log('checked: ', this.$store.notifications.isChecked);
                console.log(this.$store.state.notifications.numNotifications);

                if (this.$store.notifications.isChecked) {
                    return 0;
                } else {
                    return this.$store.state.notifications.numNotifications;
                }
            }
        },
        methods: {
            publishContent() {
                this.$store.commit('showTopBarMessage', 'Saving');
                eventBus.$emit('saveContent');
            },
            showAddNewDialog: function() {
                console.log('dialog');
                var dialog = document.querySelector('dialog.add-new-dialog');
                console.log(dialog);
                dialog.showModal();

                dialog.querySelector('.close').addEventListener('click', function() {
                  dialog.close();
                });
            }
        },
        mounted() {
            //eventBus.$on('userInitialized', initUser);
        }
    }
</script>