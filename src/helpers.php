<?php 

/**
 * Cuts text with specific max length from text
 *
 * Splits text by spaces then reassembles it with max length limit.
 * 
 * It may use html text as input. Returns unescaped text.
 * 
 * @param string $text
 * @return string
 */
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

/**
 * Transliterates russian text
 * 
 * @param string $text
 * @return string
 */
function az_rus_translit($text){
    $cyr = [
        'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
        'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
        'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
        'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
    ];
    $lat = [
        'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
        'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
        'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
        'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
    ];
    return str_replace($cyr, $lat, $text);
}

/**
 * Creates url alias from title text
 * 
 * @param string $text_cyr
 * @return string
 */
function az_make_alias($text){
    $text = strtolower($text);
    $text = str_replace([
        '!',        '@',        '#',        '$',
        '%',        '^',        '_',        '–',
        '«',        '»',        ':',        ';',
        '"',        '\'',       '.',        ',',
        '?',        '=',        '~',        '&', 
        '*',        '(',        ')',        '_', 
        '+',        '[',        ']',        '{', 
        '}',        '|',        '\\',       '/', 
        '<',        '>',        '№',                
    ], '-', $text);
    $text = preg_replace_callback('/\s+/m', function($m){ return '-'; }, $text);    
    $text = preg_replace_callback('/\-\-+/m', function($m){ return '-'; }, $text);    
    if(substr($text, 0, 1) == '-') $text = substr($text, 1);
    if(substr($text, strlen($text) - 1) == '-') $text = substr($text,0, strlen($text) - 1);  
    return $text;
}

/**
 * Creates url alias from russian title text
 * 
 * @param string $text
 * @return string
 */
function az_rus_to_alias($text){
    return az_make_alias(az_rus_translit($text));
}



?>