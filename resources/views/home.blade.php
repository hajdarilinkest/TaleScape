<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaleScape</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;700&display=swap');
        
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: url('{{ asset('/medieval.jpg') }}') no-repeat center center fixed;            
            background-size: cover;
            color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 600px;
            padding: 40px;
            background: rgba(139, 69, 19, 0.9); /* Dark brown background */
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border: 2px solid #d4af37; /* Gold border */
        }

        h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 4em;
            margin-bottom: 20px;
            color: #d4af37; /* Gold color */
        }

        p {
            font-size: 1.3em;
            margin-bottom: 30px;
            color: #f5deb3; /* Wheat color */
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2em;
            color: #8b4513; /* Saddle brown color */
            background: #d4af37; /* Gold background */
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #f5deb3; /* Wheat color */
            color: #8b4513; /* Saddle brown color */
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <h1>TaleScape</h1>
        <p>Step into a magical world of stories and adventures. Create, explore, and share your tales with the world.</p>
        <button class="btn" onclick="location.href='/tales'">Start Your Journey</button>
    </div>
</body>
</html>
