export default {
    state: {
        message: '',
        menu: {
            current: 'app-menu'
        }
    },
    getters: {

    },
    mutations: {
        showContentCreateMenu (state) {
            state.menu.current = 'content-create-menu';
        },
        showContentEditMenu (state) {
            state.menu.current = 'content-edit-menu';
        },
        showProfileEditMenu (state) {
            state.menu.current = 'profile-edit-menu';
        },
        showAppMenu (state) {
            state.menu.current = 'app-menu';
        },
        showTopBarMessage (state, message) {
            state.message = message;
        },
        hideTopBarMessage (state) {
            state.message = '';
        }
    }
};