<?php

namespace SawToolkit\Resources;


class Validators
{
    static function CPF($cpf = false): bool
    {
        function calcDigitsPositions($digits, $positions = 10, $sum_digits = 0): string
        {
            for ($i = 0; $i < mb_strlen($digits); $i++) {
                $sum_digits = $sum_digits + ($digits[$i] * $positions);
                $positions--;
            }

            $sum_digits = $sum_digits % 11;

            if ($sum_digits < 2) {
                $sum_digits = 0;
            } else {
                $sum_digits = 11 - $sum_digits;
            }

            $cpf = $digits . $sum_digits;

            return $cpf;
        }

        if (!$cpf) {
            return false;
        }

        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (mb_strlen($cpf) != 11) {
            return false;
        }

        $digits = substr($cpf, 0, 9);

        $new_cpf = calcDigitsPositions($digits);

        $new_cpf = calcDigitsPositions($new_cpf, 11);

        if ($new_cpf === $cpf) {
            return true;
        } else {
            return false;
        }
    }
}