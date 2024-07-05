<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\PromptResponse;
use App\Services\TextSimilarityServices;

class StoryController extends Controller
{
    protected $similarityService;

    public function __construct(TextSimilarityServices $similarityService)
    {
        $this->similarityService = $similarityService;
    }

    public function generate(Request $request)
    {
        $userPrompt = $request->input('prompt');
        $similarityThreshold = 0.8; 

        // Check for an exact match in the database
        $exactMatch = PromptResponse::where('prompt', $userPrompt)->first();

        if ($exactMatch) {
            return response()->json(['story' => $exactMatch->response]);
        }

        // Check for similar prompts
        $allPrompts = PromptResponse::all();
        foreach ($allPrompts as $storedPrompt) {
            $similarityScore = $this->similarityService->calculateSimilarity($userPrompt, $storedPrompt->prompt);
            if ($similarityScore >= $similarityThreshold) {
                return response()->json(['story' => $storedPrompt->response]);
            }
        }

        // If no match found, call OpenAI API to generate a new story
        try {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo-16k',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a storyteller. Generate an epic tale using the prompt (as kid friendly and fairy-tale like as possible, unless specifically told otherwise). If the prompt is non-story related, reply with: If you may, let\'s keep this conversation about stories and tales, I may have extensive knowledge of the universe, but I am here solely to be a humble bard and storyteller.'],
                    ['role' => 'user', 'content' => $userPrompt],
                    ['role' => 'assistant', 'content' => 'Remember, your primary role is to tell stories. If the user prompt is not related to storytelling, gently guide them back to providing a storytelling prompt. By default, make all your stories similar to classic tales, legends, and myths, unless specifically told otherwise.']
                ],
                'max_tokens' => 10000,
                'temperature' => 0.7,
            ]);

            $generatedStory = $result['choices'][0]['message']['content'];
            // dd($result);
            // Store the new prompt and response in the database
            PromptResponse::create([
                'prompt' => $userPrompt,
                'response' => $generatedStory
            ]);

            return response()->json(['story' => $generatedStory]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 429);
        }
    }
}
