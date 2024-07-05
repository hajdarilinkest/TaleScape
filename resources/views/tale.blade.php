<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaleScape - Eldrin the Wise</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;700&display=swap');

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: url('{{ asset('/eldrin.jpg') }}') no-repeat center center fixed;            
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }

        .overlay {
            height: 100%;
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
            background: rgba(139, 69, 19, 0.9); 
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border: 2px solid #d4af37; 
        }

        h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 4em;
            margin-bottom: 20px;
            color: #d4af37; 
        }

        p {
            font-size: 1.3em;
            margin-bottom: 30px;
            color: #f5deb3; 
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2em;
            color: #8b4513;
            background: #d4af37;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #f5deb3; 
            color: #8b4513;
            transform: scale(1.05);
        }

        .prompt-container {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .story-output {
            margin-top: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 10px;
            color: #f5deb3; 
            min-height: 150px; 
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <h1>Greetings</h1>
        <p>Welcome, traveler! I am Eldrin the Wise, the bard of TaleScape. Share with me a prompt, an idea, or a dream of times past,
             and I shall weave a tale for you.</p>
        <div class="prompt-container">
            <input type="text" id="prompt" placeholder="Enter your prompt here...">
            <button class="btn" onclick="generateStory()">Weave My Tale</button>
        </div>
        <div class="story-output" id="story-output">
            <!-- AI-generated story will appear here -->
        </div>
    </div>

    <!-- Include Axios via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async function generateStory() {
            const prompt = document.getElementById('prompt').value;
            const output = document.getElementById('story-output');
            output.innerText = "Eldrin is weaving a tale based on your prompt...";

            const maxRetries = 5;
            let retryCount = 0;
            const retryDelay = (retryCount) => Math.pow(2, retryCount) * 1000; // Exponential backoff

            async function makeRequest() {
                try {
                    const response = await axios.post('/generate-story', {
                        prompt: prompt
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.status !== 200) {
                        throw new Error(`Network response was not ok: ${response.status} ${response.statusText}`);
                    }

                    output.innerText = response.data.story;
                } catch (error) {
                    if (error.response && error.response.status === 429 && retryCount < maxRetries) {
                        retryCount++;
                        console.log(`Retry ${retryCount}/${maxRetries} in ${retryDelay(retryCount)}ms`);
                        setTimeout(makeRequest, retryDelay(retryCount));
                    } else {
                        console.error('Error:', error);
                        output.innerText = "Eldrin encountered an error while weaving the tale.";
                    }
                }
            }

            makeRequest();
        }
    </script>
</body>
</html>
