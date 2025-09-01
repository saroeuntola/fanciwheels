<?php
// index.php - ChatGPT-style UI
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gemini PHP Chatbot</title>
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h2 {
            margin: 20px 0;
            color: #333;
        }

        /* Chat container */
        #chatContainer {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 700px;
            height: 80%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Chat messages area */
        #chatbox {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .msg {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 12px;
            line-height: 1.4;
        }

        .user {
            align-self: flex-end;
            background: #DCF8C6;
            color: #000;
            border-bottom-right-radius: 0;
        }

        .bot {
            align-self: flex-start;
            background: #ECECEC;
            color: #000;
            border-bottom-left-radius: 0;
        }

        /* Input area */
        #inputArea {
            display: flex;
            padding: 15px;
            border-top: 1px solid #ddd;
            background: #fafafa;
        }

        #message {
            flex: 1;
            padding: 12px 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 16px;
        }

        #sendBtn {
            padding: 0 20px;
            margin-left: 10px;
            border: none;
            background: #4CAF50;
            color: #fff;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        #sendBtn:hover {
            background: #45a049;
        }

        /* Scrollbar styling */
        #chatbox::-webkit-scrollbar {
            width: 8px;
        }

        #chatbox::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        #chatbox::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>

<body>

    <h2>💬 Gemini ChatGPT-style Bot</h2>

    <div id="chatContainer">
        <div id="chatbox"></div>
        <div id="inputArea">
            <input type="text" id="message" placeholder="Type your message..." onkeydown="if(event.key==='Enter'){ sendMessage(); }">
            <button id="sendBtn" onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        const chatbox = document.getElementById("chatbox");
        const messageInput = document.getElementById("message");

        function sendMessage() {
            const msg = messageInput.value.trim();
            if (!msg) return;

            // Display user message
            const userDiv = document.createElement("div");
            userDiv.classList.add("msg", "user");
            userDiv.innerHTML = `<b>You:</b> ${msg}`;
            chatbox.appendChild(userDiv);
            chatbox.scrollTop = chatbox.scrollHeight;
            messageInput.value = "";

            // Display loading bot message
            const botDiv = document.createElement("div");
            botDiv.classList.add("msg", "bot");
            botDiv.innerHTML = `<b>Bot:</b> ...`;
            chatbox.appendChild(botDiv);
            chatbox.scrollTop = chatbox.scrollHeight;

            // AJAX to chatbot.php
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "https://fanciwheel.com/chat/chatbot", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    botDiv.innerHTML = `<b>Bot:</b> ${xhr.responseText}`;
                    chatbox.scrollTop = chatbox.scrollHeight;
                }
            };
            xhr.send("q=" + encodeURIComponent(msg));
        }
    </script>
</body>

</html>