

function showNotification(message, type) {
    console.log('Notification function is called');
    const messageBox = document.createElement('div');
    messageBox.className = `notification ${type}`;
    messageBox.innerText = message;
    document.body.appendChild(messageBox);

    setTimeout(() => {
        messageBox.remove();
    }, 3000);
}
