<template>
    <div class="row align-center" id="channel-subscriber">
        <div class="small-12 columns" id="channel-selection-container">
            <div class="row">
                <div class="small-12 columns text-left">
                    <h4>Select 3 or more topics</h4>
                </div>
            </div>
            <div class="row">
                <div class="columns" data-equalizer>
                    <ul>
                        <li v-for="channel in channels">
                            <button class="channel_toggle" v-bind:class="{selected: channel.selected}" :data-channel="channel.id" v-on:click="toggleChannelSelection" data-equalizer-watch>
                                <i class="fa fa-check"></i>
                                <i class="fa fa-times"></i>
                                {{ channel.label }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            selectedChannels: []
        }
    },
    props: ['channels'],
    methods: {
        toggleChannelSelection: function(e) {
            var $this = $(e.currentTarget);

            console.log($this);

            if ( ! $this.hasClass('selected')) {
                axios.get('/api/channel/subscribe/' + $this.data('channel'))
                    .then(function (response) {
                        if (!response.data.error) {
                            console.log(response);
                            showToast('Channel Subscribed!');

                            $this.toggleClass('selected');
                        } else {
                            showToast('Something went wrong');
                        }
                    }).catch(function (error) {
                    showToast(error.message);
                });
            } else {
                axios.get('/api/channel/unSubscribe/' + $this.data('channel'))
                .then(function (response) {
                    if (!response.data.error) {
                        console.log(response);
                        showToast('Channel Un-Subscribed!');

                        $this.toggleClass('selected');
                    } else {
                        showToast('Something went wrong');
                    }
                }).catch(function (error) {
                    showToast(error.message);
                });
            }
        }
    }
}
</script>