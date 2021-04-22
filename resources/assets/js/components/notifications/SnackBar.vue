<template>
    <div class="mdl-js-snackbar mdl-snackbar" id="snackbar">
        <div class="mdl-snackbar__text"></div>
        <div class="mdl-snackbar__action"></div>
    </div>
</template>

<script>
    import { eventBus } from '../../eventBus.js';

    export default {
        data() {
            return {
            }
        },
        mounted() {
            let $this = $(this.$el);

            // TODO: make sure multiple snackbars are not being initiated
            let snackbar = new MaterialSnackbar(this.$el);

            eventBus.$on('showSnackbar', function(message, timeout, buttonText, buttonHandler) {
                let data = {
                    message: message,
                    timeout: timeout
                };

                if (buttonText == undefined || buttonHandler == undefined) {
                    $this.children('.mdl-snackbar__action').hide();
                } else {
                    data.actionText = buttonText;
                    data.actionHandler = buttonHandler;
                    $this.children('.mdl-snackbar__action').show();
                }
                
                snackbar.showSnackbar(data);
            });
        }
    }
</script>