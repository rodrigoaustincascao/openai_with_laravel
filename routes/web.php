<?php

use \App\AI\Chat;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use OpenAI\Laravel\Facades\OpenAI;

// Mp3
Route::get('/', function () {
    return view('roast');
});

Route::post('/roast', function () {
    $attributes = request()->validate([
        'topic' => ['required', 'string', 'min:2', 'max:50']
    ]);

    $prompt = "Por favor, fale sobre {$attributes['topic']} em português, em tom sarcástico.";

    $mp3Response = (new \App\AI\Chat())->send(
        message: $prompt,
        speech:true
    );
    
    $file = 'roasts/'.md5($mp3Response).'mp3';

    file_put_contents(public_path($file), $mp3Response);

    return redirect('/')->with([
        'file' => $file,
        'flash' => 'Boom. Roasted.'
    ]);
});


// Images

Route::get("/image", function(){
    return view('image', [
        'messages' => session('messages', [])
    ]);
});

Route::post("/image", function(){
    $attributes = request()->validate([
        'description' => ['required', 'string', 'min:3']
    ]);

    $assistant = new \App\AI\Chat(session('messages', []));

    $assistant->visualize($attributes['description']); 

    session(['messages' => $assistant->messages()]);
    return redirect('/image');

});

// Spam Detect

Route::get('/replies', function(){
    return view('create-reply');
});

Route::post('/replies', function(){
    request()->validate([
        'body' => [
            'required', 
            'string',
            new SpamFree()
        ]
    ]);

    return 'Redirect wherever is needed. Post was valid.';
});

