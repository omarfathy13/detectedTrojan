<?php
session_start();
error_reporting(-1);
$url = "http://";
$file = file_get_contents($url);
preg_match_all('#<script(.*?)</script>#is', $file, $matches);
$scripts = $matches['0'];

if(isset($_GET['i'])){
     $pat = intval($_GET['i']);
}else{
    $i = 0;
    $_SESSION['i'] = $_SESSION['i'] + 1;
    $pat = $_SESSION['i'];
}


foreach ($scripts AS $script)
{
     if($i === $pat && count($scripts) >= $pat){
        $p = $script;
        $file = str_replace($script, '', $file);
     }else{
        exit("no problem for this browser");
     }
    $i++;
}
if(isset($_GET['i'])){
echo "<pre>";
echo  htmlspecialchars($scripts[$_SESSION['i']]);
echo "<pre>";
}else{
echo $file;
$to = $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?i=".$pat;
echo '<meta http-equiv="refresh" content="0"; url='.$to.'" />';
}

