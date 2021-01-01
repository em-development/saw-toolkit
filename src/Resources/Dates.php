<?php

namespace SawToolkit\Resources;

use DateTime;

class Dates
{
    private $date = null;

    function __construct($date = null, $add = null)
    {
        if ($date === null) {
            $date = new DateTime();
        } else {
            $date = new DateTime($date);
        }

        if ($add) {
            $operator = substr($add, 0, 1);

            if ($operator === '+' || $operator === '-') {
                $add = explode(';', substr($add, 1));
            } else {
                $add = explode(';', $add);
            }

            if (count($add)) {
                $bufferAdd = null;

                foreach ($add as $key => $value) {

                    if ($value) {
                        $type = substr($value, 0, 1);
                        $length = substr($value, 1);

                        $typeSet = null;

                        switch (strtoupper($type)) {
                            case 'Y':
                                $typeSet = 'years';
                                break;
                            case 'M':
                                $typeSet = 'months';
                                break;
                            case 'D':
                                $typeSet = 'days';
                                break;
                            case 'H':
                                $typeSet = 'hours';
                                break;
                            case 'I':
                                $typeSet = 'minutes';
                                break;
                            case 'S':
                                $typeSet = 'seconds';
                                break;
                        }

                        if ($typeSet) {
                            $bufferAdd .= " {$operator}{$length} {$typeSet}";
                        }
                    }
                }

                if ($bufferAdd) {
                    $date->modify($bufferAdd);
                }
            }
        }

        $this->date = $date;
    }

    static function Date($format = null, $date = null, $add = null)
    {
        $dates = new Dates($date, $add);

        return $dates->Format($format);
    }

    public function Format($format)
    {
        switch ($format) {
            case 'date':
                return $this->date->format('Y-m-d');
                break;
            case 'time':
                return $this->date->format('H:i:s');
                break;
            case 'dateTime':
                return $this->date->format('Y-m-d H:i:s');
                break;
            case 'class':
                return $this->date;
                break;
            default:
                if (strlen($format) == 1) {
                    return $this->date->format($format);
                } else {
                    return $this->date;
                }

                break;
        }
    }

    static function Start($format = null, $date = null, $add = null)
    {
        $dates = new Dates($date, $add);

        $dates->date->setTime(0, 0, 0);

        return $dates->Format($format);
    }

    static function End($format = null, $date = null, $add = null)
    {
        $dates = new Dates($date, $add);

        $dates->date->setTime(23, 59, 59);

        return $dates->Format($format);
    }
}