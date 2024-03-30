<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {
            if ($message == 'hi' || $message == 'Hi' || $message == 'hello' || $message == 'Hello') {
                $this->askName($botman);
            } else {
                $botman->reply("Write 'hi' to start a conversation!");
            }
        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask("Hello! What is your name?", function(Answer $answer){
            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name);
        });
    }
}
