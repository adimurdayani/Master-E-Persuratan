<?php
function teksKonv($str)
{
    $str = preg_replace('/[áàãâä]/ui', '', $str);
    $str = preg_replace('/[éèêë]/ui', '', $str);
    $str = preg_replace('/[íìîï]/ui', '', $str);
    $str = preg_replace('/[óòõôö]/ui', '', $str);
    $str = preg_replace('/[úùûü]/ui', '', $str);
    $str = preg_replace('/[¢,]/ui', '', $str);
    // $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    // $str = preg_replace('/_+/', '_', $str);

    return $str;
}
