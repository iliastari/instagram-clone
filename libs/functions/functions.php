<?php
    /**
     * Alle functies die ik ga gebruiken
     */
       function AjaxOnly() 
        {
            define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
            if(!IS_AJAX) {die('Sorry, u hoort hier niet te zijn');}
        }
    function hg($datetime, $full = false) {

        $now = new DateTime;
        $ago = new DateTime("@".$datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'j',
            'm' => 'm',
            'w' => 'w',
            'd' => 'd',
            'h' => 'u',
            'i' => 'm',
            's' => 's',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : '';
    }
    
    function find_hashtag($str){
	$regex = "/#+([a-zA-Z0-9_]+)/";
	$str = preg_replace($regex, '<span style="color:#328AE7;">$0</span>', $str);
	return($str);
    }
    
    function find_atuser($str){
            $regex = "/@+([a-zA-Z0-9_]+)/";
            $test = preg_replace($regex, '<a href="'.SITE_URL.'user/$1"><span style="color:#328AE7;">$0</span></a>', $str);
            $str = $test;
            
            return($str);

    }
	function redirect($link)
	{
    $location = SITE_URL.$link;

    header("Location: " . $location);
    exit;
	}
	
	function redirectHTML($link)
	{
    $location = SITE_URL.$link;
	echo "<script>window.location.href='".$location."';</script>";  
    exit;
	}


