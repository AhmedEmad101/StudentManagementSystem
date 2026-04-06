<?php

use App\Ai\Agents\PersonalAssistant;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
Artisan::command('try_ai', function () {
    $user = User::query()->first();
    while(true){
  $response = PersonalAssistant::make()
  ->continue('first_conversation', as:$user)
  ->prompt('what is my name');
  $this->info((string) $response);
    }
});
