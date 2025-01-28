




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <style>


.messages{
    height: 86%;
    width: 100%;
    background-color: #ececec;
    border-radius: 10px;
    display: flex
;
    flex-direction: column;
    padding: 5px;
    gap: 12px;
    overflow: hidden;
    overflow-y: scroll;
}

.messageContainer{
    height: 100%;
    width: 100%;
    padding: 1rem;
    background-color: #87a278;
    display: flex
;
    justify-content: space-between;
}

.wrapper{
    width: 58%;
}


.spamMessages{
    height: 100%;
    background-color: #d9ff50;
    overflow-y: scroll;
    border-radius: 5px;
}

.spamDiv{
    height: 73vh;
    width: 40%;
}

.spamHeading{
    font-weight: bold;
    font-family: system-ui;
    color: white;
}

.chatHeading{
    

    font-family: system-ui;
    color: white;
    font-weight: bold;
   
}

.inputContainer{
    display: flex
;
    align-items: center;
    justify-content: space-between;
    margin-top: 5px;
}


.inputContainer #input_msg{
  
    padding: 15px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 72%;
}

.inputContainer form{
    width: 100%;
}


button#send-btn{
    height: 42px;
    /* padding: 10px 15px; */
    font-size: 16px;
    cursor: pointer;
    /* margin: 6px 5px; */
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    width: 24%;
}

#sender{
    display: flex;
    flex-direction: column;
    width: fit-content;
    max-width: 80%; 
    align-self: flex-end;
}

#receiver{
    display: flex;
    flex-direction: column;
    width: fit-content;
    max-width: 80%; 
}

span#userName{
    font-size: 10px;
    margin: 0 4px;
    color: #8c8c8c;
}

#receiver #messages{
    background-color: #acb3a9;
}

#sender #messages{
    background-color: #7cb968;
}

span#messages{

    text-align: left;
    padding: 9px 8px;
    min-height: 1rem;
    height: fit-content;
    border-radius: 20px;
    font-size: 13px;
    background-color: #acb3a9;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
}

.userNameTimestampContainer{
    display: flex
    ;
        justify-content: space-between;
        align-items: center;
}

span#timeStamp{
   
    font-size: 9px;
    color: #a3a3a3;
    align-self: flex-end;
}


.spam-section {

    padding: 1rem;
  
    border-radius: 8px;
  
}

.spam-section h2 {
    color: #d9534f;
}



#spamTimestamp{

    font-size: 9px;
    color: #616565;
    
}
 </style>

</head>
<body>
<div class="messageContainer">
    <div class="wrapper">
    <div class="chatHeading">CHAT HUB</div> 


    <div class="messages">
   
          <div id="sender">
            <div class="userNameTimestampContainer"> 
                 <span id="userName">Sender</span>
                 <span id="timeStamp" >9:30 Am</span>

        </div>
          
            <span id="messages">random message is here</span>

</div>

          <p id="receiver">
            <span id="userName">User</span>
            <span id="messages">random message is here</span>

          </p>
       
    </div>




    <div class="inputContainer">
       
    <form action="#" method="POST" onsubmit="return false;">
          <input type="text" name="message" placeholder="Enter the Message" id="input_msg" required/>
          <button id="send-btn" type="button" onclick="sendMessage()">Send</button>
        </form>
    </div>




</div>
<div class="spamDiv">
   
        <div class="spamHeading">Spam Section</div>
        <div class="spamMessages">
        <div class="spam-section">
    <h2>Spam Messages</h2>
    <?php if (!empty($spam_messages)): ?>
        <?php foreach ($spam_messages as $spam): ?>
            <p> </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No spam messages found.</p>
    <?php endif; ?>
</div>


        </div>
 
</div>


</div>    

<script >
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

</script>

</body>
</html>
