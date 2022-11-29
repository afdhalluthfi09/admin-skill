<?php  
namespace App\Helpers;

class Bantuan{
    public static function get_num_of_words($string) {
            $string = preg_replace('/\s+/', ' ', trim($string));
            $words = explode(" ", $string);
            return count($words);
      
    }
}
