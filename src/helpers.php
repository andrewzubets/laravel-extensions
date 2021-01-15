<?php 

function az_small_description($text, $cnt = 260){
    $str = '';
    $content = strip_tags($text);
    $content = trim($content);
    $ex = explode(' ', $content);
    foreach ($ex as $word) {
        $a = mb_strlen($str) + mb_strlen($word) + 1;
        if($a > $cnt) break;
        $str.=$word.' ';        
    }    
    return trim($str);
}


?>