<template>
    <div class="content-editor-container">
        <!-- Editor -->
        <div class="medium-editable" data-editor-type="normalEditor" v-medium>
            <p>Start typing here. Highlight to format content.</p>
        </div>

        <!-- Special Content -->
        <div class="add-media-container row">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" v-on:click="addMedia" v-mdl>
                <i class="fa fa-plus"></i>
            </button>
        </div>
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
    },
    mounted() {
    },
    methods: {
        addMedia (e) {
            e.preventDefault();
            console.log('adding media');
        }
    },
    components: {
    }
}

</script>