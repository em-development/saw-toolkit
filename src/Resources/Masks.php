<?php

namespace SawToolkit\Resources;

class Masks
{
    static function Names(string $value, bool $compress = false, string $html = null): ?string
    {
        $names = array();
        $result = null;

        if ($value) {

            $elements = explode(' ', $value);

            for ($i = 0; $i < count($elements); $i++) {
                $elements[$i] != '' ? $names[] = $elements[$i] : null;
            }

            $total = count($names);

            $middle_name = null;

            if ($total == 1) {
                $result = $names[0];
            } else if ($total == 2) {
                $result = $names[0] . ' ' . $names[1];
            } else {

                for ($i = 1; $i < ($total - 1); $i++) {
                    $middle_name .= $html ? '<span class="hidden-xs hidden-sm">' . $names[$i] . '</span> ' : $names[$i] . ' ';
                }

                $result = !$compress ? $names[0] . ' ' . $middle_name . $names[$total - 1] : $names[0] . ' ' . $names[$total - 1];
            }
        }

        return $result;
    }

    static function CPF(string $value, bool $mask = false): ?string
    {
        if (!$value || $value == '""') {
            $cpf = null;
        } else if ($mask) {
            $cpf = substr($value, 0, 3) . '.';
            $cpf .= substr($value, 3, 3) . '.';
            $cpf .= substr($value, 6, 3) . '-';
            $cpf .= substr($value, 9, 2);
        } else {
            $array_dot = explode(".", $value);

            if (count($array_dot) > 1) {
                $array_dash = explode("-", $array_dot[2]);
                $cpf = $array_dot[0] . $array_dot[1] . $array_dash[0] . $array_dash[1];
            } else {
                $cpf = $value;
            }

        }

        return $cpf;
    }
}