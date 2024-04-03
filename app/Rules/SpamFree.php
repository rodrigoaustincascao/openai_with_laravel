<?php

namespace App\Rules;

use App\AI\Chat;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenAI\Laravel\Facades\OpenAI;

class SpamFree implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $assistant = new Chat();

        $assistant->systemMessage('You are a forum moderator who always responds using JSON.');

        $prompt = <<<EOT
    
            Please inspect the following text and determine if it is spam.

            {$value}

            Expected Response Example:

            {"is_spam": true|false}

        EOT;

        $response = $assistant->send($prompt);
        /**
         * Para retornar um json
         * json_encode($response);
         */
    
        $response = json_decode($response);
    
        if($response?->is_spam)
        {
           $fail('Spam was detected.');
        } 
    }
}
