<?php
function is_active(string $routeName)
{
    return null !== request()->segment(1) && request()->segment(1) == $routeName ? 'active' : '' ;//access to the url number 2 meeans users number one is the dashboared
}
function getYoutubeId($url){
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return isset($match[1])?$match[1]:null;
}
function slug( string $name)
{
  return strtolower(trim(str_replace(' ','_' , $name)));
}
?>
