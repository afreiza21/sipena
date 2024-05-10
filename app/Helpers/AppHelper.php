<?php

namespace App\Helpers;

class AppHelper
{
    public function readMore($teks)
    {        
        $start = strpos($teks, '<p>');
        $end = strpos($teks, '</p>', $start);
        $paragraph = substr($teks, $start, $end - $start + 4);
        
        $string = html_entity_decode(strip_tags($paragraph));
        $word = explode(' ', $string);
        if (count($word) > 20) {
            $text = implode(' ', array_slice(explode(' ', $string), 0, 20));
        } else {
            $text = implode(' ', array_slice(explode(' ', $string), 0, count($word)));
        }                
        
        return $text." ...";
    }

    public function rupiah($angka){	
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;     
    }


    public static function instance()
    {
        return new AppHelper();
    }
}
