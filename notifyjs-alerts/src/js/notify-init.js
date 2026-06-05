// This file initializes the Notify.js library and sets up the configuration for notifications.

function initNotify() {
    // Check if Notify.js is loaded
    if (typeof Notify !== 'undefined') {
        Notify.defaults = {
            autoHide: true,
            autoHideDelay: 3000,
            position: 'top-right',
            className: 'notifyjs-alert'
        };
    } else {
        console.error('Notify.js is not loaded. Please include it in your project.');
    }
}

function showSuccess(message) {
    Notify.success(message);
}

function showError(message) {
    Notify.error(message);
}

function showWarning(message) {
    Notify.warning(message);
}

function showInfo(message) {
    Notify.info(message);
}

// Export functions for use in other modules
export { initNotify, showSuccess, showError, showWarning, showInfo };