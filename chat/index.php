<?php
// index.php - simple chatbot UI
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gemini PHP Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        #chatbox {
            width: 100%;
            max-width: 600px;
            height: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
            margin: 0 auto 10px;
            background: #fff;
        }

        .msg {
            margin: 5px 0;
        }

        .user {
            color: blue;
        }

        .bot {
            color: green;
        }

        #inputArea {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
        }

        #message {
            flex: 1;
            padding: 10px;
        }

        button {
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">💬 Gemini PHP Chatbot</h2>
    <div id="chatbox"></div>

    <div id="inputArea">
        <input type="text" id="message" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        function sendMessage() {
            const msg = document.getElementById("message").value.trim();
            if (!msg) return;

            const chatbox = document.getElementById("chatbox");
            chatbox.innerHTML += `<div class="msg user"><b>You:</b> ${msg}</div>`;
            document.getElementById("message").value = "";

            // AJAX request to chatbot.php
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "https://fanciwheel.com/chat/chatbot", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    chatbox.innerHTML += `<div class="msg bot"><b>Bot:</b> ${xhr.responseText}</div>`;
                    chatbox.scrollTop = chatbox.scrollHeight;
                }
            };
            xhr.send("q=" + encodeURIComponent(msg));
        }
    </script>
</body>

</html>