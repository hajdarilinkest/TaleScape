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
                "x-rapidapi-key: " . env('TWINWORD_API_KEY')
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
            return $response['similarity'];
        }
    }
}
