<?php

namespace SAWToolkit\Resources;

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

    static function guid(): ?string
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);
            $charId = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            return chr(123)
                . substr($charId, 0, 8) . $hyphen
                . substr($charId, 8, 4) . $hyphen
                . substr($charId, 12, 4) . $hyphen
                . substr($charId, 16, 4) . $hyphen
                . substr($charId, 20, 12)
                . chr(125);
        }
    }
}