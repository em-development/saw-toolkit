<?php

namespace SawToolkit\Resources;

class Helpers
{
    static function passwordGenerator(int $size = 8, bool $uppercase = true, bool $number = true, bool $symbols = true): ?string
    {
        $lowercase_characters = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase_characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '1234567890';
        $character = '@#';
        $result = null;
        $characters = null;

        $characters .= $lowercase_characters;

        if ($uppercase) {
            $characters .= $uppercase_characters;
        }

        if ($number) {
            $characters .= $numbers;
        }

        if ($symbols) {
            $characters .= $character;
        }

        $len = mb_strlen($characters);

        for ($n = 1; $n <= $size; $n++) {
            $rand = mt_rand(1, $len);
            $result .= $characters[$rand - 1];
        }

        return $result;
    }
}