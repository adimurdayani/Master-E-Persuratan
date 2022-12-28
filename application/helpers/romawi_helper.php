<?php
if (!function_exists('romawi')) {
    function romawi()
    {
        $romawi = Date('m');
        switch ($romawi) {
            case 1:
                $romawi = "I";
                break;
            case 2:
                $romawi = "II";
                break;
            case 3:
                $romawi = "III";
                break;
            case 4:
                $romawi = "IV";
                break;
            case 5:
                $romawi = "V";
                break;
            case 6:
                $romawi = "VI";
                break;
            case 7:
                $romawi = "VII";
                break;
            case 8:
                $romawi = "VIII";
                break;
            case 9:
                $romawi = "IX";
                break;
            case 10:
                $romawi = "X";
                break;
            case 11:
                $romawi = "XI";
                break;
            case 12:
                $romawi = "XII";
                break;

            default:
                $romawi = Date('F');
                break;
        }
        return $romawi;
    }
}
