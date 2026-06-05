// This file initializes the application and handles user interactions for notifications.

import { showNotification } from './notify-init.js';

document.addEventListener('DOMContentLoaded', () => {
    const notifyButton = document.getElementById('notify-button');

    if (notifyButton) {
        notifyButton.addEventListener('click', () => {
            showNotification('This is a notification alert!', 'success');
        });
    }
});