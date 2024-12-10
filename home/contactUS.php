<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Making</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #282c34;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
            text-align: center;
        }

        .message {
            background: linear-gradient(to right, #ff6a00, #ee0979);
            -webkit-background-clip: text;
            color: transparent;
            font-size: 60px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 5px;
            animation: glowing 1.5s ease-in-out infinite alternate;
        }

        @keyframes glowing {
            0% {
                text-shadow: 0 0 5px #ff6a00, 0 0 10px #ff6a00, 0 0 15px #ff6a00, 0 0 20px #ff6a00;
            }
            100% {
                text-shadow: 0 0 10px #ee0979, 0 0 20px #ee0979, 0 0 30px #ee0979, 0 0 40px #ee0979;
            }
        }
    </style>
</head>
<body>
    <div class="message">
        Under Making
    </div>
</body>
</html>
