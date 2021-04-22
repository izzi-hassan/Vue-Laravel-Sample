<template>
    <div class="view-group-container" id="profile-group-container">
        <router-view></router-view>
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

    },
    components: {

    }
}
</script>