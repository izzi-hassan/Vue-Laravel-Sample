/*
Routes.js
This is where all the vue routes are laid out
 */

import VueRouter from 'vue-router';

let routes = [
    {
        path: '/app',
        component: require('./components/views/community/CommunityContainer'),
        children: [
            {
                name: 'app-home',
                path: '/',
                component: require('./components/views/community/CommunityFeedView')
            }
        ]
    },
    {
        path: '/app/profile',
        component: require('./components/views/profile/ProfileContainer'),
        children: [
            {
                name: 'profile-self',
                path: '/',
                component: require('./components/views/profile/ProfileViewView')
            },
            {
                name: 'profile-edit',
                path: 'edit',
                component: require('./components/views/profile/ProfileEditView')
            },
            {
                name: 'profile-view',
                path: ':id',
                component: require('./components/views/profile/ProfileViewView')
            }
        ]

    },
    {
        path: '/app/content',
        component: require('./components/views/content/ContentContainer'),
        children: [
            {
                name: 'content-index',
                path: '/',
                component: require('./components/views/content/ContentIndexView')
            },
            {
                name: 'article-create',
                path: '/app/create',
                component: require('./components/views/content/ArticleCreateView')
            },
            {
                name: 'question-create',
                path: '/app/ask',
                component: require('./components/views/content/QuestionCreateView')
            },
            {
                name: 'discussion-create',
                path: '/app/discuss',
                component: require('./components/views/content/DiscussionCreateView')
            },
            {
                name: 'content-view',
                path: '/app/:slug',
                component: require('./components/views/content/ContentReadView')
            },
            {
                name: 'article-edit',
                path: ':id/edit',
                component: require('./components/views/content/ArticleEditView')
            },
            {
                name: 'question-edit',
                path: ':id/edit',
                component: require('./components/views/content/QuestionEditView')
            },
            {
                name: 'discussion-edit',
                path: ':id/edit',
                component: require('./components/views/content/DiscussionEditView')
            }
        ]
    },
    {
        path: '/app/channels',
        component: require('./components/views/channel/ChannelContainer'),
        children: [
            {
                name: 'channel-index',
                path: '/',
                component: require('./components/views/channel/ChannelIndexView')
            },
            {
                name: 'channel-feed',
                path: '/app/channels/:slug',
                component: require('./components/views/channel/ChannelFeedView')
            }
        ]
    },
    {
        name: 'settings-view',
        path: '/app/settings',
        component: require('./components/views/settings/SettingsContainer'),
        children: [
            {
                name: 'settings-account',
                path: 'account',
                component: require('./components/views/settings/SettingsAccountView')
            },
            {
                name: 'settings-profile',
                path: 'profile',
                component: require('./components/views/settings/SettingsProfileView')
            },
            {
                name: 'settings-privacy',
                path: 'privacy',
                component: require('./components/views/settings/SettingsPrivacyView')
            }
        ]
    }
];

export default  new VueRouter({
    mode: 'history',    // Removes those pesky #s

    // Tries to preserve the last scroll position, otherwise scrolls to top of page
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    },
    linkActiveClass: 'active',
    routes
});