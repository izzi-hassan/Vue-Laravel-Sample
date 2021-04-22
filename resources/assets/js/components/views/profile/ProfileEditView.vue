<template>
    <div class="view-container edit-profile-view">
        Edit PRofile
    </div>
</template>


<script>

import { eventBus } from '../../../eventBus.js';
import CoverImageUpload from '../../shared/CoverImageUpload.vue';

export default {
    data() {
        return {
        }
    },
    computed: {
    },
    mounted() {
        this.$store.commit('showProfileEditMenu');
    },
    components: {

    }
}
</script>