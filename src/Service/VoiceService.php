<?php

namespace Service;

class VoiceService
{
    public function __construct() {}


    public function getRecord(string $text, int $voiceId, int $modelId)
    {
        $url = "https://aimyvoice.com/api/voices/$voiceId/models/$modelId/synthesize";
        $data = ['text' => $text];
    
    
        $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
                    'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'
                ]
            ];
    
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        return $result;
    }
}