export default {
    state: {
        list: {}
    },
    getters: {
        getChannelList ( state ) {
            console.log('list', state.list);
            return state.list;
        }
    },
    mutations: {}
};