<?php

use App\Ai\Agents\PersonalAssistant;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use function Laravel\Prompts\text;
Artisan::command('try_ai', function () {
    $user = User::query()->first();
    while(true){
    $prompt = text('Prompt:');
    $response = PersonalAssistant::make()
    ->continue('first_conversation', as:$user)
    ->prompt($prompt);
    $this->info((string) $response);
    }
});
