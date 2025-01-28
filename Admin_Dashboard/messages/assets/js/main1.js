$(document).ready(function() {
    let mesbox_div = $(".messages"); // jQuery selection

    function isScrolledToBottom() {
        return mesbox_div[0].scrollHeight - mesbox_div[0].scrollTop <= mesbox_div[0].clientHeight + 1;
    }

    function scrollToBottom() {
        mesbox_div.scrollTop(mesbox_div[0].scrollHeight);
    }

    window.onkeydown = (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            if (input_msg.value.trim() !== "") {
                update(); // Send the message
            }
        }
    };

    setInterval(() => {
        fetch("messages/readMessages.php")
            .then(r => {
                if (r.ok) return r.text();
                throw new Error('Failed to load messages');
            })
            .then(d => {
                let wasAtBottom = isScrolledToBottom();

                mesbox_div.html(d); // Use jQuery's html() method to replace content

                if (wasAtBottom) {
                    scrollToBottom();
                }
            })
            .catch(err => console.error(err));
    }, 500);

    function update() {
        let msg = input_msg.value;
        input_msg.value = ''; // Clear the input box

        fetch(`messages/addMessages.php?msg=${msg}`)
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
        if (input_msg.value.trim() !== "") {
            update(); // Send the message
        } else {
            console.log("Message cannot be empty!");
        }
    }

    window.onload = () => {
        scrollToBottom();
    };

    function loadSpamMessages() {
        fetch('messages/fetchSpamMessages.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                let spamSection = $('.spam-section');
                spamSection.html('<h2>Spam Messages</h2>');
                if (data.length > 0) {
                    data.forEach(spam => {
                        spamSection.append(`<p><strong>${spam.Firstname}:</strong> ${spam.Message} <span id="spamTimestamp">(${spam.timestamp})</span></p>`);
                    });
                } else {
                    spamSection.append('<p>No spam messages found.</p>');
                }
            })
            .catch(error => console.error('Error fetching spam messages:', error));
    }

    loadSpamMessages(); // Load spam messages initially
});
