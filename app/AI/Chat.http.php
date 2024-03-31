<?php

namespace App\AI;

use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

class Chat
{
    /**
     *   Exemplo utilizando o http
     * 
     * */


    protected array $messages = [];



    public function systemMessage(string $message)
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => $message
        ];

        return $this;
    }

    public function reply(string $message): ?string
    {
        return $this->send($message);
    }

    public function send(string $message): ?string
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $message
        ];
        $response = Http::withToken(config('services.openai.secret'))
        ->post('https://api.openai.com/v1/chat/completions', 
            [

                "model"=> "gpt-3.5-turbo",
                "messages" => $this->messages
            ])->json('choices.0.message.content');

          if($response){
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response
            ];
          }
        
        return  $response;

    }



    public function messages() : array 
    {
        return $this->messages;    
    }
}