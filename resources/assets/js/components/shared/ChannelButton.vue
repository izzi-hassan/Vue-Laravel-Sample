<template>
    <button class="mdl-button channel-button" v-on:click="browseChannel" v-bind:style="{ background: channel.color }">{{ channel.label }}</button>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        props: ['channel'],
        methods: {
            browseChannel: function() {
                console.log(this.channel.slug);
                this.$router.push('/app/channels/' + this.channel.slug);
            }
        },
        mounted: function() {
            console.log('channel', this.channel);
        }
    }
</script>