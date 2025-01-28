let mesbox_div = document.querySelector(".messages");
let input_msg = document.getElementById("input_msg");

function isScrolledToBottom() {
    return mesbox_div.scrollHeight - mesbox_div.scrollTop <= mesbox_div.clientHeight + 1;
}

function scrollToBottom() {
    mesbox_div.scrollTop = mesbox_div.scrollHeight;
}

window.onkeydown = (e) => {
    if (e.key === "Enter") {
        e.preventDefault(); // Prevent form submission
        if (input_msg.value.trim() !== "") {
            update(); // Send the message
        }
    }
};

setInterval(() => {
    fetch("readMessage.php")
        .then(r => {
            if (r.ok) return r.text();
            throw new Error('Failed to load messages');
        })
        .then(d => {
            let wasAtBottom = isScrolledToBottom();

            mesbox_div.innerHTML = d;

            if (wasAtBottom) {
                scrollToBottom();
            }
        })
        .catch(err => console.error(err));
}, 500);

function update() {
    let msg = input_msg.value;
    input_msg.value = ''; // Clear the input box

    fetch(`addMessage.php?msg=${msg}`)
        .then(r => {
            if (r.ok) {
                return r.text();
            }
        })
        .then(d => {
            console.log("Message has arrived");

            setTimeout(() => {
                scrollToBottom();
            }, 100);
        })
        .catch(err => console.error(err));
}

function sendMessage() {
    // Check if the input message is not empty or just whitespace
    if (input_msg.value.trim() !== "") {
        update(); // Send the message
    } else {
        console.log("Message cannot be empty!");
    }
}

window.onload = () => {
    scrollToBottom();
};
