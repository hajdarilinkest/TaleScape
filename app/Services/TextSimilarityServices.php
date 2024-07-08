<?php

namespace App\Services;

class TextSimilarityServices
{
    public function calculateSimilarity($text1, $text2)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://twinword-text-similarity-v1.p.rapidapi.com/similarity/?text1=" . urlencode($text1) . "&text2=" . urlencode($text2),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: twinword-text-similarity-v1.p.rapidapi.com",
               
                "x-rapidapi-key: " .  'hard-coded-api'
                // env('TWINWORD_API_KEY')
                //Problem was fixed because it appears the environment file is not properly read. hard-coding the key into the code solves the problem temporarily.
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // Handle the error as needed
            return 0;
        } else {
            $response = json_decode($response, true);
            // dd($response);
            return $response['similarity'];
        }
    }
}
