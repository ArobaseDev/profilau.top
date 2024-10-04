<?php
namespace App\Service;

use Gemini;

class GeminiService
{
    private $client;

    public function __construct(string $apiKey)
    {
        // Initialiser le client Gemini avec la clé API
        $this->client = Gemini::client($apiKey);
    }

    public function generateCoverLetter(string $prompt)
    {
   
        return $this->client->geminiPro()->generateContent($prompt);
 
    }
}
