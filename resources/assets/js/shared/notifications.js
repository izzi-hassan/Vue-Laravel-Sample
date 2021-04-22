import { eventBus } from '../eventBus.js';

// Notification functionality goes here
window.showToast = function(message, timeout) {
    console.log('showing Toast');
    if (timeout == undefined)
        timeout = 5000;

    eventBus.$emit('showSnackbar', message, timeout);
};

window.showSnackbar = function(message, buttonText, buttonHandler, timeout) {
    console.log('showing snackbar');
    if (timeout == undefined)
        timeout = 5000;

    eventBus.$emit('showSnackbar', message, timeout, buttonText, buttonHandler);
}