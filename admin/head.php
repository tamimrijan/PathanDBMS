<!DOCTYPE html>
<html lang="en">
<head>
    <title>Header Demo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('../font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }
        body {
            margin: 0;
            font-family: 'Li Ador Noirrit SemiBold', sans-serif; 
        } 

        .admintitle {
            position: relative;
            background-color: rgba(139, 69, 19, 0.9); /* Darker brown with some transparency */
            color: #fff;
            height: 100px;
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Text shadow for better readability */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow for the header */
            z-index: 1000; /* Keep it on top */
        }

        .admintitle h1 {
            margin: 0; /* Remove default margin */
            font-size: 36px; /* Larger font size */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .admintitle h1 {
                font-size: 28px; /* Smaller font size on mobile */
            }
        }
    </style>
</head>
<body>
    <div class="admintitle">
        <h1>Welcome to the Admin Dashboard</h1>
    </div>
</body>
</html>
