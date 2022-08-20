<?php

namespace Service;

class VoiceService
{
    public function __construct() {}


    public function getRecord(string $text, int $voiceId, int $modelId)
    {
        //$oldUrl = "https://aimyvoice.com/api/voices/$voiceId/models/$modelId/synthesize";
        $url = "https://aimyvoice.com/api/voices/dialog";
        //$data = ['text' => $text];
    

        $data = [
            "synthesizeTextRequests" => [
                [
                    "text" => $text,
                    "modelId" => $modelId,
                    "voiceId" => $voiceId
                ]
            ]
        ];

        $content = json_encode($data, JSON_UNESCAPED_UNICODE);

        $options = [
                'http' => [
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => $content, //http_build_query($data),
                    'user-agent' => 'Mozilla/10.0 (Android; Windows x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'
                ]
            ];
    
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        return $result;
    }
}