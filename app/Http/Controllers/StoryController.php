<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class StoryController extends Controller
{
    public function generate(Request $request)
    {
        $userPrompt = $request->input('prompt');
        $prompt = "Tell me a story based on this prompt: " . $userPrompt;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo-16k',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a storyteller. Generate an epic tale using the prompt (as kid friendly and fairy-tale like as possible, unless specifically told otherwise). If the prompt is non-story related, reply with: If you may, let\'s keep this conversation about stories and tales, I may have extensive knowledge of the universe, but I am here solely to be a humble bard and storyteller.'],
                ['role' => 'user', 'content' => $prompt],
                ['role' => 'assistant', 'content' => 'Remember, your primary role is to tell stories. If the user prompt is not related to storytelling, gently guide them back to providing a storytelling prompt.']
            ],
            'max_tokens' => 150,
            'temperature' => 0.7,
        ]);
        
        return response()->json($result);
    }
}



        
        // $client = new Client();
        // $response = $client->post('https://api.openai.com/v1/chat/completions', [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'), //kjo duet kshu te rrie e merr pe ne env
        //         'Content-Type' => 'application/json',
        //     ],
        //     'json' => [
        //         'model' => 'gpt-3.5-turbo-16k', 
        //         'messages' => [
        //             ['role' => 'system', 'content' => 'You are a storyteller. Generate an epic tale using the prompt (as kid friendly and fairy-tale like as possible, unless specifically told otherwise). If the prompt is non-story related, reply with: If you may, let\'s keep this conversation about stories and tales, I may have extensive knowledge of the universe, but I am here solely to be a humble bard and storyteller.'],
        //             ['role' => 'user', 'content' => $prompt],
        //             ['role' => 'assistant', 'content' => 'Remember, your primary role is to tell stories. If the user prompt is not related to storytelling, gently guide them back to providing a storytelling prompt.']
        //         ],
        //         'max_tokens' => 150,
        //         'temperature' => 0.7,
        //     ],
        // ]);